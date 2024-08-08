<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemFile extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'system_files';
    protected $fillable = [
        'id',
        'full_path',
        'reference_id',
        'reference',
        'users_create_id',
        'users_update_id'
    ];
}
