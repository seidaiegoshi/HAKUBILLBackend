<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryContent extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "delivery_slip_id",
    //     "product_id",
    //     "quantity",
    // ];

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function delivery_slip()
    {
        return $this->belongsTo(DeliverySlip::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
