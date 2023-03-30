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

    public function products()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function materials()
    {
        return $this->belongsTo(Material::class, "material_id");
    }
}
