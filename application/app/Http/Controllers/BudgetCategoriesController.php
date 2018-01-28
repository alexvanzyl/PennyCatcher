<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;

class BudgetCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(BudgetCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $category = BudgetCategory::create($request->all());

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  BudgetCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetCategory $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BudgetCategory            $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetCategory $category)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $category->update($request->all());

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BudgetCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetCategory $category)
    {
        return response()->json($category->delete());
    }
}
