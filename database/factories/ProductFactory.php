<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private array $prefixes = [
        'Premium',
        'Professional',
        'Luxury',
        'Budget',
        'Classic',
        'Modern'
    ];

    private array $productsByCategory = [
        'Electronics' => [
            'Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Headphones',
            'Webcam', 'Router', 'Tablet', 'Smartwatch', 'Power Bank',
            'USB Hub', 'SSD Drive', 'Graphics Card', 'Microphone', 'Controller'
        ],
        'Clothing' => [
            'T-Shirt', 'Jeans', 'Shoes', 'Jacket', 'Sweater',
            'Dress', 'Shorts', 'Sneakers', 'Hoodie', 'Blazer',
            'Coat', 'Pants', 'Skirt', 'Boots', 'Scarf'
        ],
        'Books' => [
            'Novel', 'Cookbook', 'Textbook', 'Magazine', 'Comic Book',
            'Biography', 'Poetry Collection', 'Travel Guide', 'Dictionary', 'Atlas',
            'Art Book', 'Encyclopedia', 'Journal', 'Manual', 'Workbook'
        ],
        'Sports' => [
            'Yoga Mat', 'Dumbbell', 'Running Shoes', 'Bicycle', 'Tennis Racket',
            'Football', 'Resistance Band', 'Jump Rope', 'Gym Bag', 'Water Bottle',
            'Fitness Tracker', 'Boxing Gloves', 'Treadmill', 'Protein Shaker', 'Foam Roller'
        ],
    ];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-365 days', 'now');

        return [
            'name' => fake()->randomElement($this->prefixes) . ' ' . fake()->word(),
            'price' => fake()->randomFloat(2, 9.99, 1999.99),
            'category_id' => 1,
            'in_stock' => fake()->boolean(80),
            'rating' => fake()->randomFloat(1, 0, 5),
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }

    public function electronics(): static
    {
        return $this->state(fn () => [
            'name' => fake()->randomElement($this->prefixes)
                . ' ' . fake()->randomElement($this->productsByCategory['Electronics']),
            'category_id' => Category::firstOrCreate(['name' => 'Electronics'])->id,
        ]);
    }

    public function clothing(): static
    {
        return $this->state(fn () => [
            'name' => fake()->randomElement($this->prefixes)
                . ' ' . fake()->randomElement($this->productsByCategory['Clothing']),
            'category_id' => Category::firstOrCreate(['name' => 'Clothing'])->id,
        ]);
    }

    public function books(): static
    {
        return $this->state(fn () => [
            'name' => fake()->randomElement($this->prefixes)
                . ' ' . fake()->randomElement($this->productsByCategory['Books']),
            'category_id' => Category::firstOrCreate(['name' => 'Books'])->id,
        ]);
    }

    public function sports(): static
    {
        return $this->state(fn () => [
            'name' => fake()->randomElement($this->prefixes)
                . ' ' . fake()->randomElement($this->productsByCategory['Sports']),
            'category_id' => Category::firstOrCreate(['name' => 'Sports'])->id,
        ]);
    }

}
