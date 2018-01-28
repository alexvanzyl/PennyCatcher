<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\BudgetSubcategory;
use Illuminate\Http\Request;

class BudgetSubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\BudgetCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function index(BudgetCategory $category)
    {
        return response()->json($category->subcategories);
    }

    /**
     * List all transactions for a subcategory
     *
     * @param BudgetCategory $category
     * @param BudgetSubcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function transactions(BudgetCategory $category, BudgetSubcategory $subcategory)
    {
        return response()->json($subcategory->transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetCategory       $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BudgetCategory $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $subcategory = $category->createSubcategory($request->all());

        return response()->json($subcategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetCategory     $category
     * @param  \App\BudgetSubcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetCategory $category, BudgetSubcategory $subcategory)
    {
        return response()->json($subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetCategory       $category
     * @param  \App\BudgetSubcategory    $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetCategory $category, BudgetSubcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $subcategory->update($request->all());

        return response()->json($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetCategory     $category
     * @param  \App\BudgetSubcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetCategory $category, BudgetSubcategory $subcategory)
    {
        return response()->json($subcategory->delete());
    }
}
