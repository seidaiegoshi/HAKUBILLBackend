<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $fillable = [
    //     "name",
    //     "honorific",
    //     "post",
    //     "post_code",
    //     "address",
    //     "telephone_number",
    //     "fax_number"
    // ];

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function delivery_slips()
    {
        return $this->hasMany(DeliverySlip::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function customer_prices()
    {
        return $this->hasMany(CustomerPrice::class);
    }
}
