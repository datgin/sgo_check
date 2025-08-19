<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'file_path',
    ];
}
