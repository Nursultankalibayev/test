<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table ='tasks';
    protected $guarded =['id'];

    public function getStatus($id)
    {
        $status = Status::where('id',$id)->first();

        return $status->name;
    }

    public function getType($id)
    {
        $type = Type::where('id',$id)->first();

        return $type->name;
    }

    public function getUserName($id)
    {
        $user_name = User::where('id',$id)->first();

        return $user_name->name;
    }
}
