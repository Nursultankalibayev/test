@extends('admin.auth.layout')
@section('content')
    <div class="col-md-8">
        <div class="card-group mb-0">
            <div class="card p-4">
                <div class="card-block">
                    <h1>Авторизация</h1>
                    <p class="text-muted">Войдите в свою учетную запись</p>
                    <form action="/login" method="POST">
                        {{csrf_field()}}
                        <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                            <input type="text" name="phone" id="phone" required class="form-control" placeholder="Номер телефона">
                        </div>
                        <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                            <input type="password" name="password" required class="form-control" placeholder="Пароль">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">Войти</button>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="btn btn-link px-0">Забыли пароль?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                <div class="card-block text-center">
                    <div>
                        <h2>Регистрация</h2>
                        <p>Системы управления сайтами</p>
                        <a href="/register" class="btn btn-primary active mt-3">Зарегистрируйтесь Сейчас!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script type="text/javascript">
    jQuery(function($){
        $("#phone").mask("+7 (999) 999-9999");
    });
    @if(isset($error))
        toastr.error('{{$error}}');
        toastr.options.timeOut = 3000;
    @endif
</script>
@endpush