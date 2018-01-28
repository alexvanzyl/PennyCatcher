<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * A budget category can have many subcategories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(BudgetSubcategory::class);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function createSubcategory(array $data)
    {
       return $this->subcategories()->create($data);
    }
}
