<?php

class Produto extends IObject{

	protected static $instances = array();
	protected $controller = '../controller/controllerProduto.php';
	protected $id;
	protected $nome;
	protected $categoria;
	protected $m_categoria;
	protected $linha;
	protected $m_linha;
	protected $quantidade;
	protected $preco;
	protected $descricao;
	


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


    public function novo(){

    	$daoProduto = new DaoProduto();

		$id = $daoProduto->inserir( $this );

		return $id;

    }

    public function editar(){

    	$daoProduto = new DaoProduto();

    	$retorno = $daoProduto->editar( $this );

		return $retorno;

    }


    public function buttonNovo(){


    	echo '<div class="col-md-2 col-sm-3 col-xs-12 header">';

    	echo '<a href="produto.php"><button type="button" class="btn btn-primary btn-cor-primary btn-100" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Novo Produto</button></a>';
			
		echo '</div>';

    }


	
	public function listar( $filtros ) {

		$daoProduto = new DaoProduto();

		$dados = $daoProduto->listar( $filtros );


		foreach ($dados as $value) {
			
			$m_produto = new Produto();
			$m_produto->__set( $m_produto, $value );
			$this::$instances[] = $m_produto;   

		}
	}
	
	public function listProdutos( $filtros ) {

		$this->listar( $filtros );

		if( !empty( $this::$instances ) ){

			echo '<div class="hidden-xs">';    		

	    		echo '<table class="table table-striped" id="">';

		    		echo '<thead>';
		    			echo '<th width="5%">Id</th>';	    			
		    			echo '<th width="45%">Nome</th>';
		    			echo '<th width="20%">Categoria</th>';
		    			echo '<th width="20%">Linha</th>';
		    			echo '<th width="10%"></th>';
		    		echo '</thead>';

		    		echo '<tbody>';

		    			foreach ( $this::$instances as $produto ) {	    				
		    				
		    				$produto->getCategoria();	    				
		    				$produto->getLinha();

			    			echo '<tr id="produto_' . $produto->__get('id'). '" style="cursor:pointer;">';
			    				echo '<td>' . $produto->__get('id') . '</td>';		    				
			    				echo '<td>' . $produto->__get('nome') . '</td>';
			    				echo '<td>' . $produto->__get('m_categoria')->__get('nome') . '</td>';		    				
			    				echo '<td>' . $produto->__get('m_linha')->__get('nome') . '</td>';	

			    				if(file_exists("img/produtos/" . $produto->__get('id') . "_imagem.jpg")) {

									echo '<td><img class="img-responsive imagemProduto" src="img/produtos/' . $produto->__get('id') . '_imagem.jpg" alt="' . $produto->__get('nome') . '" /></td>';							

								}else{

									echo '<td><img class="img-responsive imagemProduto" src="img/produtos/img-404.jpg"/></td>';	

								}

			    			echo '</tr>';

		    			}

		    		echo '</tbody>';

	    		echo '</table>';

    		echo '</div>'; //hidden-xs

    		echo '<div class="visible-xs">';

    			echo '<table class="table" id="">';

		    		echo '<thead>';
		    			echo '<th></th>';
		    		echo '</thead>';

		    		echo '<tbody>';

		    			foreach ( $this::$instances as $produto ) {

			    			echo '<tr id="produto_' . $produto->__get('id'). '" style="cursor:pointer;">';

			    				if(file_exists("img/produtos/" . $produto->__get('id') . "_imagem.jpg")) {

									echo '<td><img class="img-responsive imagemProduto" src="img/produtos/' . $produto->__get('id') . '_imagem.jpg" alt="' . $produto->__get('nome') . '" /><h3 style="text-align: center;">' . $produto->__get('nome') . '</h3></td>';							

								}else{

									echo '<td><img class="img-responsive imagemProduto" src="img/produtos/img-404.jpg"/><h3 style="text-align: center;">' . $produto->__get('nome') . '</h3></td>';	

								}

			    			echo '</tr>';

		    			}

		    		echo '</tbody>';

	    		echo '</table>';

    		echo '</div>'; //visible-xs

    	}else{

    		echo '<div class="col-md-12 alert alert-warning"><p>Não existem produtos cadastrados.</p></div>';
    	}

	}

	
	
	public function filtroProdutos( $filtros ){

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
								$selected = ( $filtros['categoria'] == $m_categoria->__get('id') )? ' selected="selected" ' : '';
								echo "<option value='" . $m_categoria->__get('id') . "' " . $selected . ">" . $m_categoria->__get('nome') . "</option>";
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
								$selected = ( $filtros['linha'] == $m_linha->__get('id') )? ' selected="selected" ' : '';
								echo "<option value='" . $m_linha->__get('id') . "' " . $selected . ">" . $m_linha->__get('nome') . "</option>";
							}
						echo '</select>';
					echo '</div>';
				echo '</div>';

				echo '<div class="col-md-3 col-sm-4 col-xs-12">';
					echo '<input type="submit" class="btn btn btn-success" id="filtro" value="Filtrar" style="margin-top:25px;">';
				echo '</div>';

			echo '</form>';
		echo '</div>';

	}



	public function showFormulario() {

		$this->m_categoria = new Categoria();
		$categorias = $this->m_categoria->listar();

		$this->m_linha = new Linha();
		$linhas = $this->m_linha->listar();

		$form = '';
    	$form .= '<form id="produto_' . $this->__get('id') . '" method="post" enctype="multipart/form-data" action="' . $this->__get('controller') . '">';

			$form .= '<input type="hidden" name="id" value="' . $this->__get('id') . '">';
			$form .= '<input type="hidden" name="action" value="salvar">';


			$form .= '<div class="col-md-10 col-sm-9 col-xs-12">'; //formDados

				$form .= '<div class="col-md-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="nome">Nome</label>';
						$form .= '<input type="text" name="nome" class="form-control req" id="nome_' . $this->__get('id') . '" placeholder="Nome do produto" value="' . $this->__get('nome') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="alias">Categoria</label>';
						$form .= '<select class="form-control req" id="categoria" name="categoria">';
							$form .= '<option value="">Selecione</option>';						

								foreach ( $categorias as $categoria ) {
									$select = ( $categoria->__get('id') == $this->__get('categoria') ) ? ' selected ' : '';
									$form .= '<option ' . $select . ' value="' . $categoria->__get('id') . '">' . $categoria->__get('nome') . '</option>';
								}

						$form .= '</select>';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="alias">Linha</label>';
						$form .= '<select class="form-control req" id="linha" name="linha">';
							$form .= '<option value="">Selecione</option>';						

								foreach ( $linhas as $linha ) {
									$select = ( $linha->__get('id') == $this->__get('linha') ) ? ' selected ' : '';
									$form .= '<option ' . $select . ' value="' . $linha->__get('id') . '">' . $linha->__get('nome') . '</option>';
								}

						$form .= '</select>';
					$form .= '</div>';
				$form .= '</div>';	


				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="peso">Qtd/Peso</label>';
						$quantidade = ( !empty( $this->__get('quantidade') ) )? $this->__get('quantidade') : '';
						$form .= '<input type="text" name="quantidade" class="form-control req" id="quantidade_' . $this->__get('id') . '" value="' . $quantidade . '" >';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="peso">Preço</label>';
						$form .= '<input type="number" name="preco" class="form-control req" id="preco_' . $this->__get('id') . '" value="' . $this->__get('preco') . '" >';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-12 col-sm-12 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="alias">Descricao</label>';
						$form .= '<textarea class="form-control" name="descricao" rows="3" id="descricao_' . $this->__get('id') . '">' . $this->__get('descricao') . '</textarea>';
					$form .= '</div>';
				$form .= '</div>';

			$form .= '</div>'; //end formDados


			//upload file
			$form .= '<div class="col-md-2 col-sm-3 col-xs-12">';
					
				$form .= '<div class="row" id="imagem">';

					$form .= '<div class="imagem_produto">';

						if(file_exists("img/produtos/" . $this->__get('id') . "_imagem.jpg")) {

							$form .= '<img class="img-responsive imagemProduto" src="img/produtos/' . $this->__get('id') . '_imagem.jpg" alt="' . $this->__get('nome') . '" />';							

						}else{

							$form .= '<img class="img-responsive imagemProduto" src="img/produtos/img-404.jpg"/>';
						}
						
					$form .= '</div>';

				$form .= '</div>';

				$form .= '<div class="row" style="text-align:center;">';

					$form .= '<button type="button" class="btn btn-primary btn-100" role="button" id="enviarImagem"><i class="fa fa-check"></i> Enviar imagem</button>';			

					$form .= '<input type="file" name="file" id="file" style="display:none;">';

					$form .= '<div id="fildArquivo"></div>';

				$form .= '</div>';

			$form .= '</div>'; //end upload file
			

			$form .= '<div class="col-md-12">';
				$form .= '<div class="col-md-3 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-12">';
	 				$form .= '<button type="submit" class="btn btn-primary btn-cor-primary btn-100" id="salvarObjetivo_' . $this->__get('id') . '">Salvar</button>';
	 			$form .= '</div>';
	 		$form .= '</div>';

		$form .= '</form>';

		/*$form .= '<form id="form_arquivo" method="post" enctype="form-data">';
			
		$form .= '</form>';*/


		echo $form;

	}

	




}
?>