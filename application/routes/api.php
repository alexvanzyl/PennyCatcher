<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('budget')->group(function () {
    Route::apiResource('categories', 'BudgetCategoriesController');

    Route::get(
        'categories/{category}/subcategories/{subcategory}/transactions',
        'BudgetSubcategoriesController@transactions'
    )->name('categories.subcategories.transactions');
    Route::apiResource('categories.subcategories', 'BudgetSubcategoriesController');
});

Route::apiResource('transactions', 'TransactionsController');
