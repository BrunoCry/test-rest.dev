<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * Fillable fields of this model
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'client_id', 'summ'
    ];
}
