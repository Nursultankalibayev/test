@extends('admin.layouts.app')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item active">Пользователи</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Список пользователей
                    <a href="{{route('user.create')}}" class="float-right">Добавить</a>
                </div>
                <div class="card-block">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Позиция</th>
                            <th>Дата последнего входа</th>
                            <th  style="text-align: right">Редактирование</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($users))
                                @foreach($users as $item)
                                    <tr class="item-{{$item->id}}">
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->role_id == '1' ? 'Менеджер' : 'программист'}}</td>
                                        <td>{{$item->date_last_login}}</td>
                                        <td style="text-align: right">
                                            <a href="{{route('user.edit',['id'=>$item->id])}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil-square-o "></i></a>
                                            <button data-id="{{$item->id}}"  type="button" data-id="{{$item->id}}" class=" btn-trash btn btn-outline-danger btn-sm btn-trash"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination', ['pagination' => $users])
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
            url:"/admin/user/"+id,
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
</script>
@endpush
