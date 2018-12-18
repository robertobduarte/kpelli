<?php

class Pessoa extends IObject{

	protected static $instances = array();
	protected $controller = '../controller/controllerPessoa.php';
	protected $id;
	protected $nome;
	protected $email;
	protected $cpf;
	protected $telefone;
	protected $celular;
	protected $endereco;
	protected $cidade;
	protected $observacao;


	public function __construct( $dados = null ){

		parent::__construct($dados);
	}


	public function getObjeto( $pessoa_id ){

		$daoPessoa = new DaoPessoa();

		$pessoa = $daoPessoa->buscar( $pessoa_id );
		$this->__set( $this, $pessoa );

	}


	
	public function listar( $filtros ) {

		$daoPessoa = new DaoPessoa();

		$dados = $daoPessoa->listar( $filtros );

		foreach ($dados as $value) {
			
			$pessoa = new Pessoa();
			$pessoa->__set( $pessoa, $value );
			$this::$instances[] = $pessoa;   

		}
	}


	public function listPessoas( $filtros ) {

		$this->listar( $filtros );

		if( !empty( $this::$instances ) ){

			echo '<div class="">';    		

	    		echo '<table class="table table-striped" id="">';

		    		echo '<thead>';	    			
		    			echo '<th width="45%">Nome</th>';
		    			echo '<th width="20%">Telefone</th>';
		    		echo '</thead>';

		    		echo '<tbody>';

		    			foreach ( $this::$instances as $pessoa ) {	

			    			echo '<tr id="pessoa_' . $pessoa->__get('id'). '" style="cursor:pointer;">';
			    				echo '<td>' . $pessoa->__get('nome') . '</td>';		    				
			    				echo '<td>' . $pessoa->__get('telefone') . '</td>';
			    			echo '</tr>';

		    			}

		    		echo '</tbody>';

	    		echo '</table>';

    		echo '</div>'; //hidden-xs    		

    	}else{

    		echo '<div class="col-md-12 alert alert-warning"><p>Não existem pessoas cadastradas.</p></div>';
    	}

	}




	public function filtroPessoas( $filtros ){

		echo '<div class="row">';
			echo '<form id="listPessoas" action="pessoas.php" method="post">';

				echo '<div class="col-md-4 col-sm-6 col-xs-12">';
					echo '<div class="input-group" id="">';
						echo '<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>';
						echo '<input type="text" name="nome" class="form-control" placeholder="Pesquisar" aria-describedby="basic-addon1" value="' . $filtros['nome'] . '">';					
					echo '</div>';
				echo '</div>';

			echo '</form>';
		echo '</div>';

	}



	public function showFormulario() {

		$form = '';
    	$form .= '<form id="pessoa_' . $this->__get('id') . '" method="post" enctype="multipart/form-data" action="' . $this->__get('controller') . '">';

			$form .= '<input type="hidden" name="id" value="' . $this->__get('id') . '">';
			$form .= '<input type="hidden" name="action" value="salvar">';


			$form .= '<div class="col-md-12 col-sm-12 col-xs-12">'; //formDados

				$form .= '<div class="col-md-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="nome">Nome</label>';
						$form .= '<input type="text" name="nome" class="form-control req" id="nome_' . $this->__get('id') . '" value="' . $this->__get('nome') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>CPF</label>';
						$form .= '<input type="text" name="cpf" class="form-control" id="cpf" value="' . $this->__get('cpf') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>E-mail</label>';
						$form .= '<input type="text" name="email" class="form-control" id="email" value="' . $this->__get('email') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>Telefone</label>';
						$form .= '<input type="text" name="telefone" class="form-control" id="telefone" value="' . $this->__get('telefone') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-3 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>Whatsapp</label>';
						$form .= '<input type="text" name="celular" class="form-control" id="celular" value="' . $this->__get('celular') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-8 col-sm-8 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>Endereço</label>';
						$form .= '<input type="text" name="endereco" class="form-control" id="endereco" value="' . $this->__get('endereco') . '">';
					$form .= '</div>';
				$form .= '</div>';

				$form .= '<div class="col-md-4 col-sm-4 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label>Cidade</label>';
						$form .= '<input type="text" name="cidade" class="form-control" id="cidade" value="' . $this->__get('cidade') . '">';
					$form .= '</div>';
				$form .= '</div>';

	
				$form .= '<div class="col-md-12 col-sm-12 col-xs-12">';
					$form .= '<div class="form-group">';
						$form .= '<label for="alias">Observação</label>';
						$form .= '<textarea class="form-control" name="observacao" rows="3" id="observacao">' . $this->__get('observacao') . '</textarea>';
					$form .= '</div>';
				$form .= '</div>';				

			$form .= '</div>'; //end formDados			

			$form .= '<div class="col-md-12">';
				$form .= '<div class="col-md-3 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-12">';
	 				$form .= '<button type="submit" class="btn btn-primary btn-cor-primary btn-100" id="salvar">Salvar</button>';
	 			$form .= '</div>';
	 		$form .= '</div>';

		$form .= '</form>';

		/*$form .= '<form id="form_arquivo" method="post" enctype="form-data">';
			
		$form .= '</form>';*/


		echo $form;

	}




	   public function novo(){

    	$daoPessoa = new DaoPessoa();

		$id = $daoPessoa->inserir( $this );

		return $id;

    }

    public function editar(){

    	$daoPessoa = new DaoPessoa();

    	$retorno = $daoPessoa->editar( $this );

		return $retorno;

    }


    public function buttonNovo(){


    	echo '<div class="col-md-2 col-sm-3 col-xs-12 header">';

    	echo '<a href="pessoa.php"><button type="button" class="btn btn-primary btn-cor-primary btn-100" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cadastar Pessoa</button></a>';
			
		echo '</div>';

    }






}
?>