<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        @yield('title')
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/utilities/utilities.css"/>
        <link rel="stylesheet" href="/css/base.css"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <title>Login</title>
    
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
    	<link rel="stylesheet" href="/css/auth/form-elements.css">
        <link rel="stylesheet" href="/css/auth/login.css">
        
        <!-- Colors CSS -->
        <link href="/css/colors.css" rel="stylesheet">
        
        <!-- Custom Fonts -->
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1 style="text-align:center">Bienvenido a <strong>Belltronic</strong></h1>
                            <div class="description">
                            	<p style="text-align:center;font-size:18px">Portal empesarial de Belltronic para monitoreo de progreso.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Ingresa a tu portal</h3>
                            		<p>Digita tu correo y contraseña para ingresar:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                     <form method="POST" style="margin-bottom:20px" action="/auth/login" class="login-form">
			                        {!! csrf_field() !!}
			                    	<div class="form-group">
			                        	<input type="email" name="email" placeholder="Correo..." value="{{ old('email') }}" class="form-username form-control" id="username">
			                        </div>
			                        <div class="form-group">
			                        	<input type="password" name="password" placeholder="Contraseña..." class="form-password form-control" id="password">
			                        </div>
			                        <button type="submit" class="btn">Ingresar!</button>
			                    </form>
			                     <a class="page-scroll" id ="remember" data-target="#recordar_contraseña" data-toggle="modal" href="#recordar_contraseña">Recordar Contraseña</a>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js" crossorigin="anonymous"></script>
        <script src="/js/jquery.backstretch.min.js"></script>
        
        <!-- Javascript -->
        <script src="/js/auth/login.js"></script>
        
        <div id="recordar_contraseña" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id ="modal-tittle"></h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/password/reset">
                        {!! csrf_field() !!}
                    
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    
                        <div>
                            Email
                            <input class="data" type="email" name="email" value="{{ old('email') }}">
                        </div>
                    
                        <div>
                            <button class ="button" type="submit">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>