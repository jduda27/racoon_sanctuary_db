<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'supply';

    protected $fillable = [
        'supply_name',
        'quantity',
        'price',
        'storage_id'
    ];

}
