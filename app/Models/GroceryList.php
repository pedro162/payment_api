<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroceryList extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'grocery_lists';
    protected $fillable = [
        'name',
        'total_gros_price',
        'total_discount_amount',
        'total_net_price',
        'users_create_id',
        'users_update_id',
    ];
}
