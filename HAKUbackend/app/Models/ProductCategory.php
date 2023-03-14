<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "name"
    // ];

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
