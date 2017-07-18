@extends('admin.layouts.app')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item active">Задачи</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="div" style="display: flex;">
                    <p style="margin: 5px">Сортировка :</p>
                    <a href="/admin/task" class="btn btn-sm btn-secondary" style="margin-bottom: 4px">
                        <span>Все задачи</span>
                    </a>
                    @if(count($status))
                        @foreach($status as $item)
                            <a href="/admin/task?task={{$item->id}}" @if(isset(\Request::query()['task']) && \Request::query()['task']  == $item->id) style="color: red;" @endif class="btn btn-sm btn-secondary" style="margin-bottom: 4px">
                                <span>{{$item->name}}</span>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Список задачи
                    <a href="{{route('task.create')}}" class="float-right">Добавить задачу</a>
                </div>

                <div class="card-block">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Тип</th>
                            <th>Исполнитель</th>
                            <th>Дата окончания</th>
                            <th  style="text-align: right">Редактирование</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tasks))
                            @foreach($tasks as $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->getStatus($item->status_id)}}</td>
                                    <td>{{$item->getType($item->type_id)}}</td>
                                    <td>{{$item->getUserName($item->user_id)}}</td>
                                    <td>{{date('d.m.Y H:i',$item->ended_at_by_manager)}}</td>

                                    <td style="text-align: right">
                                        <a href="{{route('task.edit',['id'=>$item->id])}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil-square-o "></i></a>
                                        <button data-id="{{$item->id}}"  type="button" class=" btn-trash btn btn-outline-danger btn-sm btn-trash"><i class="fa fa-trash-o"></i></button>
                                        @if(isset(\Request::query()['task']) && \Request::query()['task'] != 5)
                                            <button data-id="{{$item->id}}"  type="button" class=" btn btn-success btn-sm btn-finish">Закрыть</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if(count($tasks))
                        @include('admin.layouts.pagination', ['pagination' => $tasks])
                    @endif
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
    <!--/.row-->
@stop
@push('script')
<script>
    $('.btn-trash').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:"/admin/task/"+id,
            type: "POST",
            data:{
                "_token" : "{{csrf_token()}}",
                "_method" : "DELETE",
                "id":id
            },success:function(data){
                $('.item-'+id).hide();
                if(data['status'] =='success'){
                    toastr.success(data['message']);

                }else{
                    toastr.error(data['message']);
                }

            }
        });

    });
    $('.btn-finish').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:"/admin/task/finish/"+id,
            type: "POST",
            data:{
                "_token" : "{{csrf_token()}}",
                "id":id
            },success:function(data){
                $('.item-'+id).hide();
                if(data['status'] =='success'){
                    toastr.success(data['message']);

                }else{
                    toastr.error(data['message']);
                }

            }
        });

    });
</script>
@endpush
