<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Models\Products;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->authorizeResource(Products::class, 'product');
    }


    public function index(Request $request)
    {   
       $query = Products::with('user');

       if((int) Auth()->user()->is_admin !== 1){
        $query->where('created_by', Auth::id());
       }
       $search = $request->input('search');
        if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
        }
        $Products = $query->paginate(15)->appends(['search' => $search]);
        return view('products.index', compact('Products'));
    }

    public function indextrash(Request $request)
    {   
       $this->authorize('viewTrashed', Products::class);
       $query = Products::onlyTrashed()->with('user');
        if((int) Auth()->user()->is_admin !== 1){
            $query->where('created_by', Auth::id());
        }
        $Products = $query->paginate(15);
        return view('products.trash', compact('Products'));
    }

    public function restore(Products $product){
        $this->authorize('restore', $product);
        if ($product->trashed()) { 
            $product->restore();
            return redirect()->route('products.index')->with('success', 'Product restored successfully.');
        }
            return redirect()
            ->route('products.trash')
            ->with('info', 'Product is not deleted.');
    }

    public function forcedelete(Products $product){
      $this->authorize('forcedelete', $product);
        if (! $product->trashed()) {
            return redirect()->route('products.trash')->with('success', 'Product is not deleted.');
        }
        $product->forceDelete();
        return redirect()
        ->route('products.trash')
        ->with('success', 'Product permanently deleted.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {   
        $userId = Auth::id();
        $validatedData = $request->validated();
        $validatedData['created_by'] = $userId;
        Products::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {  
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Products $product)
    {   
        $validatedData = $request->validated();
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Products updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {   
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Products deleted successfully.');
    }
}
