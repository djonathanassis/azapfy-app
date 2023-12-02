<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\RegisteredInterface;
use App\Models\Tenant;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class RegisteredController extends Controller
{
    use HttpResponses;

    public function __construct(
        private readonly RegisteredInterface $registeredService
    )
    {
    }

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
        try {
            $this->registeredService->create(RegisterUserDto::fromApiRequest($request));
            return $this->responseSuccess(null, 'Successful',
                Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
