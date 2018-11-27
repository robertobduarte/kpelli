<?php

class Categoria extends IObject{

	protected static $instances = array();
	protected $id;
	protected $nome;
	


	public function __construct( $dados = null ){

		parent::__construct($dados);
	}


	public function getObjeto( $categoria_id ){

		$daoCategoria = new DaoCategoria();

		$categoria = $daoCategoria->buscar( $categoria_id );
		$this->__set( $this, $categoria );

	}


	
	public function listar() {

		$daoCategoria = new DaoCategoria();

		$dados = $daoCategoria->listar();


		foreach ($dados as $value) {
			
			$m_categoria = new Categoria();
			$m_categoria->__set( $m_categoria, $value );
			$this::$instances[] = $m_categoria;   

		}

		return $this::$instances;
	}






}
?>