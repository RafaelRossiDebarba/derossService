<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_product';

    public function newProduct($id, $product_id, $qtd, $price) {
        $product = new OrderProduct;
        $product->order_id = $id;
        $product->product_id = $product_id;
        $product->qtd = $qtd;
        $product->price = $price;
        $product->save();
    }

    public function editProduct($id, $qtd, $price) {
        $product = OrderProduct::find($id)->first();
        $product->qtd = $qtd;
        $product->price = $price;
        $product->save();
    }
}
