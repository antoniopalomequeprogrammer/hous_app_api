
@extends('layout.app')

@section('title', 'Validación de usuario')

@section('style')
    <style media="screen">
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #892647;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top: 10%">
        <div class="row">
            <div class="col-md-12 min-vh-100 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <div class="card rounded shadow shadow-sm">
                            <div class="card-header">
                                <h3 class="mb-0">
                                    Cambio de contraseña
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div style="display: none; margin-top: 10px" id="success" class="alert alert-success" role="alert">
                                        Contraseña modificada
                                    </div>
                                    <div style="display: none; margin-top: 10px" id="error" class="alert alert-danger" role="alert">Se ha producido un error, el enlace puede no ser válido</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname1">Contraseña</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="uname1" id="pwd1" required="">
                                    <div style="display: none; margin-top: 10px" id="pwd1-error" class="alert alert-danger" role="alert"></div>
                                </div>
                                <div class="form-group">
                                    <label>Repite Contraseña</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="pwd2" required="" autocomplete="new-password">
                                </div>
                                <input type="hidden" id="token" value="{{$token}}">
                                <input type="hidden" id="email" value="{{$email}}">
                                <div class="form-group">
                                    <button class="btn btn-success btn-lg float-right" id="btnLogin">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="row" style="margin: 0px">
            <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10"></div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" style="color: #ffffff; font-family: Gotham; font-size: 18px; text-align: center; font-weight: 700; ">Imdeco {{ now()->year }}</div>
        </div>
    </footer>
@endsection
@section('script')
    <script type="text/javascript">

        $(function(){
            $("#btnLogin").click(function(event) {
                if (validateForm()) {
                    $.ajax({
                        url: '{{route('resetPass')}}',
                        type: 'POST',
                        data: {
                            "password": $("#pwd1").val(),
                            "password_confirmation": $("#pwd1").val(),
                            "email": $("#email").val(),
                            "token": $("#token").val()
                        },
                        success: function(data){
                            $("#success").css('display', '');
                            $("#btnLogin").unbind('click');
                            window.location.href = 'https://subvenciones.imdcordoba.es/';
                        },
                        error: function(){
                            $("#error").css('display', '');
                        }
                    });
                }
            });

            function validateForm(){
                $("#pwd1-error, #success, #error").css('display', 'none');
                if ($("#pwd1").val().length < 8 || $("#pwd2").val().length < 8) {
                    $("#pwd1-error").css('display', '');
                    $("#pwd1-error").text('La contraseña debe ser mayor a 8 caracteres');
                    return false;
                }

                if ($("#pwd1").val() != $("#pwd2").val()) {
                    $("#pwd1-error").css('display', '');
                    $("#pwd1-error").text('Las contraseñas deben ser iguales');
                    return false;
                }

                return true;
            }
        })
    </script>
@endsection
