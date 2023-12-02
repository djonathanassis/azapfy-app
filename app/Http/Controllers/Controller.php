<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Server(url="http://localhost/api/v1")
 * @OA\Info(
 *      description="API Documentation",
 *      version="1.0.0",
 *      title="Laravel API Documentation",
 *      @OA\Contact(
 *          email="djonathanassis@gmail.com"
 *      )
 *  )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
