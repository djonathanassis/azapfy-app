<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\InvoiceDto;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Interfaces\InvoiceInterface;
use App\Models\Invoice;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    use HttpResponses;

    public function __construct(
        private readonly InvoiceInterface $invoiceService
    ) {
    }

    /**
     * @OA\Get(
     *      tags={"/invoices"},
     *      summary="Display a listing of the resource and paginate then",
     *      description="Get all invoices on database",
     *      path="/invoices",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response="200", description="List of invoices"
     *      )
     * )
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Invoice::class);

        try {
            $response = $this->invoiceService->findAll();
            return (new InvoiceResource($response))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @OA\Post(
     *      tags={"/invoices"},
     *      summary="Create a invoice",
     *      description="Create a invoice on database",
     *      path="/produtos",
     *      security={{"bearerAuth": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="number", type="string"),
     *              @OA\Property(property="amount", type="decimal"),
     *              @OA\Property(property="date_emissary", type="dateTime"),
     *              @OA\Property(property="cnpj_retirement", type="string"),
     *              @OA\Property(property="name_retirement", type="string"),
     *              @OA\Property(property="cnpj_transporter", type="string"),
     *              @OA\Property(property="name_transporterr", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", description="create a invoice"
     *      ),
     *      @OA\Response(
     *          response="400", description="Bad request"
     *      )
     * )
     */
    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        Gate::authorize('create', Invoice::class);

        try {
            $this->invoiceService->create(
                InvoiceDto::fromApiRequest($request)->toArray()
            );
            return (new InvoiceResource(null))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @OA\Get(
     *      tags={"/invoices"},
     *      summary="Display only one invoices",
     *      description="Get a invoices from the database",
     *      path="/invoices/{invoice}",
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
     *          response="200", description="Show a invoices"
     *      )
     * )
     */
    public function show(Invoice $invoice): JsonResponse
    {
        Gate::authorize('view', $invoice);

        try {
            return (new InvoiceResource($invoice))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }

    /**
     * @OA\Put(
     *      tags={"/invoices"},
     *      summary="Update a product",
     *      description="Update a invoice on database",
     *      path="/invoices/{invoice}",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *               @OA\Property(property="number", type="string"),
     *               @OA\Property(property="amount", type="decimal"),
     *               @OA\Property(property="date_emissary", type="dateTime"),
     *               @OA\Property(property="cnpj_retirement", type="string"),
     *               @OA\Property(property="name_retirement", type="string"),
     *               @OA\Property(property="cnpj_transporter", type="string"),
     *               @OA\Property(property="name_transporterr", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="202", description="Update a invoice"
     *      ),
     *      @OA\Response(
     *          response="400", description="Bad request"
     *      )
     * )
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): JsonResponse
    {
        Gate::authorize('update', $invoice);

        try {
            $response = $this->invoiceService->update(
                InvoiceDto::fromApiRequest($request)->toArray(), $invoice->id
            );
            return (new InvoiceResource($response))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @OA\Delete(
     *      tags={"/invoices"},
     *      summary="Delete the invoice",
     *      description="Delete the invoice to 'trash'",
     *      path="/invoices/{invoice}",
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
     *          response="204", description="Delete the invoice"
     *      )
     * )
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        Gate::authorize('delete', $invoice);

        try {
            $this->invoiceService->delete($invoice->id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
