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
                            	<p style="text-align:center">Portal empesarial de Belltronic para monitoreo de progreso.</p>
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
			                     <form method="POST" action="/auth/login" class="login-form">
			                        {!! csrf_field() !!}
			                    	<div class="form-group">
			                        	<input type="email" name="email" placeholder="Correo..." value="{{ old('email') }}" class="form-username form-control" id="username">
			                        </div>
			                        <div class="form-group">
			                        	<input type="password" name="password" placeholder="Contraseña..." class="form-password form-control" id="password">
			                        </div>
			                        <button type="submit" class="btn">Ingresar!</button>
			                    </form>
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
    </body>
</html>