<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

$pessoa_id = ( isset( $_REQUEST['id'] ) )? $_REQUEST['id'] : '';
$m_pessoa = new Pessoa( array('id' => $pessoa_id ) );
?>


<script src="js/pessoa.js?v=<?= filemtime('js/pessoa.js'); ?>"></script>

<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php $m_session->showRetorno(); ?>
	

		<div class="col-md-12 tituloPage">
			<h3><a href="produtos.php" style="color:white;font-weight:bold">CADASTRO DE PESSOA</a></h3>
		</div>

		<div class="col-md-12 corpoPage">

		<div class="col-md-12">
		<?php $m_pessoa->showFormulario()?>
		</div>

	</div>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>