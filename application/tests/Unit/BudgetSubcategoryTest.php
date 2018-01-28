<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetSubcategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function budget_should_be_saved_as_cents()
    {
        /**
         * To avoid foreign key constraints errors the a category must exist
         * during the migration. The reference to the budget category's id
         * should also match when making reference to it on the
         * subcategory's 'budget_category_id' tabled field.
         **/
        factory(\App\BudgetSubcategory::class)->create([
            'budget' => 200.23
        ]);

        $this->assertDatabaseHas('budget_subcategories', ['budget' => 20023]);
    }

    /** @test */
    public function budget_should_be_returned_as_whole_value()
    {
        $subcategory = factory(\App\BudgetSubcategory::class)->create([
            'budget' => 200.23
        ]);

        $this->assertDatabaseHas('budget_subcategories', ['budget' => 20023]);
        $this->assertEquals(200.23, $subcategory->budget);
    }

    /** @test */
    public function a_subcategorys_type_property_should_return_the_parent_category_type()
    {
        $category = factory(\App\BudgetCategory::class)->create([
            'type' => 'income',
        ]);
        $subcategory = $category->createSubcategory([
            'name' => 'Salary',
        ]);

        $this->assertEquals($category->type, $subcategory->type());
    }
}
