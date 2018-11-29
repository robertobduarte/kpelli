<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

$m_produto = new Produto();
//debug($_POST);

$categoria = ( isset( $_REQUEST['categoria'] ) && $_REQUEST['categoria'] != 't' )? $_REQUEST['categoria'] : '';
$linha = ( isset( $_REQUEST['linha'] ) && $_REQUEST['linha'] != 't' )? $_REQUEST['linha'] : '';

$filtros = array( 
	'categoria' => $categoria, 
	'linha' => $linha 
);
?>


<script src="js/produtos.js?v=<?= filemtime('js/produtos.js'); ?>"></script>

<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php $m_session->showRetorno(); ?>
	

		<div class="col-md-12 tituloPage">
			<h3>PRODUTOS</h3>
		</div>

		<div class="col-md-12 corpoPage">

		<div class="col-md-12">
		<?php $m_produto->filtroProdutos( $filtros )?>
		<?php $m_produto->listProdutos( $filtros )?>
		</div>

	</div>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>