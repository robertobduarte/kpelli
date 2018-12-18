<?php


class DaoPessoa extends IDao{


	public function __construct(){

		parent::__construct();

	}


	public function buscar( $pessoa_id ){

		try {

            $sql = "SELECT * FROM ".PFX."pessoa WHERE id = :pessoa_id";
			
			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':pessoa_id', $pessoa_id );
            $query->execute(); 
            
			$pessoa = $query->fetch(PDO::FETCH_ASSOC);
			
			return $pessoa;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}



	public function listar( $filtros ){

		$filtroNome = ( !empty( @$filtros['nome'] ) )? ' WHERE nome like "%' . $filtros['nome'] . '%"': '';

		try {

			$sql = "SELECT * FROM ".PFX."pessoa" . $filtroNome;

			$query = $this->conex->prepare( $sql );
			
           	$query->execute(); 
            
            $pessoas = array();
			while( $pessoa = $query->fetch(PDO::FETCH_ASSOC) ){

				$pessoas[] = $pessoa;
			}
			
			return $pessoas;

        }catch( Exception $e){

			$this->conex->rollback();
            $this->falha( $this->conex->errorInfo() );
		}
        
	}



	public function inserir( IObject $pessoa ){

		try{

			$sql = "INSERT INTO ".PFX."pessoa ( nome, email, cpf, telefone, celular, endereco, cidade, observacao ) 
					VALUES ( :nome, :email, :cpf, :telefone, :celular, :endereco, :cidade, :observacao )";

			$this->conex->beginTransaction();

			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':nome', $pessoa->__get('nome') );
			$query->bindParam( ':email', $pessoa->__get('email') );
			$query->bindParam( ':cpf', $pessoa->__get('cpf') );
			$query->bindParam( ':telefone', $pessoa->__get('telefone') );
			$query->bindParam( ':celular', $pessoa->__get('celular') );
			$query->bindParam( ':endereco', $pessoa->__get('endereco') );
			$query->bindParam( ':cidade', $pessoa->__get('cidade') );
			$query->bindParam( ':observacao', $pessoa->__get('observacao') );

			$query->execute();

            $lastId = $this->conex->lastInsertId();         
            $this->conex->commit();

            return $lastId;

		}catch( Exception $e ){

			$this->conex->rollback();
			return false;
		}

	}



	public function editar( Iobject $pessoa ){

		/*echo '<pre>';
		print_r($pessoa);
		echo '</pre>';
		exit();*/

		try{

			$sql = "UPDATE ".PFX."pessoa SET 
					nome = :nome, email = :email, cpf = :cpf, 
					telefone = :telefone, celular = :celular, endereco = :endereco, cidade = :cidade, observacao = :observacao
					WHERE id = :id";

			$this->conex->beginTransaction();
			$query = $this->conex->prepare( $sql );

			$query->bindParam( ':nome', $pessoa->__get('nome') );
			$query->bindParam( ':email', $pessoa->__get('email') );
			$query->bindParam( ':cpf', $pessoa->__get('cpf') );
			$query->bindParam( ':telefone', $pessoa->__get('telefone') );
			$query->bindParam( ':celular', $pessoa->__get('celular') );
			$query->bindParam( ':endereco', $pessoa->__get('endereco') );
			$query->bindParam( ':cidade', $pessoa->__get('cidade') );
			$query->bindParam( ':observacao', $pessoa->__get('observacao') );
			$query->bindParam( ':id', $pessoa->__get('id') );

			$query->execute();
        
            return $this->conex->commit();

		}catch( Exception $e ){

			$this->conex->rollback();
			return false;
		}

	}



}
?>