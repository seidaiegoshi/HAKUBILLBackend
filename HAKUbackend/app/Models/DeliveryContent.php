<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "delivery_slip_id",
        "product_id",
        "quantity",
    ];

    public function delivery_slip()
    {
        return $this->belongsTo(DeliverySlip::class);
    }
}
