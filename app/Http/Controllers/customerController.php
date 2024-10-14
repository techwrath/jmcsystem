<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\CustomersDataTable;

class customerController extends Controller
{
    public function showCustomers(CustomersDataTable $datatable)
    {
        try{

            $customers = Customer::paginate(10);
            $totalCustomers = $customers->count();
           // dd($totalCustomers);
            //return view('dashboard.customersDatatable', compact(['customers', 'totalCustomers']));

            return $datatable->render('dashboard.customerDatatable', compact('customers'));
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function addCustomerView()
    {
      
      return view('dashboard.addCustomer');

    }

    public function storeCustomer(Request $request)
    {
        try{
            $request->validate([
                'customerNumber' => 'required|string',
                'customerName' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'status' => 'required',
                'areaCode' => 'required|string',
            ]);
            DB::BeginTransaction();
            $customer = Customer::create([
                'customerNo' => $request->input('customerNumber'),
                'customerName' => $request->input('customerName'),
                'phoneNumber' => $request->input('phoneNumber'),
                'status' => $request->input('status'),
                'areaCode' => $request->input('areaCode')
            ]);
            DB::Commit();
            if($customer){
                return redirect()->route('customers')->with('success', 'Customer added successfully');
            }
            else{
                return redirect()->route('add.customer')->withErrors('error', 'Error adding customer');
            }
        }catch(\ErrorException $e){
            DB::rollback();
            throw new \ErrorException($e->getMessage());
              
        }

    }
}
