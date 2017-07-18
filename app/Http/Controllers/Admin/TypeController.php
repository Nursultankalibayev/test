<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('id','desc')->paginate(20);
        return view('admin.index.type',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.type');
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
            'name'=>'required|max:255'
        ]);

        $type = new Type();
        $type->name = $request['name'];

        if ($type->save()){

            return redirect()->route('type.edit',$type->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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
        $type= Type::find($id);
        return view('admin.edit.type',compact('type'));
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
            'name'=>'required|max:255'
        ]);

        $type =Type::find($id);
        $type->name = $request['name'];

        if ($type->save()){

            return redirect()->route('type.edit',$type->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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

        Type::where('id',$id)->delete();
        $result['status'] = 'success';
        $result['message'] = 'Успешно удалено';

        return $result;
    }
}
