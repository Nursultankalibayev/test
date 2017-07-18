<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use App\Notifications\RepliedToThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $status = Status::orderBy('id','asc')->get();
        if (isset($request['task'])){
            $tasks = Task::where('created_user_id',Auth::user()['id'])->where('status_id',$request['task'])->orderBy('id','desc')->paginate(20);
        }else{
            $tasks = Task::where('created_user_id',Auth::user()['id'])->orderBy('id','desc')->paginate(20);
        }
        return view('admin.index.task',compact('tasks','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row['status'] = Status::get();
        $row['users'] = User::orderBy('name','asc')->get();
        $row['type'] = Type::orderBy('name','asc')->get();
        return view('admin.create.task',compact('row'));
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
           'name'=>'required',
            'description'=>'required',
            'status_id'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            'ended_at_by_manager'=>'required'
        ]);
        $task = new Task();
        $task->name = $request['name'];
        $task->description = $request['description'];
        $task->status_id = $request['status_id'];
        $task->type_id = $request['type_id'];
        $task->user_id = $request['user_id'];
        $task->created_user_id = Auth::user()['id'];
        $task->ended_at_by_manager = strtotime($request['ended_at_by_manager']);

        if ($task->save()){

            return redirect()->route('task.edit',$task->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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
        $task = Task::find($id);
        $row['status'] = Status::get();
        $row['users'] = User::orderBy('name','asc')->get();
        $row['type'] = Type::orderBy('name','asc')->get();
        return view('admin.edit.task',compact('task','row'));
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
            'name'=>'required',
            'description'=>'required',
            'status_id'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            'ended_at_by_manager'=>'required'
        ]);

        $task = Task::find($id);
        $task->name = $request['name'];
        $task->description = $request['description'];
        $task->status_id = $request['status_id'];
        $task->type_id = $request['type_id'];
        $task->user_id = $request['user_id'];
        $task->created_user_id = Auth::user()['id'];
        $task->ended_at_by_manager = strtotime($request['ended_at_by_manager']);

        if ($task->save()){

            return redirect()->route('task.edit',$task->id)->with(['status'=> 'success','message'=>'Успешно сохранено']);

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
        Task::where('id',$id)->delete();
        $result['status'] = 'success';
        $result['message'] = 'Успешно удалено';

        return $result;
    }


    public function singleTaskFinish(Request $request)
    {
        if ($request['id']){
            Task::where('id',$request['id'])->update([
                'status_id'=>5
            ]);

            $result['status'] = 'success';
            $result['message'] = 'Успешно завершено';

            return $result;
        }
    }
}
