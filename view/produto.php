<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

$produto_id = ( isset( $_REQUEST['pdt'] ) )? $_REQUEST['pdt'] : '';
$m_produto = new Produto( array('id' => $produto_id ) );
?>


<script src="js/produto.js?v=<?= filemtime('js/produto.js'); ?>"></script>

<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php $m_session->showRetorno(); ?>
	

		<div class="col-md-12 tituloPage">
			<h3><a href="produtos.php" style="color:white;font-weight:bold">PRODUTOS</a></h3>
		</div>

		<div class="col-md-12 corpoPage">

		<div class="col-md-12">
		<?php $m_produto->showFormulario()?>
		</div>

	</div>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>