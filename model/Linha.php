<?php

class Linha extends IObject{

	protected static $instances = array();
	protected $id;
	protected $nome;
	


	public function __construct( $dados = null ){

		parent::__construct($dados);
	}


	public function getObjeto( $linha_id ){

		$daoLinha = new DaoLinha();

		$linha = $daoLinha->buscar( $linha_id );
		$this->__set( $this, $linha );

	}


	
	public function listar() {

		$daoLinha = new DaoLinha();

		$dados = $daoLinha->listar();


		foreach ($dados as $value) {
			
			$m_linha = new Linha();
			$m_linha->__set( $m_linha, $value );
			$this::$instances[] = $m_linha;   

		}
		return $this::$instances;
	}






}
?>