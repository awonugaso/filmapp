<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index( ){
        $user = User::all();
        return view('customers', ['users' => $user]);
    }

    public function search( Request $request ){
        $user = User::where('user_type' , 'customer');
        if($request->name != ""){
            $user->where('name', 'LIKE', "%{$request->name}%");
        }

        if($request->age != ""){
            $user->where('dob', '>=', date('Y-m-d', strtotime("-$request->age years")));
        }

        return view('customers', ['users' => $user->get()]);
    }

    public function profile( User $user){
        return view('auth.profile', ['user' => $user]);
    }

    public function update(Request $request, User $user){
        $this->validate($request, [
            'name' => 'required|string',
            'dob' => 'required',
            'address' => 'required'
        ]);
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->update();

        return redirect()->back()->with('success', 'Profile Updated successfully.');
    }

    public function password(Request $request, User $user){
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('success', 'Password Updated successfully.');
    }

}
