<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
    //
    public function index() {
        return view('admin.products.index');
    }

    public function store(Request $request) {
        dd($request);
    }
}
