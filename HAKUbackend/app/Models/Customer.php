<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "company_name",
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
}
