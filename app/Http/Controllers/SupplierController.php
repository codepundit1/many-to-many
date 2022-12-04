<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::latest()->paginate();
        return view('suppliers.index', compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');

    }


    public function store(Request $request)
    {
         $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:5,255', 'unique:suppliers'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        if(Supplier::create($valid))
            return redirect()->route('suppliers.index')->with('message', 'Supplier Added successfully');
    }


    public function show(Supplier $supplier)
    {
        //
    }


    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));

    }


    public function update(Request $request, Supplier $supplier)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:5,255', 'unique:suppliers,phone,' . $supplier->id],
            'address' => ['required', 'string', 'max:255'],
        ]);

        if($supplier->update($valid))
            return redirect()->route('suppliers.index')->with('message', ' Supplier Updated successfully');
    }


    public function destroy(Supplier $supplier)
    {
        if($supplier->delete())
            return redirect()->route('suppliers.index')->with('message', 'Supplier Deleted successfully');
    }

    public function assignProductForm(Supplier $supplier)
    {
        // dd('ok');
        $products = Product::orderBy('name')->get();
        return view('suppliers.assign-product', compact('supplier', 'products'));
    }

    public function assignProduct(Request $request, Supplier $supplier)
    {
        $valid = $request->validate([
            'product_id' => ['required'],
        ]);

        if($supplier->products()->sync([$valid['product_id']], false))
            return redirect()->route('suppliers.index')->with('message', 'Product Assigned Successfully');
    }

    public function removeProduct(Supplier $supplier, Product $product)
    {
        if ($supplier->products()->detach($product))
            return redirect()->route('suppliers.index')->with('message', 'Product Removed Successfully');

        return back()->with('error', 'Something went wrong');
    }
}
