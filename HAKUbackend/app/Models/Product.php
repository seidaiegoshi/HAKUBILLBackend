<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    // fillableかguardedどっちか1つは必ず使う

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, "product_category_id");
    }

    public function delivery_contents()
    {
        return $this->hasMany(DeliveryContent::class);
    }
    public function customer_prices()
    {
        return $this->belongsToMany(CustomerPrice::class);
    }
}
