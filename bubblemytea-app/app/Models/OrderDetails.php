<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];
    public static function getOrderDetails($id) {
        $orders = DB::table('order_details')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->select('products.name','products.picture', 'order_details.*')
                    ->where('order_id', $id)
                    ->get();
        return $orders;
    }
}
