<?php

/**
 * @api {get} /users Get Users
 * @apiName GetUsersList
 * @apiGroup Users
 * @apiPermission Guest
 *
 *
 * @apiSuccessExample Successful Response:
 * HTTP/1.1 200 OK
 *
 * [
 *     {
 *         "id": 2,
 *         "email": "peacefulcake@gmail.com",
 *         "apiKey": "9f7be27b7ee7d2de82a1936ee468c416",
 *         "rounds": [],
 *         "activeRound": null
 *     },
 *     {
 *         "id": 4,
 *         "email": "jadeitecherry@gmail.com",
 *         "apiKey": "65f6867483b05666253b83a437eed26a",
 *         "rounds": [],
 *         "activeRound": null
 *     },
 * ]
 *
 *
 */

/**
 * @api {post} /roulette/spin Spin roulette
 * @apiName SpinRoulette
 * @apiGroup Roulette
 * @apiPermission User
 *
 * @apiParam {String} api_key User API key
 *
 * @apiSuccessExample Successful Response:
 * HTTP/1.1 200 OK
 * {
 *     "id": 9,
 *     "spins": [
 *         {
 *             "id": 50,
 *             "round": 9,
 *             "droppedCell": {
 *                 "id": 17,
 *                 "index": 7,
 *                 "weight": 20
 *             },
 *             "isJackpot": false
 *         },
 *         {
 *             "id": 51,
 *             "round": 9,
 *             "droppedCell": {
 *                 "id": 19,
 *                 "index": 9,
 *                 "weight": 140
 *             },
 *             "isJackpot": false
 *         }
 *     ],
 *     "over": false
 * }
 *
 * @apiErrorExample Bad Request:
 * HTTP/1.1 400 Bad Request
 * {
 *     "status": 400,
 *     "detail": "No user set for this spin!",
 * }
 *
 */


/**
 * @api {get} /statistics Get Statistics
 * @apiName GetStatistics
 * @apiGroup Statistics
 * @apiPermission Guest
 *
 *
 * @apiSuccessExample Successful Response:
 * HTTP/1.1 200 OK
 *
 * {
 *     "active_users": [
 *         {
 *             "user_id": 4,
 *             "total_rounds": 1,
 *             "average_spin_count": 1
 *         },
 *     ],
 *     "users_count_by_total_rounds": [
 *         {
 *             "total_rounds": 1,
 *             "users_count": 1
 *         }
 *     ]
 * }
 *
 */