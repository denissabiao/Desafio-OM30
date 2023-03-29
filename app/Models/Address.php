<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'zip_code',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state'
    ];
}
