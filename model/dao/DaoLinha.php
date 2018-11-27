<?php


class DaoLinha extends IDao{


	public function __construct(){

		parent::__construct();

	}


	public function buscar( $linha_id ){

		try {

            $sql = "SELECT * FROM ".PFX."linha WHERE id = :linha_id";
			
			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':linha_id', $linha_id );
            $query->execute(); 
            
			$linha = $query->fetch(PDO::FETCH_ASSOC);
			
			return $linha;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}



	public function listar(){

		try {

			$sql = "SELECT * FROM ".PFX."linha";

			$query = $this->conex->prepare( $sql );
			
           	$query->execute(); 
            
            $linhas = array();
			while( $linha = $query->fetch(PDO::FETCH_ASSOC) ){

				$linhas[] = $linha;
			}
			
			return $linhas;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}






}
?>