<?php

class Menu extends IObject{

	protected static $instances = array();
	protected $id;
	protected $nome;
	protected $caminho;
	protected $pai;
	protected $submenu;


	public function __construct( $dados = null ){

		parent::__construct($dados);
	}


	public function getObjeto( $pessoa_id ){}


	public function listMenu( $submenu = false ){

		$daoMenu = new DaoMenu();

		$menus = $daoMenu->listMenu( $submenu );

		if( !empty( $menus ) ){

			foreach ( $menus as $value ) {
				
				$m_menu = new Menu();
				$m_menu->__set( $m_menu, $value );
				Menu::$instances[] = $m_menu; 
			}
			
		}
		return Menu::$instances;
	}






}
?>