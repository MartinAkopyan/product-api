<?php

namespace App\Http\Controllers\Api;

use App\DTO\ProductFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    )
    {
    }

    public function index(ProductFilterRequest $request): JsonResponse
    {
        $filters = ProductFilterDTO::fromRequest($request);

        $result = $this->service->search($filters);

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($result->items()),
            'meta' => [
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'per_page' => $result->perPage(),
                'last_page' => $result->lastPage(),
            ],
            'links' => [
                'first' => $result->url(1),
                'last' => $result->url($result->lastPage()),
                'prev' => $result->previousPageUrl(),
                'next' => $result->nextPageUrl(),
            ],
        ]);
    }
}
