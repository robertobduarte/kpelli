<?php


class DaoMenu extends IDao{


	public function __construct(){

		parent::__construct();

	}


	public function listMenu( $submenu = false ){

		$filtroSubMenu = ( $submenu )? " WHERE submenu = 'N' " : '';
		try {

			$sql = "SELECT * FROM ".PFX."menu" . $filtroSubMenu;

			$query = $this->conex->prepare( $sql );
			
           	$query->execute(); 
            
            $menus = array();
			while( $menu = $query->fetch(PDO::FETCH_ASSOC) ){

				$menus[] = $menu;
			}
			
			return $menus;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}






}
?>