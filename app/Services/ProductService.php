<?php

namespace App\Services;

use App\DTO\ProductFilterDTO;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function search(ProductFilterDTO $filters): LengthAwarePaginator
    {
        $query = $this->buildSearchQuery($filters);

        $query = $this->applySorting($query, $filters->sort);

        return $query->paginate(
            perPage: $filters->perPage,
            page: $filters->page
        );
    }

    private function buildSearchQuery(ProductFilterDTO $filters): Builder
    {
        $query = Product::query()->with('category');

        if ($filters->query !== null) {
            $query->whereFullText('name', $filters->query);
        }

        if ($filters->priceFrom !== null) {
            $query->where('price', '>=', $filters->priceFrom);
        }

        if ($filters->priceTo !== null) {
            $query->where('price', '<=', $filters->priceTo);
        }

        if($filters->categoryId !== null){
            $query->where('category_id', $filters->categoryId);
        }

        if($filters->inStock !== null) {
            $query->where('in_stock', $filters->inStock);
        }

        if ($filters->ratingFrom !== null) {
            $query->where('rating', '>=', $filters->ratingFrom);
        }

        return $query;
    }

    private function applySorting(Builder $query, string $sort): Builder
    {
        return match($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating_desc' => $query->orderBy('rating', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('created_at', 'desc')
        };
    }
}
