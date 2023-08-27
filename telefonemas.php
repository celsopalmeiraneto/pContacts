<?php
/*
 * Created on 29/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Classe de Usu�rios.
 */
class telefonemas{
	protected $codigo; //` int(11) NOT NULL AUTO_INCREMENT COMMENT 'C�digo do item.',
	protected $data;
	protected $hora;
	protected $contato_codigo; //` int(11) DEFAULT NULL COMMENT 'C�digo do contato sobre o telefonema (se existir).',
	protected $contato_nome; //` varchar(150) NOT NULL COMMENT 'Nome do Contato sobre o telefonema.',
	protected $telefone1; //` varchar(30) DEFAULT NULL,
	protected $telefone2; //` varchar(30) DEFAULT NULL,
	protected $assunto; //` varchar(150) NOT NULL,
	protected $providencias; //` varchar(300) DEFAULT NULL,
	protected $origem; //` int(11) NOT NULL COMMENT 'Origem do telefonema:\n1 - Chamei\n2 - Recebi\n',
	protected $estado; //` int(11) DEFAULT NULL COMMENT '1 - Falou\n2 - Recado\n3 - Ocupado\n4 - N�o Completada\n5 - Cancelado',
	protected $situacao; //` tinyint(1) NOT NULL COMMENT 'True - Finalizado\nFalse - Pendente\n',

	
 	
	function __construct($newCodigo, $newData, $newHora,$newContatoCodigo, $newContatoNome, $newTelefone1,
							$newTelefone2, $newAssunto, $newProvidencias, $newOrigem,
							$newEstado, $newSituacao){
		$this->codigo = $newCodigo; //` int(11) NOT NULL AUTO_INCREMENT COMMENT 'C�digo do item.',
		$this->data = $newData;
		$this->hora = $newHora; 
		$this->contato_codigo = $newContatoCodigo; //` int(11) DEFAULT NULL COMMENT 'C�digo do contato sobre o telefonema (se existir).',
		$this->contato_nome = $newContatoNome; //` varchar(150) NOT NULL COMMENT 'Nome do Contato sobre o telefonema.',
		$this->telefone1 = $newTelefone1; //` varchar(30) DEFAULT NULL,
		$this->telefone2 = $newTelefone2; //` varchar(30) DEFAULT NULL,
		$this->assunto = $newAssunto; //` varchar(150) NOT NULL,
		$this->providencias = $newProvidencias; //` varchar(300) DEFAULT NULL,
		$this->origem = $newOrigem; //` int(11) NOT NULL COMMENT 'Origem do telefonema:\n1 - Chamei\n2 - Recebi\n',
		$this->estado = $newEstado; //` int(11) DEFAULT NULL COMMENT '1 - Falou\n2 - Recado\n3 - Ocupado\n4 - N�o Completada\n5 - Cancelado',
		$this->situacao = $newSituacao; //` tinyint(1) NOT NULL COMMENT 'True - Finalizado\nFalse - Pendente\n',
	}
 	
	public function getcodigo(){
		return $this->codigo;
	}
	
	public function getdata(){
		return $this->data;
	}

	public function getdataUk(){
		$sRetorno = $this->getdata();
		if(strlen($sRetorno)>0){
			$sRetorno = substr($sRetorno,8,2).'/'.substr($sRetorno,5,2).'/'.substr($sRetorno,0,4);
		}else{
			$sRetorno = date('d/m/Y');
		}
		return $sRetorno;
	}

	public function getdataUS(){
		$sRetorno = $this->getdata();
		if(strlen($sRetorno)>0){
			$sRetorno = substr($sRetorno,6,4).'/'.substr($sRetorno,3,2).'/'.substr($sRetorno,0,2);
		}else{
			$sRetorno = date('Ymd');
		}
		return $sRetorno;
	}


	public function gethora(){
		$sRetorno = $this->hora;
		if(strlen($sRetorno)==0){
			$sRetorno = date('H:i:s');
		}
		return $sRetorno;
	}

	public function getcontato_codigo(){
		return $this->contato_codigo;
	}

	public function getcontato_nome(){
		return $this->contato_nome;
	}

	public function gettelefone1(){
		return $this->telefone1;
	}

	public function gettelefone2(){
		return $this->telefone2;
	}

	public function getassunto(){
		return $this->assunto;
	}

	public function getprovidencias(){
		return $this->providencias;
	}

	public function getorigem(){
		return $this->origem;
	}

	public function getestado(){
		return $this->estado;
	}
	public function getsituacao(){
		return $this->situacao;
	}

 } 