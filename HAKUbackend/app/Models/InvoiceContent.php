<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceContent extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "invoice_id",
    //     "product_id",
    //     "quantity",
    // ];

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
