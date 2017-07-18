@extends('admin.layouts.app')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('status.index')}}">Статусы</a></li>
        <li class="breadcrumb-item active">Добавление</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Добавление статусов
                    <a href="{{route('status.index')}}" class="float-right">Список</a>
                </div>
                <form action="{{route('status.store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="введите название">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                <a href="{{route('status.index')}}" class="btn btn-secondary btn-sm">Отменить</a>
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
<script type="text/javascript">

    @if(session('status') == 'error')
        toastr.error('{{session('message')}}');
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}');
    @endforeach
    @endif
</script>
@endpush