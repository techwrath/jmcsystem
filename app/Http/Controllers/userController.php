<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function showUsers()
    {
        try{

            $users = User::all();
            $totalUsers = $users->count();

            return view('dashboard.usersDatatable', compact(['users', 'totalUsers']));

        }catch(\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        } 
    }

    public function addUserView()
    {
      
      return view('dashboard.users');

    }

    public function addUser(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'password' => 'required|min:8',
            ]);
            DB::BeginTransaction();
            $user = User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            DB::Commit();
            if($user){
                return redirect()->route('users')->with('success', 'User added successfully');
            }
            else{
                return redirect()->route('addUserView')->withErrors('error', 'Error adding user');
            }
        }catch(\ErrorException $e){
            DB::rollback();
            throw new \ErrorException($e->getMessage());
              
        }

    }

    public function getUser($userId)
    {
        try{
            $user = User::find($userId);
            
            if (!$user) {
                throw new \ErrorException('User not found');
                return false;
            }
            else{
                return view('dashboard.editUser', compact('user'));
            }
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    public function updateUser(Request $request, $userId)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'password' => 'required|min:8',
            ]);
            $user = User::find($userId);
            DB::BeginTransaction();
            $user->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))


            ]);
            DB::Commit();
            if($user){
                return redirect()->route('users')->with('success', 'User updated successfully');
            }
            else{
                return redirect()->route('getUser')->withErrors('error', 'Error updating user');
            }
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    public function deleteUser($userId)
    {
        try{
            $user = User::find($userId);
            if($user)
            {
                $user->delete();
            }
            return true;
        }catch (\ErrorException $e) {
            throw new \ErrorException($e->getMessage());
            return false;
        }
    }
}
