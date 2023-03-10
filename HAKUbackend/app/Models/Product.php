<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    // fillableかguardedどっちか1つは必ず使う
    protected $fillable = [
        "name", "cost", "unit", "tax_class", "price"
    ];

    // protected $guarded = [
    //     "id",
    //     "created_at",
    //     "updated_at",
    // ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
