<?php

namespace App\Http\Controllers;

use App\BudgetSubcategory;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'budget_subcategory_id' => 'required',
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
        ]);

        $subcategory = BudgetSubcategory::findOrFail($request->budget_subcategory_id);
        $transaction = Transaction::forSubcategory(
            $subcategory,
            $request->except('budget_subcategory_id')
        );
        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction          $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        return response()->json($transaction->delete());
    }
}
