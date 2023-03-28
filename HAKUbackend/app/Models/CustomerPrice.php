<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPrice extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "customer_id",
    //     "product_id",
    //     "price",
    // ];

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
