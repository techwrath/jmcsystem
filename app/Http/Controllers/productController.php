<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function addProductView()
    {
      $brands = Brand::all();
      return view('dashboard.products', compact('brands'));

    }
    public function addProduct(Request $request)
    {
        try{

            $request->validate([
                'productCode' => 'required|string|max:255',
                'productName' => 'required|string|max:255',
                'weightOfBag' => 'required|int',
                'productDescription' => 'required|string',
                'productType' => 'required',
                'productBrand' => 'required|string|max:255',
                'productImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            ]);
            DB::BeginTransaction();

            if($request->hasFile('productImage')){
                $file = $request->file('productImage');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('dist/img'),$filename);
            }
            
            $product = Product::create([
                'productCode' => $request->input('productCode'),
                'productName' => $request->input('productName'),
                'productDescription' => $request->input('productDescription'),
                'productBrand' => $request->input('productBrand'),
                'productType' => $request->input('productType'),
                'weightOfBag' => $request->input('weightOfBag'),
                'productImage' => $filename,
            ]);
            
           
            DB::Commit();
            if($product){
                return redirect()->route('products')->with('success', 'Product added successfully');
             }
             else{
                 return redirect()->route('addProductView')->withErrors('error', 'Error adding product');
             }

        }catch(\ErrorException $e){
            DB::rollback();
            throw new \ErrorException($e->getMessage());
              
        }
   

    }

    public function updateProduct(Request $request, $productId)
    {
        try{

            $request->validate([
                'productCode' => 'required|string|max:255',
                'productName' => 'required|string|max:255',
                'productDescription' => 'required|string',
                'productBrand' => 'required|string|max:255',
                'productImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            ]);
            DB::BeginTransaction();

            $product= Product::find($productId);
            if($request->hasFile('productImage')){
                $file = $request->file('productImage');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('dist/img'),$filename);
            }
            
            $product->update([
                'productCode' => $request->input('productCode'),
                'productName' => $request->input('productName'),
                'productDescription' => $request->input('productDescription'),
                'productBrand' => $request->input('productBrand'),
                'productImage' => $filename,
            ]);
            
           
            DB::Commit();
            if($product){
                return redirect()->route('products')->with('success', 'Product updated successfully');
             }
             else{
                 return redirect()->route('getProduct')->withErrors('error', 'Error updating product');
             }

        }catch(\ErrorException $e){
            DB::rollback();
            throw new \ErrorException($e->getMessage());
              
        }
    }

    public function getproduct($productId)
    {
        try{
            $brands = Brand::all();
            $product = Product::find($productId);
            
            if (!$product) {
                throw new \ErrorException('Product not found');
                return false;
            }
            else{
                return view('dashboard.editProduct', compact(['product','brands']));
            }
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    public function deleteProduct($productId)
    {
        try{
            $product = Product::find($productId);
            if($product)
            {
                $product->delete();
            }
            return true;
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
            return false;
        }
    }
}
