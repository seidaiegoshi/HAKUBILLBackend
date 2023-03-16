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
}
