<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::orderBy('id','desc')->paginate(20);
        return view('admin.index.status',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.status');
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

        $status = new Status();
        $status->name = $request['name'];

        if ($status->save()){

            return redirect()->route('status.edit',$status->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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
        $status = Status::find($id);
        return view('admin.edit.status',compact('status'));
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

        $status =Status::find($id);
        $status->name = $request['name'];

        if ($status->save()){

            return redirect()->route('status.edit',$status->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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

        Status::where('id',$id)->delete();
        $result['status'] = 'success';
        $result['message'] = 'Успешно удалено';

        return $result;
    }
}
