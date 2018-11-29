<?php 
include_once __DIR__ . "/../config.php";

class ControllerProduto extends Icontroller {


	function __construct(){

		parent::__construct();

	}


	protected function definePropriedades(){

		$this->m_object = new Produto();
		$this->destinoDefault = '../view/produtos.php';
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

		$this->m_object->__set( 'Produto', $this->dados );

		if( empty( $this->m_object->__get('id') ) ){

			$this->object_id = $this->m_object->novo();
				
			if( !$this->object_id ){

				$this->redirect( array( 'msg' => 'Erro ao gravar produto.' ) );
			}

			$this->m_object->__set( 'Produto', array( 'id' => $this->object_id ) );

		}else{

			$this->object_id = $this->m_object->__get('id');

			$retorno = $this->m_object->editar();

			if( !$retorno ){

				$this->redirect( array( 'msg' => 'Erro ao gravar objeto.', 'dst' => '../view/produto.php?pdt=' . $this->m_object->__get('id') ) );		
			}
			
		}

		if( !empty( $_FILES['file']['name'] ) ){

			$this->uploadFile();
		}

		$this->redirect( array( 'msg' => 'Produto gravado com sucesso.', 'dst' => '../view/produto.php?pdt=' . $this->object_id ) );
	}



	protected function remover(){

		$this->m_object->__set( 'Produto', $this->dados );

		if( !empty( $this->m_object->__get('id') ) ){

			$retorno = $this->m_object->remover();

			if( !$retorno['retorno'] ){

				$msg = ( !empty( $retorno['msg'] ) )? $retorno['msg'] : 'Erro ao remover produto.';

				$this->redirect( array( 'msg' => $msg, 'dst' => '../view/produto.php?pdt=' . $this->m_object->__get('id') ) );
				
			}

		}else{

			$this->redirect( array( 'msg' => 'Parâmetros incorretos. O produto não foi excluído.' ) );
		}

		$this->redirect( array( 'msg' => 'Produto excluído com sucesso.', 'dst' => '../view/produtos.php' ) );
	}





	protected function uploadFile( $produto_id ){

		/*echo "<pre>";
		print_r($_FILES['file']);
		echo "</pre>";
		exit();*/

		//$this->m_Dominio = new Dominio( array( 'id' => $this->m_object->__get('dominio') ) );

		$dadosUpload = array( 
							'diretorio' => 'produtos',
							'caminho_relativo' => 'view/img',
							'prefixo' => $this->m_object->__get('id'),
							'nome_arquivo' => 'imagem.jpg'
							);

		$uploadImagemProduto = new UploadImagemProduto( $dadosUpload );
		$retorno = $uploadImagemProduto->getInformacoesArquivo();

		/*echo "<pre>";
		print_r($retorno);
		echo "</pre>";
		exit();*/

		if( !$retorno['retorno']['cod'] ){

			$this->redirect( array( 'msg' => 'Erro ao gravar arquivo: <br>' . $retorno['retorno']['msg'] ) );
		}		
		
	}


	
}
?>