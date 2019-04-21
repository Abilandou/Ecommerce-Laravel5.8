<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Session;


class AdminController extends Controller
{
    //
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            //Let admin login details come from admin table
            $adminCount = Admin::where([
                                'user_name'=>$data['user_name'],
                                'password'=>md5($data['password']),
                                'status'=>1
                            ])->count();

            if($adminCount > 0){
            // if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // echo "Success";
                // die;

                Session::put('adminSession', $data['user_name']); //This make sure all access to dashboard must pass through admin login
                return redirect('/admin/dashboard');
            }
            else{
                // echo "Failed";
                // die;
                return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard(){

        //check if current person trying to login has a session on this dashboard
        // if(Session::has('adminSession')){
        //     //perform all dashboard tasks

        // }else{
        //     return redirect('/admin')->with('flash_message_error', 'Please login to access dashboard');
        // }
        return view('admin.dashboard');
    }

    public function settings(){
        $adminDetails = Admin::where(['user_name'=>Session::get('adminSession')])->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        // $current_password = $data['current_pwd'];
        // $check_password =  Admin::where(['user_name'=>Session::get('adminSession')])->first();
        $adminCount = Admin::where([
            'user_name'=>Session::get('adminSession'),
            'password'=>md5($data['password'])
        ])->count();

        if($adminCount == 1){
            echo "true"; die;
        }else {
            echo "false"; die;
        }

        // if(Hash::check($current_password, $check_password->password)){
        //     echo "true"; die;
        // }else {
        //     echo "false"; die;
        // }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // $check_password = User::where(['email'=> Auth::user()->email])->first();
            // $current_password = $data['current_pwd'];

            $adminCount = Admin::where([
                'user_name'=>Session::get('adminSession'),
                'password'=>md5($data['password'])
            ])->count();

            // if(Hash::check($current_password, $check_password->password)){

            if($adminCount == 1){
                $password = md5($data['new_pwd']);
                Admin::where('user_name',Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password updated Successfully!');
            }
            else{
                 return redirect('/admin/settings')->with('flash_message_error', 'Incorrect current password or input field empty!!');
            }
        }
    }

    public function logout(){
        Session::flush();
        return;
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

}
