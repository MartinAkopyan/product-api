<?php

namespace App\DTO;

use App\Http\Requests\ProductFilterRequest;

/**
 * @param string|null $query
 * @param float|null $priceFrom
 * @param float|null $priceTo
 * @param int|null $categoryId
 * @param bool|null $inStock
 * @param float|null $ratingFrom
 * @param string $sort
 * @param int $page
 * @param int $perPage
 */
readonly class ProductFilterDTO
{
    public function __construct(
        public ?string $q = null,
        public ?float $priceFrom = null,
        public ?float $priceTo = null,
        public ?int $categoryId = null,
        public ?bool $inStock = null,
        public ?float $ratingFrom = null,
        public string $sort = 'newest',
        public int $page = 1,
        public int $perPage = 15,
    ){}

    public static function fromRequest(ProductFilterRequest $request): self
    {
        return new self(
            q: $request->input('q'),
            priceFrom: $request->input('price_from'),
            priceTo: $request->input('price_to'),
            categoryId: $request->filled('category_id') ? $request->integer('category_id') : null,
            inStock: $request->input('in_stock'),
            ratingFrom: $request->input('rating_from'),
            sort: $request->input('sort', 'newest'),
            page: $request->input('page', 1),
            perPage: $request->input('perPage', 15),
        );
    }
}
