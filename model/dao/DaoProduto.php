<?php


class DaoProduto extends IDao{


	public function __construct(){

		parent::__construct();

	}


	public function buscar( $produto_id ){

		try {

            $sql = "SELECT * FROM ".PFX."produto WHERE id = :produto_id";
			
			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':produto_id', $produto_id );
            $query->execute(); 
            
			$produto = $query->fetch(PDO::FETCH_ASSOC);
			
			return $produto;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}



	public function listar(){

		try {

			$sql = "SELECT * FROM ".PFX."produto";

			$query = $this->conex->prepare( $sql );
			
           	$query->execute(); 
            
            $produtos = array();
			while( $produto = $query->fetch(PDO::FETCH_ASSOC) ){

				$produtos[] = $produto;
			}
			
			return $produtos;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}






}
?>