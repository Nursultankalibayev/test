@extends('admin.layouts.app')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('type.index')}}">Типы</a></li>
        <li class="breadcrumb-item active">Изминение</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Изминение тип задач
                    <a href="{{route('type.index')}}" class="float-right">Список</a>
                </div>
                <form action="{{route('type.update',['id'=>$type->id])}}" method="POST">

                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{count($type->name) ? $type->name : ''}}" placeholder="введите имя">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                <a href="{{route('type.index')}}" class="btn btn-secondary btn-sm">Отменить</a>
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
