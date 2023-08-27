<?php
/*
 * Created on 08/05/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/

class entidades{
  ///teste do carlinhos
	protected $codigo;
	protected $fantasia;
	protected $razao;
	protected $endereco;
	protected $numero;
	protected $complemento;
	protected $bairro;
	protected $cidade;
	protected $uf;
	protected $cep;
	protected $cpf;
	protected $cnpj;
	protected $email;
	protected $ie;
	protected $contato;
	protected $telefone01;
	protected $telefone02;
	protected $fator_identificador;
	protected $ativo;
	
	function __construct($codigo_new,$fantasia_new,$razao_new,$endereco_new,$numero_new,$complemento_new,$bairro_new,$cidade_new,$uf_new,
							$cep_new,$cpf_new,$cnpj_new,$email_new,$ie_new,$contato_new,$telefone01_new,$telefone02_new,$fator_identidicador_new,$ativo_new){
		$this->codigo       = $codigo_new;
		$this->fantasia     = $fantasia_new;
		$this->razao        = $razao_new;
		$this->endereco     = $endereco_new;
		$this->numero       = $numero_new;
		$this->complemento	= $complemento_new;
		$this->bairro       = $bairro_new;
		$this->cidade       = $cidade_new;
		$this->uf           = $uf_new;
		$this->cep          = $cep_new;
		$this->cpf          = $cpf_new;
		$this->cnpj         = $cnpj_new;
		$this->email        = $email_new;
		$this->ie           = $ie_new;
		$this->contato      = $contato_new;
		$this->telefone01   = $telefone01_new;
		$this->telefone02   = $telefone02_new;
		$this->fator_identificador   = $fator_identidicador_new;
		$this->ativo        = $ativo_new;
	}
	
	public function getcodigo(){
		return $this->codigo;
	}
	public function getfantasia(){
		return $this->fantasia;
	}
	public function getrazao(){
		return $this->razao;
	}
	public function getendereco(){
		return $this->endereco;
	}
	public function getnumero(){
		return $this->numero;
	}
	public function getcomplemento(){
		return $this->complemento;
	}
	public function getbairro(){
		return $this->bairro;
	}
	public function getcidade(){
		return $this->cidade;
	}
	public function getuf(){
		return $this->uf;
	}
	public function getcep(){
		return $this->cep;
	}
	public function getcpf(){
		return $this->cpf;
	}
	public function getcnpj(){
		return $this->cnpj;
	}
	public function getemail(){
		return $this->email;
	}
	public function getie(){
		return $this->ie;
	}
	public function getcontato(){
		return $this->contato;
	}
	public function gettelefone01(){
		return $this->telefone01;
	}
	public function gettelefone02(){
		return $this->telefone02;
	}
	public function getfator_identificador(){
		return $this->ativo;
	}
	public function getativo(){
		return $this->ativo;
	}

	public function setfantasia($tmp){
		$this->fantasia = $tmp;
	}
	public function setrazao($tmp){
		$this->razao = $tmp;
	}
	public function setendereco($tmp){
		$this->endereco = $tmp;
	}
	public function setnumero($tmp){
		$this->numero = $tmp;
	}
	public function setcomplemento($tmp){
		$this->complemento = $tmp;
	}
	public function setbairro($tmp){
		$this->bairro = $tmp;
	}
	public function setcidade($tmp){
		$this->cidade = $tmp;
	}
	public function setuf($tmp){
		$this->uf = $tmp;
	}
	public function setcep($tmp){
		$this->cep = $tmp;
	}
	public function setcpf($tmp){
		$this->cpf = $tmp;
	}
	public function setcnpj($tmp){
		$this->cnpj = $tmp;
	}
	public function setemail($tmp){
		$this->email = $tmp;
	}
	public function setie($tmp){
		$this->ie = $tmp;
	}
	public function setcontato($tmp){
		$this->contato = $tmp;
	}
	public function settelefone01($tmp){
		$this->telefone01 = $tmp;
	}
	public function settelefone02($tmp){
		$this->telefone02 = $tmp;
	}
	public function setfator_identificador($tmp){
		$this->fator_identificador = $tmp;
	}
	public function setativo($tmp){
		$this->ativo = $tmp;
	}
}
?>
