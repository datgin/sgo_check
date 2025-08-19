<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'origin',
        'product_code',
        'production_date',
        'guarantee',
        'other_information',
        'short_description',
        'image',
    ];

    protected $casts = [
        'production_date'   => 'date',
        'other_information' => 'array',
    ];

    public function files()
    {
        return $this->hasMany(BillFile::class);
    }
}
