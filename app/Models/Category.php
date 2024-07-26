<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'users_create_id',
        'users_update_id',
    ];
}
