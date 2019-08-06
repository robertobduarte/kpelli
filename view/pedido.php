<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

$m_compra = new Compra();
//debug($_POST);

$compra = ( isset( $_REQUEST['cmp'] ) && $_REQUEST['cmp'] != '' )? $_REQUEST['cmp'] : '';

?>


<script src="js/compra.js?v=<?= filemtime('js/compra.js'); ?>"></script>

<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php $m_session->showRetorno(); ?>
	

		<div class="col-md-12 tituloPage">
			<h3>COMPRA</h3>
		</div>

		<div class="col-md-12 corpoPage">

		<div class="col-md-12">
		<?php /*$m_produto->filtroProdutos( $filtros )?>
		<?php $m_produto->buttonNovo()?>
		<?php $m_produto->listProdutos( $filtros )*/?>
		</div>

	</div>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>