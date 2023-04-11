<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index() {
        return view('products.index');
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

    public function delete() {
        
    }
}
