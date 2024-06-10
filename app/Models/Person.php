<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'people';
    protected $fillable = [
        'id',
        'name',
        'document',
        'person_type',
        'users_create_id',
        'users_update_id',
    ];
}
