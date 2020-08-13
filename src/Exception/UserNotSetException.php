<?php

namespace App\Exception;

use Exception;

class UserNotSetException extends Exception
{
    protected $message = "No user set for this spin!";
}