<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'mother_name',
        'birth_date',
        'cpf',
        'cns',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
