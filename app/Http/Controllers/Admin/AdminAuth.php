<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminAuth extends Controller
{
    public function login() {

      
              return view('admin.login');

    }




   public function dologin(){
 // $new_admin = new admin();
 //        $new_admin->name      ='name';
 //        $new_admin->password =bcrypt('123');
 //        $new_admin->email     ='1ahmad.burro@gmail.com';
 //        $new_admin->save();
$rememberme = request('rememberme')==1?true:false;

  if (auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')],$rememberme)){
     return redirect('admin');

    }else {
/*           session()->flash('error',trans('admin.in1'));
*/            return redirect('admin/login');

       
    }

}





    public function logout(){
        Auth::logout();// log the user out of our application
        return redirect('admin/login'); // redirect the user to the login screen
    }


    public function forgot_password(){

    	return view('admin.forgot_password');

   } 



    public function index(){
 $Admins = Admin::all();  

    return view('admin.home', compact('Admins'));

   } 

 public function forgot_password_post(){
$admin =Admin::where('email',request('email'))->first();
if (!empty($admin)) {
	$token = app('auth.password.broker')->createToken($admin);
	      $data =DB::table('password_resets')->insert([
	      	  'email'      => $admin->email,
	      	  'token'      => $token,
	      	  'created_at'  => Carbon::now(),
	      ]);

	return new AdminResetPassword(['data'=>$admin,'token'=>$token]);                   

}
return back();
   } 





}
