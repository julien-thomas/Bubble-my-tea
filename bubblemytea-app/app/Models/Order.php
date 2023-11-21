<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_price',
        'total_qty',
    ];

    public static function getOrders($user_id) {
        $orders = DB::table('orders')
                    //->join('products', 'order_details.product_id', '=', 'products.id')
                    ->select('*')
                    ->where('user_id', $user_id)
                    ->get();
        return $orders;
    }
}
