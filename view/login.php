<?php
include_once __DIR__ . "/../config.php";

$m_session = new Session();


$divMsg = '';
if( @$m_session->getValue( 'login', true ) === false ){
	$divMsg .= '<div id="erro" class="alert alert-danger" role="alert">';
		$divMsg .= '<p class="text-center" id="textoErro">CPF ou senha inválidos.</p>';
	$divMsg .= '</div>';
}
?>



<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="UTF-8">
		<title><?=APP?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/jquery-ui.css" rel="stylesheet">
		<link href="css/jquery-ui.theme.css" rel="stylesheet">
		<link href="css/jquery-ui.structure.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
		<link href="css/sistema.css?v=<?= filemtime('css/sistema.css'); ?>" rel="stylesheet">

		<!-- JS -->		
		<script src="js/jquery-3-2-1.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/sistema.js?v=<?= filemtime('js/sistema.js'); ?>"></script>
	
	</head>

	<body>

		<nav class="navbar navbar-default navbar-fixed-top navKpelli">	
			<nav class="faixa"></nav>
			<div class="container">

				<div class="navbar-header">	
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>			
					<a class="navbar-brand" href="<?php echo '/'. APP ?>"><img height='30px' src="img/kpelli.png" alt="" class=""></a>
				</div>
				<div class="collapse navbar-collapse col-md-8 col-sm-12" id="menu">				
					<ul class="nav navbar-nav">					
					</ul>				
				</div><!-- /.navbar-collapse -->			
				
			</div>
		</nav>


		<div class="container-fluid" id="panel_main">
			<div class="container corposistema">

				<div class="row">
							
					<div class="col-md-4 col-md-offset-4" style="margin-top:100px">
						
						<div id="divLogin" class="panel">
							<div class="panel-body">
										
								<form id="login" name="login" method="post" action="checkLogin.php">
									
									<div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon" id=""><i class="fa fa-user"></i></span>
										  <input id="usu" name="usu" type="text" class="form-control" placeholder="Usuário">
										</div>									
									</div>
									
									<div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon" id=""><i class="fa fa-lock"></i></span>
										  <input id="senha" name="senha" type="password" class="form-control" placeholder="senha">
										</div>									
									</div>
									
									<button class="btn btn-sm btn-default center-block" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>
									
								</form>
										
							</div>
						</div>

						<?=$divMsg;?>

					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>