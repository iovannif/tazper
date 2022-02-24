<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <style>
        .boton:focus, .botones:focus{
            outline: none !important;
        }

        html,#app{
            background:white;
        }

        #div_login{
            margin-top: 6%;
            background:white;
        }
        
        #div{
            width: 59%;
            margin:center;
            margin-left: 22%;
            bottom: -6px;
            /* left: 6px; */
        }

        #login{
            box-shadow: 2px 2px 7px 2px #949494;
            border: 1px solid white;
            border-radius:3px;
            padding-top:16px;
        }

        label{
            color:#3D3C3C;
            text-shadow: 0 0 0 #F3F3F3;
        }
        
        #login_cabecera{
            text-align:center;
            margin: 0 10px;
            border-color:#C9D6DF;
        }

        #descripcion{
            text-align:center;
            margin-top: 2%;
            text-shadow: 0 0 0 #F3F3F3;
            color:#7F8181;
            cursor:default;
        }

        #boton{
            background:red;
            border: 1px solid #CF0000;
            color: white;
            box-shadow: 2px 2px 4px 0px #999999;
            border-radius:4px;
            font-size:15px;
            margin-left: 9.6%;
            text-shadow: 1px 0 1px #000;
            margin-top: -9px;
        }
        #boton:hover{
            background:#CF0000;
            border:1px solid #CF0000;
        }

        #boton:focus{
            outline:none;
        }

        img{
            border-radius:50%;
            box-shadow: 1px 1px 7px 2px #999999;
            /* margin: 2px 0; */
            margin: 2px -8px 2px 0px;
        }

        .error{
            text-align:center;
            color:#EA4353;
            text-shadow: 0px 0px 1px #D9D9D9;
            margin-top: 2px;
            margin-bottom: 13px;
            cursor:default;
        }
        .err{
            color:#EA4353;
            text-shadow: 0px 0px 1px #D9D9D9;
            cursor:default;
            padding-left: 9px;
            padding-top: 7px;
        }

        .letra_input, .pass{
            font-family: Arial;
            padding-left: 11px;
            width: 76%;
            font-size:15px;
        }

        .pass{
            font-size:1.7rem;            
        }

        #ult{
            margin-bottom:30px;
        }

        .form-control{
            transition:none;
        }
    </style>
</head>

<body>   
    <div id="app">
        <div class="container" id="div_login"> 
            <div class="row">
                <div class="col-md-6 col-md-offset-3" id="div">
                    <div class="panel panel-default" id="login">
                        <div class="panel-heading" id="login_cabecera">
                            <img src="images/logo.jpg" width="150">
                        </div>                        
                        <p id="descripcion">Ingresa tus datos para acceder al sistema</p>

                        <form class="form-horizontal" method="POST" action="{{route('login')}}" spellcheck="false" autocomplete="off">
                            {{csrf_field()}}
                            <div class="form-group">
                                @if($errors->has('Usu_User'))
                                    <span class="help-block error"><strong>{{$errors->first('Usu_User')}}</strong></span> <!-- auth failed: pasa la validacion pero no encuentra los datos -->
                                @else
                                    <span class="help-block"><strong>&nbsp;</strong></span>
                                @endif
                                <label for="name" class="col-md-4 control-label">Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control letra_input" name="Usu_User" maxlength="20" value="{{old('Usu_User')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control pass" name="password" minlength="8" maxlength="20" required>
                                    @if($errors->has('password'))
                                        <span class="help-block err"><strong>{{$errors->first('password')}}</strong></span>
                                    @else
                                        <span class="help-block err"><strong>&nbsp;</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" id="ult">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn" id="boton">Iniciar sesión</button>
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

<script>
    $('.letra_input').focus();
</script>
</html>