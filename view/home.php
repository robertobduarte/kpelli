<?php
include_once __DIR__ . "/../config.php";
include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/head.php";

/*$m_menu = new Menu();
$menus = $m_menu->listMenu(true);*/

//debug($_SESSION);
?>



<div class="row panel_main_page">

	<div class="col-md-12 panel_conteudo">

		<?php

			foreach ( $menus as $menu ) { ?>				

				<div class="col-md-3 col-sm-4 col-xs-6">
					<a href="<?=$menu->__get('caminho');?>">
						<div class="link_dominio">
							<!-- <img src="" class="img-responsive img-dominio" > -->
							<h3 class="label-dominio"><?=strtoupper( $menu->__get('nome') )?></h3>
						</div>
					</a>
				</div>

		<?php }	?>

	</div><!-- .panel_conteudo -->

</div><!-- .panel_main_page -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "view/footer.php"; ?>