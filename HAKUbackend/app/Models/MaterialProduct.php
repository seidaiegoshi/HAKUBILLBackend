<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProduct extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function material()
    {
        return $this->belongsTo(Product::class, "material_id");
    }
}
