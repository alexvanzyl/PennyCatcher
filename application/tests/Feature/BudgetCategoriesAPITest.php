<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetCategoriesAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function getting_all_budget_categories()
    {
        factory(\App\BudgetCategory::class, 3)->create([
            'name' => 'car',
            'type' => 'expense'
        ]);

        $this->json('GET', '/api/budget/categories')
            ->assertStatus(200)
            ->assertJson([
                ['name' => 'car', 'type' => 'expense'],
            ])
            ->assertJsonCount(3);
    }

    /** @test */
    public function getting_a_single_category_by_id()
    {
        $category = factory(\App\BudgetCategory::class)->create();

        $this->json('GET', '/api/budget/categories/1')
            ->assertStatus(200)
            ->assertJson([
                'id' => $category->id,
                'type' => $category->type,
            ]);
    }

    /** @test */
    public function creating_a_valid_budget_category()
    {
        $this->json('POST', '/api/budget/categories', [
            'name' => 'home',
            'type' => 'expense',
        ])
            ->assertStatus(201)
            ->assertJson([
                'name' => 'home',
                'type' => 'expense',
            ]);

        $this->json('POST', '/api/budget/categories', [
            'name' => 'home',
            'type' => 'expense',
        ])
            ->assertStatus(201)
            ->assertJson([
                'name' => 'home',
                'type' => 'expense',
            ]);
    }

    /** @test */
    public function creating_an_invalid_budget_category_will_return_validation_errors()
    {
        $this->json('POST', '/api/budget/categories', [
            'name' => '',
            'type' => '',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'type']);
    }

    /** @test */
    public function updating_a_valid_category()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense'
        ]);

        $this->json('PATCH', '/api/budget/categories/1', [
            'type' => 'expense',
            'name' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);

        $this->json('PATCH', '/api/budget/categories/1', [
            'type' => 'expense',
            'name' => 'home',
        ])
        ->assertStatus(200)
        ->assertJson([
            'id' => $category->id,
            'name' => 'home',
            'type' => 'expense',
        ]);
    }

    /** @test */
    public function deleting_a_budget_category()
    {
        factory(\App\BudgetCategory::class)->create();

        $this->json('DELETE', '/api/budget/categories/1')
            ->assertStatus(200);

        $this->json('GET', '/api/budget/categories')
            ->assertStatus(200)
            ->assertJson([])
            ->assertJsonCount(0);
    }

    /** @test */
    public function deleting_a_budget_category_that_does_not_exist_should_return_404_not_found()
    {
        $this->json('DELETE', '/api/budget/categories/1')
            ->assertStatus(404);
    }

    /** @test */
    public function creating_a_valid_subcategory_for_a_budget_category()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $this->json('POST', "/api/budget/categories/{$category->id}/subcategories", [
            'name' => 'petrol',
            'budget' => 70,
        ])
            ->assertStatus(201)
            ->assertJson([
                'budget_category_id' => $category->id,
                'name' => 'petrol',
                'budget' => 70,
            ]);
    }

    /** @test */
    public function creating_an_invalid_subcategory_returns_validation_error()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $this->json('POST', "/api/budget/categories/{$category->id}/subcategories", [
            'name' => null,
            'budget' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function viewing_all_subcategories_for_a_budget_category()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);

        $subcategory2 = $category->createSubcategory([
            'name' => 'insurance',
            'budget' => 300,
        ]);

        $this->json('GET', "/api/budget/categories/{$category->id}/subcategories")
            ->assertStatus(200)
            ->assertJson([
                [
                    'budget_category_id' => $category->id,
                    'name' => $subcategory->name,
                    'budget' => $subcategory->budget,
                ],
                [
                    'budget_category_id' => $category->id,
                    'name' => $subcategory2->name,
                    'budget' => $subcategory2->budget,
                ]
            ])
            ->assertJsonCount(2);
    }

    /** @test */
    public function viewing_a_single_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);

        $this->json('GET', "/api/budget/categories/{$category->id}/subcategories/{$subcategory->id}")
            ->assertStatus(200)
            ->assertJson([
                'budget_category_id' => $category->id,
                'name' => $subcategory->name,
                'budget' => $subcategory->budget,
            ]);
    }

     /** @test */
    public function deleting_a_budget_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);

        $this->json('GET', '/api/budget/categories/1/subcategories')
            ->assertStatus(200)
            ->assertJson([
                [
                    'name' => 'petrol',
                    'budget' => 70,
                ]
            ]);

        $this->json('DELETE', '/api/budget/categories/1/subcategories/1')
            ->assertStatus(200);

        $this->json('GET', '/api/budget/categories/1/subcategories')
            ->assertStatus(200)
            ->assertJson([])
            ->assertJsonCount(0);
    }

    /** @test */
    public function updating_a_valid_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);

        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);

        $this->json('PATCH', "/api/budget/categories/{$category->id}/subcategories/{$subcategory->id}", [
            'name' => null,
            'budget' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);

        $this->json('PATCH', "/api/budget/categories/{$category->id}/subcategories/{$subcategory->id}", [
            'name' => 'gas',
            'budget' => 90,
        ])
            ->assertStatus(200)
            ->assertJson([
                'budget_category_id' => $category->id,
                'name' => 'gas',
                'budget' => 90,
            ]);
    }

    /** @test */
    public function list_all_transactions_for_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);
        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);
        Transaction::forSubcategory($subcategory, [
            'amount' => 20,
            'description' => 'Petrol at Shell',
            'transaction_date' => today(),
        ]);
        Transaction::forSubcategory($subcategory, [
            'amount' => 25,
            'description' => 'Petrol at ECO',
            'transaction_date' => today(),
        ]);

        $this->json('GET', "/api/budget/categories/{$category->id}/subcategories/{$subcategory->id}/transactions")
            ->assertStatus(200)
            ->assertJson([
                [
                    'budget_subcategory_id' => $subcategory->id,
                    'type' => $subcategory->type(),
                    'amount' => 20,
                    'description' => 'Petrol at Shell',
                ],
                [
                    'budget_subcategory_id' => $subcategory->id,
                    'type' => $subcategory->type(),
                    'amount' => 25,
                    'description' => 'Petrol at ECO',
                ]
            ]);

    }
}
