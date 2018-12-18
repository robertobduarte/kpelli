<?php 
include_once __DIR__ . "/../config.php";

class ControllerPessoa extends Icontroller {


	function __construct(){

		parent::__construct();

	}


	protected function definePropriedades(){

		$this->m_object = new Pessoa();
		$this->destinoDefault = '../view/pessoas.php';
		$this->mensagemDefault = 'Erro! Não foi possível completar a ação.';
	}


	protected function startAction(){

		switch ( $this->action ) {

			case 'salvar':

				$this->salvar();
				break;
			

			case 'remover':

				$this->remover();
				break;


			default:

				$this->redirect( array( 'msg' => 'Usuário sem permissão para esta ação.' ) );
		}

	}



	protected function salvar(){

		
		$this->m_object->__set( 'Pessoa', $this->dados );

		if( empty( $this->m_object->__get('id') ) ){

			$this->object_id = $this->m_object->novo();
				
			if( !$this->object_id ){

				$this->redirect( array( 'msg' => 'Erro ao salvar os dados.' ) );
			}

			$this->m_object->__set( 'Pessoa', array( 'id' => $this->object_id ) );

		}else{

			$this->object_id = $this->m_object->__get('id');

			$retorno = $this->m_object->editar();

			if( !$retorno ){

				$this->redirect( array( 'msg' => 'Erro ao salvar os dados.', 'dst' => '../view/pessoa.php?id=' . $this->m_object->__get('id') ) );		
			}
			
		}

		/*if( !empty( $_FILES['file']['name'] ) ){

			$this->uploadFile();
		}*/

		$this->redirect( array( 'msg' => 'Dados gravados com sucesso.', 'dst' => '../view/pessoa.php?id=' . $this->object_id ) );
	}



	protected function remover(){

		$this->m_object->__set( 'Pessoa', $this->dados );

		if( !empty( $this->m_object->__get('id') ) ){

			$retorno = $this->m_object->remover();

			if( !$retorno['retorno'] ){

				$msg = ( !empty( $retorno['msg'] ) )? $retorno['msg'] : 'Erro ao remover.';

				$this->redirect( array( 'msg' => $msg, 'dst' => '../view/pessoa.php?id=' . $this->m_object->__get('id') ) );
				
			}

		}else{

			$this->redirect( array( 'msg' => 'Parâmetros incorretos. Não foi excluído.' ) );
		}

		$this->redirect( array( 'msg' => 'Dados excluídos com sucesso.', 'dst' => '../view/pessoas.php' ) );
	}





	/*protected function uploadFile( $produto_id ){

		//$this->m_Dominio = new Dominio( array( 'id' => $this->m_object->__get('dominio') ) );

		$dadosUpload = array( 
							'diretorio' => 'produtos',
							'caminho_relativo' => 'view/img',
							'prefixo' => $this->m_object->__get('id'),
							'nome_arquivo' => 'imagem.jpg'
							);

		$uploadImagemProduto = new UploadImagemProduto( $dadosUpload );
		$retorno = $uploadImagemProduto->getInformacoesArquivo();

		if( !$retorno['retorno']['cod'] ){

			$this->redirect( array( 'msg' => 'Erro ao gravar arquivo: <br>' . $retorno['retorno']['msg'] ) );
		}		
		
	}*/


	
}
?>