<?php

include_once __DIR__ . "/../config.php";

abstract class Icontroller {
	
    protected $m_autenticacao;
    protected $m_session;
    protected $destinoDefault;
    protected $mensagemDefault;
    protected $dados;
    protected $m_object;
    protected $object_id;

    public function __construct(){
        
        $this->m_session = new Session();

        $request = $_REQUEST;

        if( !empty( $request ) ){

            $dadosForm = $this->m_session->getValue( $this->name_session );

            if( !empty( $dadosForm ) ){

                foreach ( $dadosForm as $key => $value ) {
                    
                    $this->dados[ $key ] = $value;
                }
            }

            foreach ( $this->striptag( $request ) as $key => $value ) {
                    
                $this->dados[ $key ] = $value;
            }
        /*
        echo "<pre>";
        print_r($this->dados);
        echo "</pre>";
        exit();
        */
            
        } 

        $this->action = $this->dados['action'];
        $this->method = @$this->dados['method']; 

        $this->m_autenticacao = new Autenticacao();
        $this->m_autenticacao->checkAcess();

        $this->definePropriedades();
        $this->checkParams();
        $this->startAction();

    }

    abstract protected function definePropriedades();
    abstract protected function startAction();
    

    protected function checkParams(){

        if( empty( $this->dados['action'] ) ){

            $this->redirect( array( 'msg' => 'Parâmetros incorretos.' ) );

        }
    }


    protected function redirect( $dados ){

        $mensagem = ( !empty( $dados['msg'] ) )? $dados['msg'] : $this->mensagemDefault;

        $destino = ( !empty( $dados['dst'] ) )? $dados['dst'] : $this->destinoDefault;

        $this->m_autenticacao->redirectAcesso( array( 'mensagem' => $mensagem, 'destino' => $destino ) );

        exit();

    }

    /*
    Método chamado sempre que instanciado a classe
    */
    protected function striptag( $dados ){

        if( is_array( $dados ) ){

            foreach ($dados as $key => $value) {
                
                if( is_array( json_decode( $key, true ) ) ){

                    striptag( $key );
                }else{

                    $key = strip_tags( $value );
                }
            }
        }else{

            strip_tags( $dados );
        }

        return $dados;
    }


    protected function retornoAjax( $param ){

        $result = array();

        foreach ( $param as $key => $value ) {
            
            $result[$key] = $value;
        }

        $result['cod'] = ( !empty( $result['cod'] ) )? $result['cod'] : 0;
        $result['msg'] = ( !empty( $result['msg'] ) )? $result['msg'] : 'A requisição falhou devido a um erro.';


        $resposta = json_encode( $result );
        echo $resposta;
        exit();
    }



    protected function checaDados(){

        foreach ( $this->dados as $key => $value ) {
           
            if( array_key_exists( $key, $this->m_object->__get('tiposDeDados') ) ){


            }

        }
    }
}
?>