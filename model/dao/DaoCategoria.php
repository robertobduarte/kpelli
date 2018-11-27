<?php


class DaoCategoria extends IDao{


	public function __construct(){

		parent::__construct();

	}


	public function buscar( $categoria_id ){

		try {

            $sql = "SELECT * FROM ".PFX."categoria WHERE id = :categoria_id";
			
			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':categoria_id', $categoria_id );
            $query->execute(); 
            
			$categoria = $query->fetch(PDO::FETCH_ASSOC);
			
			return $categoria;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}



	public function listar(){

		try {

			$sql = "SELECT * FROM ".PFX."categoria";

			$query = $this->conex->prepare( $sql );
			
           	$query->execute(); 
            
            $categorias = array();
			while( $categoria = $query->fetch(PDO::FETCH_ASSOC) ){

				$categorias[] = $categoria;
			}
			
			return $categorias;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}






}
?>