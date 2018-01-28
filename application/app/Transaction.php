<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['transaction_date'];

    /**
     * Save amount as smallest denominator (cents).
     *
     * @param $value
     * @return int
     */
    public function setAmountAttribute($value)
    {
       return $this->attributes['amount'] = $value * 100;
    }

    /**
     * Return amount as whole number.
     *
     * @param $value
     * @return float|int
     */
    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param BudgetSubcategory $subcategory
     * @param array $data
     * @return Transaction
     */
    public static function forSubcategory(BudgetSubcategory $subcategory, array $data)
    {
        $transactionData = array_merge([
            'budget_subcategory_id' => $subcategory->id,
            'type' => $subcategory->type(),
        ], $data);

        return self::create($transactionData);
    }
}
