<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_name",
        "honorific",
        "post",
        "post_code",
        "address",
        "telephone_number",
        "fax_number"
    ];
}
