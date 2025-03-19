<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // Business logic
        // Retourne la view index.blade.php qui est dans le dossier resources/views/products
        return view('products.index');
    }
}