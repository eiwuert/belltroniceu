<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/settings/settings.css" rel="stylesheet">
    <link href="css/settings/font-style.css" rel="stylesheet">
    
    <script type="text/javascript" src="/js/jquery.js"></script>    
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/settings/admin.js"></script>
    <!-- Colors CSS -->
    <link href="css/colors.css" rel="stylesheet">
    
    
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   

  	<!-- Google Fonts call. Font Used Open Sans & Raleway -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
     
     <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Belltronic</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/simcard">Simcards</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/finanzas">Finanzas</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/cartera">Cartera</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/settings"><span class="glyphicon glyphicon-cog"></span></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/auth/logout"><span class="glyphicon glyphicon-off"></span></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">

	  <!-- FIRST ROW OF BLOCKS -->     
        <div class="row" style="margin-top:20px">

            <!-- USER PROFILE BLOCK -->
            <div class="col-sm-8">
                <div class="dash-unit" style="height:385px">
        	        <dtitle>Mi Perfil</dtitle>
        	      	<hr>
        			<h1>{{$user->name}}</h1>
        			@if($user->isAdmin)
        			    <h3>Administrador</h3>
        			@else
        			    <h3>Usuario</h3>
        			@endif
        			<p align="center"> Para actualizar el correo o la contraseña debe ingresar la contraseña actual.</p>
        			<div style=text-align:center>
            			<input type="email" id ="user_email" placeholder="Email" value="{{$user->email}}">
            			<input type="password" id="user_password" placeholder="Contraseña actual">
            			<input type="password" id ="user_new_password" placeholder="Nueva Contraseña">
            			<button style="margin-bottom:10px" onClick="actualizar_usuario()">Guardar</button>
        			</div>
                </div>
            </div>
            
            <!-- NEW USER BLOCK -->
            <div class="col-sm-4">
                <div class="dash-unit" style="height:385px">
                    @if(!$user->isAdmin)
                    <div class ="onlyAdmin">
                        <h3 class="center">SOLAMENTE ADMINISTRADOR</h3>
                    </div>
                    @endif
        	        <dtitle>Crear Distribuidor</dtitle>
        	      	<hr>
        			<h3>Ingresa el nombre del distribuidor.</h3>
        			<p style="margin-top:30px;padding-left:15px;padding-right:15px" align="justify">La clave de ingreso por defecto es 'password'. Adicionalmente, se creará un subdistribuidor con el mismo nombre.</p>
        			<div style="text-align:center; margin-top:20px">
        			    <input type="text" id="new_user_name" style="margin-top:5px" placeholder="Nombre">
            			<input type="email" id ="new_user_email" placeholder="Email">
            			<div class="switch switch-blue" style="margin-bottom:10px">
        					<input type="radio" class="switch-input" name="view" value="on" id="on" checked="">
        					<label for="on" class="switch-label switch-label-off">Administrador</label>
        					<input type="radio" class="switch-input" name="view" value="off" id="off">
        					<label for="off" class="switch-label switch-label-on">Usuario</label>
        					<span class="switch-selection"></span>
        				</div>
            			<button style="margin-bottom:10px;margin-top:10px" onClick="crear_usuario()">Crear</button>
        			</div>
                </div>
            </div>
        </div>
        
        <div class="row">

        <!-- USER PROFILE BLOCK -->
            <div class="col-lg-12">
          	    <div class="dash-unit">
    	      	    <dtitle>Distribuidores</dtitle>
    	      		<hr>
    	      		<h3>Administra tus subdistribuidores.</h3>
        			<p style="margin-top:30px;padding-left:15px;padding-right:15px" align="justify">Modifica los nombres de tus subdistribuidores y dale click a guardar. Si quieres eliminar uno, solo debes darle click al boton que aparece al lado derecho.</p>
        			<hr>
    	      		@if($user->isAdmin)
    	      		    @foreach($distribuidores as $distribuidor)
        	      		    <div>
        	      		        <input class="orange_text" type="text" value="{{$distribuidor->name}}" style="width:200px;border:none;margin-top:0px"></input>
        	      		        <a style="float:right;margin-right:50px"><i class="fa fa-times fa-2x"></i></a>
    	      		        </div>
    	      		        <hr style="margin-top:20px">
    	      		        @foreach($subdistribuidores[$distribuidor->name] as $subdistribuidor)
    	      		            <div class="flex_container">
        	      		            <input type="text" style="margin-top:0px;width:200px;border:none" value="{{$subdistribuidor->nombre}}"></input>
        	      		            <a style="margin-left:10px"><i class="fa fa-times fa-2x"></i></a>
    	      		            </div>
    	      		            <br>
    	      		        @endforeach
    	      		        <hr style="margin-top:0px">
    	      		    @endforeach
    	      		    <div style="text-align:center">
        	      		    <button style="margin-bottom:20px;margin-top:10px" onClick="actualizar_subdistris()">Guardar</button>
    	      		    </div>
    	      		@else
    	      		    <div>
    	      		        <input class="orange_text" type="text" value="{{$user->name}}" style="width:200px;border:none;margin-top:0px"></input>
    	      		        <a style="float:right;margin-right:50px"><i class="fa fa-times fa-2x"></i></a>
	      		        </div>
	      		        <hr style="margin-top:20px">
	      		        @foreach($subdistribuidores as $subdistribuidor)
	      		            <div class="flex_container">
    	      		            <input type="text" style="margin-top:0px;width:200px;border:none" value="{{$subdistribuidor->nombre}}"></input>
    	      		            <a style="margin-left:10px"><i class="fa fa-times fa-2x"></i></a>
	      		            </div>
	      		            <br>
	      		        @endforeach
	      		        <hr style="margin-top:0px">
    	      		    <div style="text-align:center">
        	      		    <button style="margin-bottom:20px;margin-top:10px" onClick="actualizar_subdistris()">Guardar</button>
    	      		    </div>
    	      		@endif
                </div>
            </div>
        </div>
        
	</div> <!-- /container -->
	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<logo class="logo">Belltronic</logo>
      			<p>Desarrollado y mantenido por <span class="mySpan">Stiven Avila</span></p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->
    
    <!--------------------------------------MODALS------------------------------------------------->
    <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id ="modal-tittle"></h3>
                </div>
                <div class="modal-body">
                    <p id ="modal-body"></p>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="js/settings/settings.js"></script>    
</body></html>