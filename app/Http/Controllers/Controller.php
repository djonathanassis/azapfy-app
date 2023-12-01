<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Server(url="http://localhost/api/v1")
 * @OA\Info(title="Open Food Facts API", version="1.0.0")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
