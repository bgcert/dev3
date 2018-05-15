<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('users.settings');
    }

    public function getUserData()
    {
    	$user = \App\User::find(\Auth::id());
    	return ($user->company) ? $user->load('company') : $user;
    }

    public function setName()
    {
    	$user = \App\User::find(\Auth::id());
    	$user->name = request()->name;
    	$user->save();

    	return $user->name;
    }

    // Maybe putting part of this in user/company model should be better!
    public function setPublisher()
    {
    	$user = \App\User::find(\Auth::id());
    	if (request()->publisher) {
    		$company = $user->company()->updateOrCreate([], request()->all());

    		if (!$company->company_detail) {
    			$company->company_detail()->create();
    		}

    		if ($company->exists) {
				$user->role_id = 2;
				$user->save();
				return 'data is saved and the user is publisher now';
			}
			return 'error, data not saved';
    	}

   		$user->role_id = 1;
   		$user->save();
   		return 'user is NOT publisher now';
    }

    public function changePassword() {
        if (!(Hash::check(request()->old_password, \Auth::user()->password))) {
            // The passwords matches
            //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            return response()->json(['error' => 'Your current password does not matches with the password you provided. Please try again.']);
        }
 
        if(strcmp(request()->old_password, request()->new_password) == 0){
            //Current password and new password are same
            return response()->json(['error' => 'New Password cannot be same as your current password. Please choose a different password.']);
        }
 
        $validatedData = request()->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validatedData) {
        	//Change Password
	        $user = \Auth::user();
	        $user->password = Hash::make(request()->new_password);
	        $user->save();
	        return response()->json(['success' => 'Password changed successfully!']);
        }
 		
 		return response()->json(['error' => 'There was an error.']);
    }
}
