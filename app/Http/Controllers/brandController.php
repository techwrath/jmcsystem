<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class brandController extends Controller
{
    public function addBrandView()
    {
        return view('dashboard.brands');
    }
    public function addBrand(Request $request)
    {
        try{

            $request->validate([
                'brandName' => 'required|string|max:255',
                'brandDescription' => 'required|string',
                'brandLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            ]);
            DB::BeginTransaction();

           
            if($request->hasFile('brandLogo')){
                $file = $request->file('brandLogo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('dist/img'),$filename);
            }
            $brand = Brand::create([
                'brandName' => $request->input('brandName'),
                'brandDescription' => $request->input('brandDescription'),
                'brandLogo' => $filename,
            ]);
            DB::Commit();
            if($brand){
               return redirect()->route('brands')->with('success', 'Brand added successfully');
            }
            else{
                return redirect()->route('addBrandView')->withErrors('error', 'Error adding successfully');
            }
        }catch(\ErrorException $e){
            DB::rollback();
            throw new \ErrorException($e->getMessage());
              
        }
    }

    public function showBrands()
    {
        try{

            $brands = Brand::all();
            $totalBrands = $brands->count();
            return view('dashboard.brandsdataTable', compact(['brands', 'totalBrands']));

        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function deleteBrand($brandId)
    {
        try{
            $brand = Brand::find($brandId);
            if($brand)
            {
                $brand->delete();
            }
            return true;
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
            return false;
        }
    }

    public function getBrand($brandId)
    {
        try{
            $brand = Brand::find($brandId);
            if($brand)
            {
                return view('dashboard.editBrand', compact('brand'));
            }
            return false;
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
            return false;
        }
    }

    public function updateBrand(Request $request, $id)
    {
        
        $brand = Brand::findOrFail($id);

        
        $request->validate([
            'brandName' => 'required|string|max:255',
            'brandDescription' => 'required|string',
            'brandLogo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('brandLogo')){
            $file = $request->file('brandLogo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dist/img'),$filename);
        }
        $brand->brandName = $request->input('brandName');
        $brand->brandDescription = $request->input('brandDescription');
        $brand->brandLogo = $filename;
        $brand->save();

        if($brand){
            return redirect()->route('brands')->with('success', 'Brand updated successfully');
         }
         else{
             return redirect()->route('brands')->withErrors('error', 'Error updating brand');
         }
    }

}
