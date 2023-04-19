<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function show() {
        return view('products.show');
    }

    public function create() {
        return view('products.create');
    }

    public function new() {

    }

    public function edit() {
        return view('products.edit');
    }

    public function delete($id) {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return view('products.index')->with('success', 'Producto excluído com sucesso!');
        } else {
            return view('products.index')->with('error', 'Produto não encontrado.');
        }
    }
}
