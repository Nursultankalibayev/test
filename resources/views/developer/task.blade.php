@extends('admin.layouts.app')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/developer">Dev panel</a>
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
                    <a href="/developer/task" @if(!isset(\Request::query()['task'])) style="color:red" @endif class="btn btn-sm btn-secondary" style="margin-bottom: 4px">
                        <span>Все задачи</span>
                    </a>
                    @if(count($status))
                        @foreach($status as $item)
                            <a href="/developer/task?task={{$item->id}}" @if(isset(\Request::query()['task']) && \Request::query()['task']  == $item->id) style="color: red;" @endif class="btn btn-sm btn-secondary" style="margin-bottom: 4px">
                                <span>{{$item->name}}</span>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Список задачи
                </div>

                <div class="card-block">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Тип</th>
                            <th>Дата окончания</th>
                            <th>Автор задачи</th>
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
                                    <td>{{date('d.m.Y H:i',$item->ended_at_by_manager)}}</td>
                                    <td>{{$item->getUserName($item->created_user_id)}}</td>

                                    <td style="text-align: right">
                                        <a href="/developer/task/{{$item->id}}" class="btn btn-outline-primary btn-sm">Посмотреть</a>

                                        @if(isset(\Request::query()['task']) && \Request::query()['task'] ==2)
                                            <button data-id="{{$item->id}}"  type="button" class="btn btn-outline-success btn-start">Начать</button>
                                        @endif

                                        @if(isset(\Request::query()['task']) && \Request::query()['task']  != 4 && \Request::query()['task']  != 5)
                                        <button data-id="{{$item->id}}"  type="button" class=" btn-trash btn btn-outline-danger btn-sm btn-trash btn-stopped">Завершить</button>
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
    $('.btn-start').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:"/developer/task/start/"+id,
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
    $('.btn-stopped').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:"/developer/task/stopped/"+id,
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