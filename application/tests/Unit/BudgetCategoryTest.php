<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_subcategory()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'name' => 'car',
            'type' => 'expense'
        ]);

        $subcategory = $category->createSubcategory([
            'name' => 'petrol',
            'budget' => '70',
        ]);

        $this->assertEquals($category->id, $subcategory->budget_category_id);
        $this->assertEquals('petrol', $subcategory->name);
    }
}
