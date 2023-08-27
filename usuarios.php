<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Classe de Usu�rios.
 */
class usuarios {
	protected $codigo;
	protected $login;
	protected $nome;
	protected $senha;
	protected $dataRegistro;
	protected $horaRegistro;
	protected $ativo;
	protected $modulos;
	//public    $contatoTeste;
	
	function __construct($codigoNew, $loginNew, $nomeNew, $senhaNew, $dataRNew, $horaRNew, $ativoNew){
		//$this->contatoTeste = buscaContatoPorCodigo(6734);
		//self::__construct();
		$this->codigo       = $codigoNew;
		$this->login        = $loginNew;
		$this->nome         = $nomeNew;
		$this->senha        = $senhaNew;
		$this->dataRegistro = $dataRNew;
		$this->horaRegistro = $horaRNew;
		$this->ativo        = $ativoNew;
	}
 	
	public function verificaSenha($senhaLogin){
		$senhaLogin = md5($senhaLogin);
		if(strcasecmp($senhaLogin,$this->senha)==0){
			return true;
		}
		return false;
	}
	
	public function getcodigo(){
		return $this->codigo;
	}
	
	public function getlogin(){
		return $this->login;
	}
	
	public function getnome(){
		return $this->nome;
	}
 	
	public function getdataRegistro(){
		return $this->dataRegistro;
	}
	
	public function gethoraRegistro(){
		return $this->horaRegistro;
	}
	
	public function getativo(){
		return $this->ativo;
	}
 	public function getsenha(){
		return $this->senha;
	}
	public function setSenha($tmp){
		$this->senha = $tmp;
	}

	public function getModulos() {
		return $this->modulos;
	}
	public function setModulos($modulos) {
		$this->modulos = $modulos;
	}


	
}