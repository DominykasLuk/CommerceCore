<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return $products;
    }

    public function addProduct(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
         
        ]);

        Product::create($validatedData);

        return['message' => 'Product Created'];
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'cc_number' => 'required|min:16|max:16',
            'cc_expiration' => 'required',
            'cvv' => 'required',
            'price' => 'required'

        ]);

        Checkout::create($validatedData);

        return['message' => 'Checkout Created'];

    }

    public function checkouts(){
        $checkout = Checkout::all();
        return $checkout;
    }
}
