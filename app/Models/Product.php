<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function updateProduct($id, $name, $qtd, $price) {
        $product = Product::find($id);
        $product->name = $name;
        $product->qtd = $qtd;
        $product->price = $price;
        $product->save();
    }

    public function newProduct($name, $qtd, $price) {
        $product = new Product;
        $product->name = $name;
        $product->qtd = $qtd;
        $product->price = $price;
        $product->save();
    }
}
