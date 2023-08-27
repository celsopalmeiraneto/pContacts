<?php
/*
 * Created on 08/05/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class logs{
	protected $codigo;
	protected $usuario;
	protected $rotina;
	protected $descricao;
	protected $sqlquery;
	protected $data;
	protected $hora;
	
	function __construct($codigo_new,$usuario_new,$rotina_new,$descricao_new,$sqlquery_new,$data_new,$hora_new){
		$this->codigo    = $codigo_new;
		$this->usuario   = $usuario_new;
		$this->rotina    = $rotina_new;
		$this->descricao = $descricao_new;
		$this->sqlquery  = $sqlquery_new;
		$this->data      = $data_new;
		$this->hora      = $hora_new;
	}
	
	public function getcodigo(){
		return $this->codigo;
	}
	public function getusuario(){
		return $this->usuario;
	}
	public function getrotina(){
		return $this->rotina;
	}
	public function getdescricao(){
		return $this->descricao;
	}
	public function getsqlquery(){
		return $this->sqlquery;
	}
	public function getdata(){
		return $this->data;
	}
	public function gethora(){
		return $this->hora;
	}
}
?>
