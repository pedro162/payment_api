<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroceryListItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'grocery_list_items';
    protected $fillable = [
        'quantity',
        'unit_gross_price',
        'total_gros_price',
        'unit_net_price',
        'total_net_price',
        'unit_discount_amount',
        'total_discount_amount',
        'grocery_list_id',
        'product_id',
        'users_create_id',
        'users_update_id',
    ];
}
