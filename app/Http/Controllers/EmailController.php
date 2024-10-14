<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\forgotPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\User;
class EmailController extends Controller
{
    public function index( Request $request)
    {
        try{
            $request->validate([
              'email' => 'required|email',
            ]);

            $mailData = [
                'title' => 'Mail From JMC System',
                'body' => $request->input('email'),
            ];

            $sender = $request->input('email');
            $senderId = User::select('id')->where('email', $sender);
            
            

            $emailExists = DB::table('users')->where('email', $request->input('email'))->exists();
            if ($emailExists) {
                Mail::to('hafsa.rehmanawan@gmail.com')->send(new forgotPasswordMail($mailData));

                DB::beginTransaction(); 
  
                    $notification = Notification::create([
                    //'senderId' => $senderId,
                    'senderEmail' => $sender,
                    'title' => 'Change Password Request',
                    ]);
                        
                DB::commit();  
                
                return redirect('forgot-password')->with('success', 'Email sent successfully.');
            }
            else{
                return redirect('forgot-password')->withErrors(['error'=> 'Email is not registered.']);
            }
        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
        
    }

    public function forgotPasswordView()
    {
        return view('auth.forgotPassword.forgotPasswordView');
    }
    
}
