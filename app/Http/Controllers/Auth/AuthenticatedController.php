<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedController extends Controller
{
    /**
     * * @OA\Post(
     *      tags={"/auth"},
     *      path="/login",
     *      summary="User Login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="email"),
     *              @OA\Property(property="password", type="password"),
     *          )
     *      ),
     *      @OA\Response(
     *              response="201",
     *              description="",
     *              @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(property="message", type="string"),
     *                  @OA\Property(property="status", type="integer", example=201),
     *                  @OA\Property(
     *                      property="data",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="token", type="string")
     *                       )
     *                  ),
     *              )
     *      )
     * )
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $request->authenticate();

        return response()->json([
            'token' => $request->user()
                ->createToken($request->userAgent())
                ->plainTextToken
        ])->setStatusCode(202);
    }

    /**
     *
     * * @OA\Post(
     *      tags={"/auth"},
     *      path="/logout",
     *      summary="User logout",
     *      @OA\Response(
     *              response="200",
     *              description="",
     *              @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(property="message", type="string", example="Token Revoked"),
     *                  @OA\Property(property="status", type="integer", example=200),
     *              )
     *      )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null)
            ->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
