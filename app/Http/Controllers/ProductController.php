<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->paginate();
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'gte:0'],
            'description' => ['required', 'string'],
        ]);

        if(Product::create($valid))
            return redirect()->route('products.index')->with('message', 'Product Added successfully');
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }



    public function update(Request $request, Product $product)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'gte:0'],
            'description' => ['required', 'string'],
        ]);

        if($product->update($valid))
            return redirect()->route('products.index')->with('message', 'Product Updated successfully');
    }


    public function destroy(Product $product)
    {
        if($product->delete())
            return redirect()->route('products.index')->with('message', 'Product Deleted successfully');
    }


    public function assignSupplierForm(Product $product)
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('products.assign-supplier', compact('product', 'suppliers'));
    }

    public function assignSupplier(Request $request, Product $product)
    {
        $valid = $request->validate([
            'supplier_id' => ['required'],
        ]);

        if($product->suppliers()->sync([$valid['supplier_id']], false))
            return redirect()->route('products.index')->with('message', 'Supplier Assigned Successfully');
    }

    public function removeSupplier(Product $product, Supplier $supplier)
    {
        if ($product->suppliers()->detach($supplier))
            return redirect()->route('products.index')->with('message', 'Supplier Removed Successfully');

        return back()->with('error', 'Something went wrong');
    }
}
