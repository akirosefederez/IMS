<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $users = User::paginate(10);
                return view('admin.users.index', compact('users'));
                break;
        }
    }

    public function editPassword(){
    if(!Auth::user()->role_as == '1'){
        return redirect()->back()->with('error', 'Access denied! You have no admin privilege.');
    } else
  return view('admin.changepassword');
}

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>['required', 'string','min:8','same:password']
        ]);
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);

        if($currentPasswordStatus){

                User::findOrFail(Auth::user()->id)->update([
                    'password' => Hash::make($request->password),
                ]);
                return redirect()->back()->with('message','Password updated successfully');

        }else{
            return redirect()->back()->with('error','Current Password does not match with Old Password');
        }
    }
}
