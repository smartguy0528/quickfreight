<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get a User with ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Create or Update Manager Data
     *
     * @param Request $request
     * @return Redirector
     */
    public function userSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $msg = "";

            if(!$request->id) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->information = $request->information;
                $user->role = 1;
                $user->password = '$2y$10$GYCwtTFJmUsAK1R7Njw1p.ALaKluQBVoaitYwSzMeTqE2SLZ8Ts7.';
                $user->save();

                $msg = "User information created successfully.";
            } else {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->information = $request->information;
                $user->save();

                $msg = "User information updated successfully.";
            };

            return redirect()->back()
                ->withSuccess($msg);
        };
    }

    /**
     * Delete User Data
     *
     * @param Request $request
     * @return Redirector
     */
    public function userDelete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect()->back()
                ->withErrors(["message" =>"User data deleted successfully."]);
    }

    /**
     * Change Password of Authenticated User
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function passUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        } else {
            $user = Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()
                ->withSuccess("Password is changed successfully.");
        }
    }
}
