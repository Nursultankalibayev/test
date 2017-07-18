@extends('admin.layouts.app')
@push('style')
<link href="/assets/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Пользователи</a></li>
        <li class="breadcrumb-item active">Изминение</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Изминение меню
                    <a href="{{route('user.index')}}" class="float-right">Список</a>
                </div>
                <form action="{{route('user.update',['id'=>$user->id])}}" method="POST">

                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{count($user->name) ? $user->name : ''}}" placeholder="введите имя">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{count($user->phone) ? $user->phone : ''}}"  placeholder="введите номер телефона">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Новый пароль</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="введите пароль">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="type">Позиция</label>
                                    <select id="type" name="role_id" class="form-control">
                                        <option value="1" {{$user->role_id == 1 ? 'selected' : ''}}>Менеджер</option>
                                        <option value="2" {{$user->role_id == 2 ? 'selected' : ''}}>Программист</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                <a href="{{route('user.index')}}" class="btn btn-secondary btn-sm">Отменить</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/.col-->
    </div>
    <!--/.row-->
@stop
@push('script')
<script src="/assets/js/datepicker.min.js"></script>

<script>
    @if(session('status') == 'error')
        toastr.error('{{session('message')}}');
    @endif
    @if(session('status') == 'success')
        toastr.success('{{session('message')}}');
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}');
    @endforeach
    @endif
</script>
@endpush
