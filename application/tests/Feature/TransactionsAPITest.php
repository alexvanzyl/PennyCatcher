<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionsAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_valid_transaction()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'Active Income',
            'type' => 'income',
        ]);
        $subcategory = $category->createSubcategory([
            'name' => 'Salary',
            'budget' => 1000,
        ]);

        $this->json('POST', 'api/transactions', [
            'budget_subcategory_id' => $subcategory->id,
            'description' => null,
            'amount' => 234.56,
            'transaction_date' => '2018-01-12'
        ])
            ->assertStatus(201)
            ->assertJson([
                'budget_subcategory_id' => $subcategory->id,
                'type' => $subcategory->type(),
                'description' => null,
                'amount' => 234.56,
                'transaction_date' => Carbon::parse('2018-01-12'),
            ]);
    }
    
    /** @test */
    public function creating_an_invalid_transaction_gives_validation_errors()
    {
        $this->json('POST', 'api/transactions', [
            'budget_subcategory_id' => null,
            'description' => null,
            'amount' => null,
            'transaction_date' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'budget_subcategory_id',
                'amount',
                'transaction_date'
            ]);
    }

    /** @test */
    public function updating_a_transaction()
    {
        $transaction = factory(\App\Transaction::class)->create();

        $this->json('PATCH', "api/transactions/{$transaction->id}", [
            'amount' => 3000,
            'description' => 'Went shopping'
        ])
            ->assertStatus(200)->assertJson([
                'id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => 3000,
                'description' => 'Went shopping'
            ]);
    }

    /** @test */
    public function deleting_a_transaction()
    {
        $transaction = factory(\App\Transaction::class)->create();

        $this->json('DELETE', "api/transactions/{$transaction->id}")->assertStatus(200);
    }
}
