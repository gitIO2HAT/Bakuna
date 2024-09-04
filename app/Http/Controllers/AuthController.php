<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login_admin(Request $request)
    {
        // validates the payload if it contains username and password
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        /**
         * If the validator fails, it will redirect the user back to the login page
         * with an error message and kills the whole function, preventing the code below to run.
         */
        if ($validator->fails()) {
            return redirect('/admin')->with('error', 'Please fill in all the required fields');
        }

        // catch all the validated data
        $validated = $validator->validated();

        // try to authenticate the user
        try {
            if (Auth::attempt($validated)) {
                // if the user is authenticated, it will redirect to another page

                if (Auth::user()->user_type_id == UserTypeEnum::ADMINISTRATOR) {
                    return redirect('/admin/dashboard');
                }
                Auth::logout();
                return redirect('/admin')->with('account_error', 'dsfsdf');


            } else {
                // if the user is not authenticated, it will throw an exception
                throw new \Exception('Invalid credentials');
            }



        } catch (\Exception $e) {
            // if an exception is thrown, it will redirect the user back to the login page
            return redirect('/admin')->with('error', $e->getMessage())->withInput();
        }
    }

    public function login_hp(Request $request)
    {
        // validates the payload if it contains username and password
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        /**
         * If the validator fails, it will redirect the user back to the login page
         * with an error message and kills the whole function, preventing the code below to run.
         */
        if ($validator->fails()) {
            return redirect('/login_healthcareprovider')->with('error', 'Please fill in all the required fields');
        }

        // catch all the validated data
        $validated = $validator->validated();

        // try to authenticate the user
        try {
            if (Auth::attempt($validated)) {
                // if the user is authenticated, it will redirect to another page
                if (Auth::user()->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER) {
                    return redirect('/healthcare_provider/dashboard');
                }
                Auth::logout();

                return redirect('/login_healthcareprovider')->with('account_error', 'kasjldjkldas');


            } else {
                // if the user is not authenticated, it will throw an exception
                throw new \Exception('Invalid credentials');
            }
        } catch (\Exception $e) {
            // if an exception is thrown, it will redirect the user back to the login page
            return redirect('/login_healthcareprovider')->with('error', $e->getMessage())->withInput();
        }
    }

    public function login_parent(Request $request)
    {
        // validates the payload if it contains username and password
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        /**
         * If the validator fails, it will redirect the user back to the login page
         * with an error message and kills the whole function, preventing the code below to run.
         */
        if ($validator->fails()) {
            return redirect('/login_parent')->with('error', 'Please fill in all the required fields');
        }

        // catch all the validated data
        $validated = $validator->validated();

        // try to authenticate the user
        try {
            if (Auth::attempt($validated)) {
                // if the user is authenticated, it will redirect to another page
                if (Auth::user()->user_type_id == UserTypeEnum::PARENT) {
                    return redirect('/parent/dashboard');
                }
                Auth::logout();

                return redirect('/login_parent')->with('account_error', 'asdasddas');


            } else {
                // if the user is not authenticated, it will throw an exception
                throw new \Exception('Invalid credentials');
            }
        } catch (\Exception $e) {
            // if an exception is thrown, it will redirect the user back to the login page
            return redirect('/login_parent')->with('error', $e->getMessage())->withInput();
        }
    }

    // // login function
    // public function login(Request $request)
    // {
    //     // validates the payload if it contains username and password
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     /**
    //      * If the validator fails, it will redirect the user back to the login page
    //      * with an error message and kills the whole function, preventing the code below to run.
    //      */
    //     if ($validator->fails()) {
    //         return redirect('/login')->with('error', 'Please fill in all the required fields');
    //     }

    //     // catch all the validated data
    //     $validated = $validator->validated();

    //     // try to authenticate the user
    //     try {
    //         if (Auth::attempt($validated)) {
    //             // if the user is authenticated, it will redirect to another page
    //             if (Auth::user()->user_type_id == UserTypeEnum::PARENT) {
    //                 return redirect('/parent/dashboard');
    //             } else if (Auth::user()->user_type_id == UserTypeEnum::ADMINISTRATOR) {
    //                 return redirect('/admin/dashboard');
    //             } else if (Auth::user()->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER) {
    //                 return redirect('/healthcare_provider/dashboard');
    //             }

    //         } else {
    //             // if the user is not authenticated, it will throw an exception
    //             throw new \Exception('Invalid credentials');
    //         }
    //     } catch (\Exception $e) {
    //         // if an exception is thrown, it will redirect the user back to the login page
    //         return redirect('/login')->with('error', $e->getMessage())->withInput();
    //     }
    // }

    // kill all sessions and logout the authenticated user
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
