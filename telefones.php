<?php
/*
 * Created on 01/02/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class telefones{
 	protected $codigo;
 	protected $contato;
 	protected $numero;
 	protected $descricao;
 	protected $special_rec;
 	
 	function __construct($codigoNew, $contatoNew, $numeroNew,$descricaoNew,$special_recNew){
 		$this->codigo        = $codigoNew;
 		$this->contato       = $contatoNew;
 		$this->numero        = $numeroNew;
 		$this->descricao     = $descricaoNew;
 		$this->special_rec   = $special_recNew;
 	}
 	
 	public function getcodigo(){
 		return $this->codigo;
 	}
 	
 	public function getcontato(){
 		return $this->contato;
 	}
 	
 	public function getnumero(){
 		return $this->numero;
 	}

 	public function getdescricao(){
 		return $this->descricao;
 	}

 	public function getspecial_rec(){
 		return $this->special_rec;
 	}
 }
 ?>
