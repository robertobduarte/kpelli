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



	public function listar( $filtros ){

		$filtroCategoria = ( !empty( @$filtros['categoria'] ) )? ' AND categoria = ' . $filtros['categoria'] : '';
		$filtroLinha = ( !empty( @$filtros['linha'] ) )? ' AND linha = ' . $filtros['linha'] : '';
		try {

			$sql = "SELECT * FROM ".PFX."produto WHERE id > 0" . $filtroCategoria . $filtroLinha;

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


	public function inserir( IObject $produto ){

		try{

			$sql = "INSERT INTO ".PFX."produto ( nome, categoria, linha, quantidade, preco, descricao ) 
					VALUES ( :nome, :categoria, :linha, :quantidade, :preco, :descricao )";

			$this->conex->beginTransaction();

			$query = $this->conex->prepare( $sql );
			$query->bindParam( ':nome', $produto->__get('nome') );
			$query->bindParam( ':categoria', $produto->__get('categoria') );
			$query->bindParam( ':linha', $produto->__get('linha') );
			$query->bindParam( ':quantidade', $produto->__get('quantidade') );
			$query->bindParam( ':preco', $produto->__get('preco') );
			$query->bindParam( ':descricao', $produto->__get('descricao') );

			$query->execute();

            $lastId = $this->conex->lastInsertId();         
            $this->conex->commit();

            return $lastId;

		}catch( Exception $e ){

			$this->conex->rollback();
			return false;
		}

	}



	public function editar( Iobject $produto ){

		
		try{

			$sql = "UPDATE ".PFX."produto	SET 
					nome = :nome, categoria = :categoria, linha = :linha, 
					quantidade = :quantidade, preco = :preco, descricao = :descricao
					WHERE id = :id";

			$this->conex->beginTransaction();
			$query = $this->conex->prepare( $sql );

			$query->bindParam( ':nome', $produto->__get('nome') );
			$query->bindParam( ':categoria', $produto->__get('categoria') );
			$query->bindParam( ':linha', $produto->__get('linha') );
			$query->bindParam( ':quantidade', $produto->__get('quantidade') );
			$query->bindParam( ':preco', $produto->__get('preco') );
			$query->bindParam( ':descricao', $produto->__get('descricao') );
			$query->bindParam( ':id', $produto->__get('id') );

			$query->execute();
        
            return $this->conex->commit();

		}catch( Exception $e ){

			$this->conex->rollback();
			return false;
		}

	}




}
?>