@extends('admin.layouts.app')
@push('style')
<link href="/assets/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/developer">Dev panel</a>
        </li>
        <li class="breadcrumb-item active">Задача</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>Задача
                    <a href="/developer/task" class="float-right">Список</a>
                </div>
                <div class="card-block">
                    <p><b>Задача</b></p>
                    {!! $task->name!!}
                    <hr>
                    <p  style="margin-top: 30px;" ><b>Тип</b></p>
                    {!! $task->getType($task->type_id)!!}
                    <hr>
                    <p  style="margin-top: 30px;" ><b>Срок оканчание</b></p>
                    {{date('d.m.Y H:i',$task->ended_at_by_manager)}}
                    <hr>
                    <p style="margin-top: 30px;"><b>Описания</b></p>
                    {!! $task->description !!}
                    <hr>
                    <p style="margin-top: 30px;"><b>Автор задачи</b></p>
                    {!! $task->getUserName($task->created_user_id) !!}
                </div>
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
