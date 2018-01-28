<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('budget_category_id')->index();
            $table->foreign('budget_category_id')
                ->references('id')->on('budget_categories')
                ->onDelete('cascade');
            $table->string('name');
            $table->integer('budget')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_subcategories');
    }
}
