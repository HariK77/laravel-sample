<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword() {

        return view('auth.passwords.change');

    }

    public function updatePassword(Request $request) {

        $user = Auth::user();

        $request->validate([
            'current_password' => ['required',
                function ($attribute, $value, $fail) {
                    if (!(Hash::check($value, Auth::user()->password))) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
            'new_password' => ['required','string', 'min:6',
                function ($attribute, $value, $fail) use ($request) {
                    if(strcmp($request->current_password, $request->new_password) == 0){
                        return $fail(__('The current password should not be same as new password.'));
                    }
                }
            ],
            'password_confirmation' => 'required|same:new_password'
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');

    }
}
