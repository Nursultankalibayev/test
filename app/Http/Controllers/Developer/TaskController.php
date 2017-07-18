<?php

namespace App\Http\Controllers\Developer;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    public function getTasks(Request $request)
    {
        $status = Status::orderBy('id','asc')->get();
        if (isset($request['task'])){
            $tasks = Task::where('user_id',Auth::user()['id'])->where('status_id',$request['task'])->orderBy('id','desc')->paginate(20);
        }else{
            $tasks = Task::where('user_id',Auth::user()['id'])->orderBy('id','desc')->paginate(20);
        }

        return view('developer.task',compact('status','tasks'));
    }


    public function singleTask($id)
    {
        $task = Task::where('user_id',Auth::user()['id'])->where('id',$id)->first();
        return view('developer.single_task',compact('task'));
    }


    public function singleStartTask(Request $request)
    {
        if ($request['id']){
            Task::where('id',$request['id'])->update([
               'status_id'=>3,
                'started_at'=>time()
            ]);

            $result['status'] = 'success';
            $result['message'] = 'Успешно запушено';

            return $result;
        }
    }


    public function singleStoppedTask(Request $request)
    {
        if ($request['id']){
            Task::where('id',$request['id'])->update([
                'status_id'=>4,
                'ended_at_by_programmer'=>time()
            ]);

            $result['status'] = 'success';
            $result['message'] = 'Успешно завершено';

            return $result;
        }
    }
}
