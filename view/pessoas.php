<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

$m_pessoa = new Pessoa();
//debug($_POST);

$nome = ( isset( $_REQUEST['nome'] ) )? $_REQUEST['nome'] : '';
$filtros = array( 'nome' => $nome );
?>


<script src="js/pessoas.js?v=<?= filemtime('js/pessoas.js'); ?>"></script>

<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php $m_session->showRetorno(); ?>
	

		<div class="col-md-12 tituloPage">
			<h3>CADASTRO DE PESSOAS</h3>
		</div>

		<div class="col-md-12 corpoPage">

		<div class="col-md-12">
		<?php $m_pessoa->filtroPessoas( $filtros )?>
		<?php $m_pessoa->listPessoas( $filtros )?>
		</div>

	</div>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>