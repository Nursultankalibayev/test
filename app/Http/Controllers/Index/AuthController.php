<?php
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    public function getLogin()
    {
       return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {

        if (Auth::check()){
            if (Auth::user()['role_id'] == 1){
                return redirect('/admin');
            }elseif(Auth::user()['role_id'] == 2){
                return redirect('/developer');
            }
            else{
                return redirect('login');
            }
        }
        if (isset($request['phone'])){
           if(Auth::attempt(['phone'=>$request['phone'],'password'=>$request['password']])){
                $user_item = User::where('phone','=',$request['phone'])->first();
                if (count($user_item)){
                    $user_item->date_last_login = date("Y-m-d H:i:s");
                    $user_item->save();
                }
                return redirect('/admin');
            }
            else{
                return view('admin.auth.login',[
                    'phone' => $request['phone'],
                    'error'=>'Неправильный логин или пароль'
                ]);
           }
       }else {
            return view('admin.auth.login', [
                'phone' => '',
                'error' => 'Неправильный логин или пароль'
            ]);
        }
    }


}