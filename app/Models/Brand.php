<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'brands';
    protected $fillable = [
        'id',
        'name',
        'users_create_id',
        'users_update_id',
    ];
}
