<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "publish_date",
    ];
}
