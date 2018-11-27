<?php

class Produto extends IObject{

	protected static $instances = array();
	protected $id;
	protected $nome;
	protected $categoria;
	protected $m_categoria;
	protected $linha;
	protected $m_linha;
	protected $quantidade;
	protected $unidMedida;
	


	public function __construct( $dados = null ){

		parent::__construct($dados);
	}


	public function getObjeto( $produto_id ){

		$daoProduto = new DaoProduto();

		$produto = $daoProduto->buscar( $produto_id );
		$this->__set( $this, $produto );

	}

	public function getCategoria( $categoria_id = '' ){

		$categoria = ( !empty( $categoria_id ) )? $categoria_id : $this->__get('categoria');

		$this->m_categoria = new Categoria( array( 'id' => $categoria ) );

	}

	public function getLinha( $linha_id = '' ){

		$linha = ( !empty( $linha_id ) )? $linha_id : $this->__get('linha');

		$this->m_linha = new Linha( array( 'id' => $linha ) );

	}


	
	public function listar() {

		$daoProduto = new DaoProduto();

		$dados = $daoProduto->listar();


		foreach ($dados as $value) {
			
			$m_produto = new Produto();
			$m_produto->__set( $m_produto, $value );
			$this::$instances[] = $m_produto;   

		}
	}
	
	public function listProdutos() {

		$this->listar();

		if( !empty( $this::$instances ) ){

    		echo '<table class="table table-striped" id="">';

	    		echo '<thead>';
	    			echo '<th>Id</th>';
	    			echo '<th>Nome</th>';
	    			echo '<th>Categoria</th>';
	    			echo '<th>Linha</th>';
	    		echo '</thead>';

	    		echo '<tbody>';

	    			foreach ( $this::$instances as $produto ) {

	    				$produto->getCategoria();	    				
	    				$produto->getLinha();	    				
	    			
		    			echo '<tr id="tr_' . $produto->__get('id'). '">';
		    				echo '<td>' . $produto->__get('id') . '</td>';
		    				echo '<td><a href="produto.php?pdt=' . $produto->__get('id') . '" class="" >' . $produto->__get('nome') . '</a></td>';
		    				echo '<td>' . $produto->__get('m_categoria')->__get('nome') . '</td>';		    				
		    				echo '<td>' . $produto->__get('m_linha')->__get('nome') . '</td>';		    				
		    			echo '</tr>';

	    			}

	    		echo '</tbody>';

    		echo '</table>';

    	}else{

    		echo '<div class="col-md-12 alert alert-warning"><p>Não existem produtos cadastrados.</p></div>';
    	}

	}

	public function filtroProdutos(){

		$this->m_categoria = new Categoria();
		$categorias = $this->m_categoria->listar();

		$this->m_linha = new Linha();
		$linhas = $this->m_linha->listar();

		echo '<div class="col-md-12 col-sm-12 col-xs-12">';
			echo '<form id="listProdutos" action="produtos.php" method="post">';

				echo '<div class="col-md-4">';
					echo '<div class="form-group" id="">';
						echo '<label>Categoria</label>';
							echo '<select class="form-control" id="categoria" name="categoria">';
								echo "<option value='t'>Todas</option>";
								foreach ( $categorias as $m_categoria ) {
									echo "<option value='" . $m_categoria->__get('id') . "'>" . $m_categoria->__get('nome') . "</option>";
								}
							echo '</select>';
						echo '</div>';
					echo '</div>';

				echo '<div class="col-md-4">';
					echo '<div class="form-group" id="">';
						echo '<label>Linha</label>';
							echo '<select class="form-control" id="linha" name="linha">';								
								echo "<option value='t'>Todas</option>";
								foreach ( $linhas as $m_linha ) {
									echo "<option value='" . $m_linha->__get('id') . "'>" . $m_linha->__get('nome') . "</option>";
								}
							echo '</select>';
						echo '</div>';
					echo '</div>';

			echo '</form>';
		echo '</div>';

	}





}
?>