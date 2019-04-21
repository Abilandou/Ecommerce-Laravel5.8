<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use Session;

use App\User;
use App\Cart;

use App\Country;


class UsersController extends Controller
{
    //

    public function userLoginRegister(){
        $meta_title = "login-register";
        return view('users.login_register')->with(compact('meta_title'));
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //Check if user exits
            $countUser = User::where('email',$data['email'])->count();
            if($countUser > 0){
                return redirect()->back()->with('flash_message_error', 'Sorry email already taken, try another');
            }else {
                $user = new User();
                $user ->name = $data['name'];
                $user -> email = $data['email'];
                $user -> password = bcrypt($data['password']);
                $user->save();

                //Send Register Email
                // $email = $data['email'];
                // //Message to send
                // $messageData = ['email'=>$data['email'], 'name'=>$data['name']];
                // //As laravel to send mail
                // Mail::send('emails.register', $messageData, function($message) use ($email){
                //     $message->to($email)->subject('Registration with my ecommerce website');
                // });


                // if( count(Mail::failures()) > 0 ) {
                //     echo "Failure in sending registration email. Some problems can be: <br />";

                //     foreach(Mail::failures() as $email_address) {
                //         echo " - $email_address <br />";
                //     }
                 
                // }else{
                //     echo "Check your account an email hase been sent.";
                // }//Send Registration email ends here

                //Send User Confirmation email to activate their account.

                $email = $data['email'];
                $messageData = ['email'=>$data['email'], 'name'=>$data['name'], 'code'=>
                    base64_encode($data['email'])];//Use base 64 base encoding to send activation code to user email
                
                //Finnally send the confirmation mail
                Mail::send('emails.confirmation', $messageData, function($message) use ($email){
                    $message->to($email)->subject('Confirm Your Email Account at E-Commerce site');
                });
                return redirect()->back()->with('flash_message_successs', 'Account Taken, Please check your email to activate your account ');



                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                    Session::put('frontSession', $data['email']);                    
                    return redirect('/cart');
                }    

            }

        }    

    }

    public function confirmAccount(Request $request, $email){
    
        //Decode user email bac to actual email that was encoded to show activation code
        $email = base64_decode($email);
        //chech if user email exists in user table
        $userCount = User::where('email',$email)->count();
        if($userCount > 0){
            //verify user status and redirect accordingly
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login_register')->with('flash_message_success', 'Email Account Activated already, Login to your account');
            }else{
                User::where('email',$email)->update(['status'=>1]); //Update user status to 1 to activate account

                //Send Users Welcome Email after activating their account
                //Message to send
                $messageData = ['email'=>$email, 'name'=>$userDetails->name];
                //As laravel to send mail
                Mail::send('emails.welcome', $messageData, function($message) use ($email){
                    $message->to($email)->subject('Account Activated Welcome to ecommerce website');
                });

                return redirect('login_register')->with('flash_message_success', 'Email Account activated, you can login now');
            }
        }else{
            abort(404);
        }
        
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);

            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error','Maybe Your account is disabled or Not activated
                     <br/>You can follow the steps below to resolve the issue.<br/>
                     Please contact admin.<br/>Login to Your Email Account and Activate account for this site.');
                }

                Session::put('frontSession', $data['email']);

                if(empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                Cart::where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }

                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error', 
                        'Check Your Email to activate your account. <br/>Invalid user email or password.<br/> Make sure account is activated');
            }
        }
    }

    public function resetUserPassword(Request $request){
       
        if($request->isMethod('post')){
            $data = $request->all();
            $emailEntered = $data['email'];
            // echo "<pre>"; print_r($data);die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('flash_message_error', 'Sorry the email '.$emailEntered.' Does not exists on this site, please try another, or verify that your emaill is spelled correctly');
            }
            //Get User Details
            $userDetails = User::where('email',$data['email'])->first();

            //Generate Random Password and give to User
            $random_password = str_random(8);

            //Encode password for security
            $new_password = bcrypt($random_password);

            //Update Password
            User::where('email', $data['email'])->update(['password'=>$new_password]);

            //Send Email to user for password reset
            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'name'=>$name,
                'email'=>$email, 
                'password'=>$random_password
            ];
            //Finally send the mail
            Mail::send('emails.user_reset_password_mail', $messageData, function($message)use($email){
                $message->to($email)->subject('New Password From Ecom-Site');
            });

            //Verify email submition
            if( count(Mail::failures()) > 0 ) {
                echo "Failure in sending New Password. Some problems can be: <br />";

                foreach(Mail::failures() as $email) {
                    echo " - $email <br />";
                }
              
            }else{
                return redirect()->back()->with('flash_message_success', 'Check Your account a New Password email has been sent');
            }//Send email reset password ends here
        }
        $meta_title = "reset password";
        return view('users.forgot_password')->with(compact('userDetails', 'meta_title'));
    }

    public function checkUserPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $current_password = $data['current_password'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;

        }else{
            echo "false"; die;
        }
    }

    public function checkEmail(Request $request){
        $data = $request->all();
         //Check if user exits
         $countUser = User::where('email',$data['email'])->count();
         if($countUser > 0){
            echo "false";
         }else{
             echo "true"; die;
         }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession'); 
        Session::forget('session_id');
        return redirect('/');
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        // echo "<pre>"; print_r($userDetails); die; 
        //get all countries first
        $allCountries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect('/account')->with('flash_message_success', 'Your account details updated');
        }

        $meta_title = "user Account";
        return view('users.account')->with(compact('allCountries', 'userDetails', 'meta_title'));
    }

    public function updateUserPassword(Request $request){
        
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $old_password = User::where('id',Auth::User()->id)->first();
            $current_password = $data['current_password'];
            if(Hash::check($current_password,$old_password->password)){
                //Update password
                $new_password = bcrypt($data['new_password']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_password]);
                return redirect()->back()->with('flash_message_success', 'Password updated successfully!');

            }else{
                return redirect()->back()->with('flash_message_error', 'Sorry current password incorrect');
            }
        }
    }

    public function viewAllUsers(){
        $allUsers = User::get();
        $allUsers = json_decode(json_encode($allUsers));
        // echo "<pre"; print_r($allUsers); die;
        $meta_title = "all users";
        return view('admin.users.view_users')->with(compact('allUsers', 'meta_title'));
    }

    public function deleteUser($id = null){
        if(!empty($id)){
            User::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'User deleted successfully');
        }

    }


}
