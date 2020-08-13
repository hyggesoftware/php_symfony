<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class JsonController extends AbstractController
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * JsonController constructor.
     */
    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @param array $array
     * @return JsonResponse
     */
    protected function responseArray(array $array): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize($array, 'json', [
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ])
        );
    }

    /**
     * @param $entity
     * @param array $ignoredAttributes
     *
     * @return JsonResponse
     */
    protected function responseEntity($entity, array $ignoredAttributes = []): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize($entity, 'json', [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                    return $object->getId();
                },
                AbstractNormalizer::IGNORED_ATTRIBUTES => $ignoredAttributes,
            ])
        );
    }
}