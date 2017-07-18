<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(20);

        return view('admin.index.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'phone'=>'required|unique:users',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            'role_id'=>'required'
        ]);

        $user_item = new User();
        $user_item->name = $request['name'];
        $user_item->phone = $request['phone'];
        $user_item->password = bcrypt($request['password']);
        $user_item->token = md5(str_random(10));
        $user_item->date_last_login = date("Y-m-d H:i:s");
        $user_item->created_at = date("Y-m-d H:i:s");
        $user_item->role_id = $request['role_id'];

        if ($user_item->save()){

            return redirect()->route('user.edit',$user_item->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

        }else{

            return redirect()->back()->with(['status'=>'error','message'=>'Ошибка при сохранений']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit.user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'phone'=>'required',
            'role_id'=>'required'
        ]);

        $user_item = User::find($id);
        $user_item->name = $request['name'];
        $user_item->phone = $request['phone'];
        if (count($request->password)) $user_item->password = bcrypt($request['password']);
        $user_item->token = md5(str_random(10));
        $user_item->updated_at = date("Y-m-d H:i:s");
        $user_item->role_id = $request['role_id'];

        if ($user_item->save()){

            return redirect()->route('user.edit',$user_item->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

        }else{

            return redirect()->back()->with(['status'=>'error','message'=>'Ошибка при сохранений']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        $result['status'] = 'success';
        $result['message'] = 'Успешно удалено';

        return $result;

    }
}
