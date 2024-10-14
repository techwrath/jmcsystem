<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\DataTables\ProductsDataTable;
use App\DataTables\BrandsDataTable;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\newPasswordMail;

class adminController extends Controller
{
    public static function getNotifications()
    {
        try{
            $notifications = Notification::where('isRead', 0)->get();
           // dd($notifications);
            $totalNotifications = $notifications->count();
            return ['notifications', 'totalNotifications'];
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function index()
    {
        try{
            // $notifications = Notification::where('isRead', '0')->get();
            // $totalNotifications = $notifications->count();
            return view('dashboard.index');
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    
    public function showProducts()
    {
        try{

            $products = Product::all();
            $totalProducts = $products->count();
            $brands = Brand::all();

            return view('dashboard.productsDatatable', compact(['products','brands', 'totalProducts']));

        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function showBrands(BrandsDataTable $dataTable)
    {
        try{

            $brands = Brand::all();

           // dd($brands);
            return $dataTable->render('dashboard.brands', compact('brands'));

        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function getNotification($notificationId)
    {
        try{
            
            $notification = Notification::find($notificationId);
            if (!$notification) {
                throw new \ErrorException('Product not found');
                return false;
            }
            else{
               return $notification;
            }
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }


    public function changePassword(Request $request, $notificationId)
    {
        try{
            $request->validate([
                 'changePassword' => [
                    'required',
                    'string',
                    'min:8',
                ],
            ]);
            $notification = Notification::find($notificationId);
            $senderEmail = $notification->senderEmail;
            
            $user = User::where('email', $senderEmail)->first();
            $password = $request->input('changePassword');
            $user->update([
                'password' => Hash::make($password),
            ]);
            if($user){
                $notification->update([
                    'isRead' => "1",
                ]);
              $this->sendPasswordToUser($password, $senderEmail);
            }
            return true;

        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    protected function sendPasswordToUser($password, $email)
    {
        try{

            $mailData = [
                'title' => 'Mail From JMC System',
                'body' => $password,
            ];

                Mail::to($email)->send(new newPasswordMail($mailData));

               // return redirect('forgot-password')->with('success', 'Email sent successfully.');
            
           
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
        
    }
}
