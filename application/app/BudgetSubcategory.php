<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetSubcategory extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Mutate budget to cents.
     *
     * @param $value
     */
    public function setBudgetAttribute($value)
    {
        $this->attributes['budget'] = $value * 100;
    }

    /**
     * @param $value
     * @return float|int
     */
    public function getBudgetAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->category->type;
    }
}
