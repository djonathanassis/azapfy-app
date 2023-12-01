<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class RegisteredController extends Controller
{

    /**
     * @OA\Post(
     *      tags={"/auth"},
     *      summary="Display only one product",
     *      description="Get a product from the database",
     *      path="/register",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          description="ProductDto id",
     *          in="path",
     *          name="code",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", description="Show a product"
     *      )
     * )
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        User::query()->create(
            RegisterUserDto::fromApiRequest($request)
                ->toArray()
        );

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
