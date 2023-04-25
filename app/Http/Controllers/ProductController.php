<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        $itensPaginas = 50;
        $products = Product::paginate($itensPaginas);
        #$products = Product::all();
        $product = new Product;
        return view('products.index', ['products' => $products, 'product' => $product]);
    }

    public function new(Request $request) {
        $product = new Product;
        $product->newProduct($request->name, $request->qtd, $request->price);
        return redirect("products");
    }

    public function edit($id, Request $request) {
        $product = new Product;
        $product->updateProduct($id, $request->name, $request->qtd, $request->price);
        return redirect("products");
    }

    public function delete($id) {
        $product = Product::find($id);
        $itensPaginas = 50;

        if ($product) {
            $product->delete();

            $products = Product::paginate($itensPaginas);
            $product = new Product;
            return view('products.index', ['products' => $products, 'product' => $product])->with('success', 'Producto excluído com sucesso!');
        } else {
            $products = Product::paginate($itensPaginas);
            $product = new Product;
            return view('products.index', ['products' => $products, 'product' => $product])->with('error', 'Produto não encontrado.');
        }
    }
}
