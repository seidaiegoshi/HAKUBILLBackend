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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery_contents()
    {
        return $this->hasMany(DeliveryContent::class);
    }
}
