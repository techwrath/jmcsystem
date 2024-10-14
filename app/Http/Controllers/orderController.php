<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\DataTables\RequisitionFormDataTable;

class orderController extends Controller
{
    public function addOrderView()
    {
      $brands = Brand::all();
      $products = Product::all();
      return view('dashboard.orders', compact(['brands','products']));

    }

    public function showOrders(OrdersDataTable $datatable)
    {
        try{

            return $datatable->render('dashboard.ordersDatatable');
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function storeOrder(Request $request)
    {
      try{ 
      // Step 1: Validate input
        $request->validate([
            'order_no' => 'required|unique:orders,order_no',
            'products' => 'required|array',
            'products.*.product_type' => 'required|string',
            'products.*.container_count' => 'required|integer',
           
        ]);

        // Step 2: Create the order
        $order = Order::create([
            'order_no' => $request->input('order_no'),
            'userId' => auth()->user()->id,
            // Add any additional order fields here
        ]);

        // Step 3: Create related products
        foreach ($request->input('products') as $productData) {
            $order->products()->create(['productType' => $productData['product_type'], // Make sure this is set
           
            'numberOfContainers' => $productData['container_count']]);
           
        }

        return response()->json(['message' => 'Order created successfully!']);
      }catch(\ErrorException $e){
        //DB::rollback();
        throw new \ErrorException($e->getMessage());
          
    }
  }

    public function getOrder($orderId)
    {
        try{
            $order = Order::with('products')->find($orderId);
            $brands = Brand::all();
            $products = Product::all();
            if (!$order) {
                throw new \ErrorException('User not found');
                return false;
            }
            else{
                return view('dashboard.editOrder', compact(['brands','products','order']));
            }
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    public function updateOrder(Request $request, $id)
    {
        try{
            $order = Order::findOrFail($id);
            $order->order_no = $request->order_no;
            $order->save();

            // Update products
            $order->products()->delete(); // Remove old products

            foreach ($request->input('products') as $productData) {
                $order->products()->create(['productType' => $productData['product_type'], // Make sure this is set
               
                
                'numberOfContainers' => $productData['container_count']]);
                
            }

            return view('dashboard.ordersDatatable')->with('success', 'Order updated successfully.');
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    public function requisitionForm()
    {
      $brands = Brand::all();
      $products = Product::all();
      return view('dashboard.requisitionForm', compact(['brands','products']));

    }
    public function requisitionDatatable(RequisitionFormDataTable $datatable)
    {
        try{

            return $datatable->render('dashboard.requisitionDatatable');
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }


}
