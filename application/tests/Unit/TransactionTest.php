<?php

namespace Tests\Unit;

use App\Transaction;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function amount_should_be_saved_as_cents()
    {
        factory(\App\Transaction::class)->create([
            'amount' => 238.89
        ]);

        $this->assertDatabaseHas('transactions', ['amount' => 23889]);
    }

    /** @test */
    public function amount_should_be_returned_as_whole_value()
    {
        $transaction = factory(\App\Transaction::class)->create([
            'amount' => 238.89
        ]);

        $this->assertDatabaseHas('transactions', ['amount' => 23889]);
        $this->assertEquals(238.89, $transaction->amount);
    }

    /** @test */
    public function creating_transaction_for_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense',
        ]);
        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => 70,
        ]);
        $transaction = Transaction::forSubcategory($subcategory, [
            'amount' => 20,
            'description' => 'Petrol at Shell',
            'transaction_date' => Carbon::parse('2018-01-01'),
        ]);

        $this->assertArraySubset([
            'budget_subcategory_id' => $subcategory->id,
            'type' => $subcategory->type(),
            'amount' => 20,
            'description' => 'Petrol at Shell',
            'transaction_date' => Carbon::parse('2018-01-01')->toDateTimeString(),
        ], $transaction->toArray());
    }
}
