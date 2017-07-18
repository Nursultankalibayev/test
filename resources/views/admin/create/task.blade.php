@extends('admin.layouts.app')
@push('style')
<link href="/assets/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Администрация</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('task.index')}}">Задачи</a></li>
        <li class="breadcrumb-item active">Добавление задачи</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Добавление задачи
                    <a href="{{route('task.index')}}" class="float-right">Список</a>
                </div>
                <form action="{{route('task.store')}}" method="POST">
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
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea id="description" name="description" rows="9" class="form-control my-editor" placeholder="Content.."></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="type">Статус</label>
                                    <select id="type" name="status_id" class="form-control">
                                        @if(count($row['status']))
                                            @foreach($row['status'] as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="type">Статус</label>
                                    <select id="type" name="type_id" class="form-control">
                                        @if(count($row['type']))
                                            @foreach($row['type'] as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="type">Пользователь</label>
                                    <select id="type" name="user_id" class="form-control">
                                        @if(count($row['users']))
                                            @foreach($row['users'] as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="timepicker-actions-exmpl">Дата окончание</label>
                                    <input type="datetime" data-time-format=' hh:ii:00'  id="timepicker-actions-exmpl"  name="ended_at_by_manager" class="form-control" >
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                <a href="{{route('task.index')}}" class="btn btn-secondary btn-sm">Отменить</a>
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

<script type="text/javascript">

    @if(session('status') == 'error')
        toastr.error('{{session('message')}}');
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}');
    @endforeach
    @endif

    var editor_config = {
        path_absolute : "/",
        selector: ".my-editor",
        height:"400px",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);

    // Зададим стартовую дату
    var start = new Date(),
        prevDay,
        startHours = 9;

    // 09:00
    start.setHours(9);
    start.setMinutes(0);

    // Если сегодня суббота или воскресенье - 10:00
    if ([6,0].indexOf(start.getDay()) != -1) {
        start.setHours(10);
        startHours = 10
    }

    $('#timepicker-actions-exmpl').datepicker({
        timepicker: true,
        startDate: start,
        minHours: startHours,
        maxHours: 18,
        onSelect: function(fd, d, picker) {
            // Ничего не делаем если выделение было снято
            if (!d) return;

            var day = d.getDay();

            // Обновляем состояние календаря только если была изменена дата
            if (prevDay != undefined && prevDay == day) return;
            prevDay = day;

            // Если выбранный день суббота или воскресенье, то устанавливаем
            // часы для выходных, в противном случае восстанавливаем начальные значения
            if (day == 6 || day == 0) {
                picker.update({
                    minHours: 10,
                    maxHours: 16
                })
            } else {
                picker.update({
                    minHours: 9,
                    maxHours: 18
                })
            }
        }
    })
</script>
@endpush