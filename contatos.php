<?php
/*
 * Created on 29/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Classe de Usu�rios.
 */
class contatos{
	protected $codigo;
	protected $nome;
	protected $aniversario;
	protected $tratamento;
	protected $titulo;
	protected $cargo;
	protected $entidade;
	protected $endereco;
	protected $cidade;
	protected $cep;
	protected $estado;
	protected $pais;
	protected $email;
	protected $obs;
	protected $conjugue;
	protected $conjugue_tratamento;
	protected $endereco_residencial;
	protected $cidade_residencial;
	protected $cep_residencial;
	protected $estado_residencial;
	protected $pais_residencial;
	protected $classificacao;
	protected $referencia;
	protected $data_inclusao;
	protected $usuario_inclusao;
	protected $hora_inclusao;
	protected $telefone;
	protected $celular;
	protected $tratamento2;
	protected $cargo2;
	protected $conjugue_tratamento2;
	protected $conjugue_tratamento3;
 	
	function __construct($newCodigo, $newNome, $newAniversario, $newTratamento,
							$newTitulo, $newCargo, $newEntidade,$newEndereco,
							$newCidade, $newCep, $newEstado, $newPais, $newEmail,
							$newObs, $newConjugue, $newConjugueTratamento, $newEnderecoResidencial,
							$newCidadeResidencial, $newCepResidencial, $newEstadoResidencial, $newPaisResidencial,
							$newClassificacao, $newReferencia, $newDataInclusao, $newUsuarioInclusao,
							$newHoraInclusao, $newTelefone, $newCelular,$newTratamento2,$newCargo2,
							$newConjugueTratamento2,$newConjugueTratamento3){
		$this->codigo = $newCodigo;
		$this->nome = $newNome;
		$this->aniversario = $newAniversario;
		$this->tratamento = $newTratamento;
		$this->titulo = $newTitulo;
		$this->cargo = $newCargo;
		$this->entidade = $newEntidade;
		$this->endereco = $newEndereco;
		$this->cidade = $newCidade;
		$this->cep = $newCep;
		$this->estado = $newEstado;
		$this->pais = $newPais;
		$this->email = $newEmail;
		$this->obs = $newObs;
		$this->conjugue = $newConjugue;
		$this->conjugue_tratamento = $newConjugueTratamento;
		$this->endereco_residencial = $newEnderecoResidencial;
		$this->cidade_residencial = $newCidadeResidencial;
		$this->cep_residencial = $newCepResidencial;
		$this->estado_residencial = $newEstadoResidencial;
		$this->pais_residencial = $newPaisResidencial;
		$this->classificacao = $newClassificacao;
		$this->referencia = $newReferencia;
		$this->data_inclusao = $newDataInclusao;
		$this->usuario_inclusao = $newUsuarioInclusao;
		$this->hora_inclusao = $newHoraInclusao;
		$this->telefone = $newTelefone;
		$this->celular = $newCelular;
		$this->tratamento2 = $newTratamento2;
		self::setCargo2($newCargo2);
		//self::cargo2 = $newCargo2;
		$this->conjugue_tratamento2 = $newConjugueTratamento2;
		$this->conjugue_tratamento3 = $newConjugueTratamento3;
		//$this  = buscaContatoPorCodigo(6734);
	}
 	public function setCargo2($tmp){
 		$this->cargo2 = $tmp;
 	}
	public function getcodigo(){
		return $this->codigo;
	}
	
	public function getnome(){
		return $this->nome;
	}

	public function getaniversario(){
		return $this->aniversario;
	}

	public function getaniversarioUk(){
		$sRetorno = $this->getaniversario();
		if(strlen($sRetorno)>0){
			$sRetorno = substr($sRetorno,8,2).'/'.substr($sRetorno,5,2).'/'.substr($sRetorno,0,4);
		}else{
			$sRetorno = '';//date('d/m/Y');
		}
		return $sRetorno;
	}

	public function getaniversarioUS(){
		$sRetorno = $this->getaniversario();
		if(strlen($sRetorno)>0){
			$sRetorno = substr($sRetorno,6,4).'/'.substr($sRetorno,3,2).'/'.substr($sRetorno,0,2);
		}else{
			$sRetorno = '';//date('Ymd');
		}
		return $sRetorno;
	}


	public function gettratamento(){
		return $this->tratamento;
	}

	public function gettratamento2(){
		return $this->tratamento2;
	}

	public function gettitulo(){
		return $this->titulo;
	}

	public function getcargo(){
		return $this->cargo;
	}

	public function getcargo2(){
		return $this->cargo2;
	}

	public function getentidade(){
		return $this->entidade;
	}

	public function getendereco(){
		return $this->endereco;
	}

	public function getcidade(){
		return $this->cidade;
	}

	public function getcep(){
		return $this->cep;
	}

	public function getestado(){
		return $this->estado;
	}

	public function getpais(){
		return $this->pais;
	}

	public function getemail(){
		return $this->email;
	}

	public function getobs(){
		return $this->obs;
	}
//
	public function getconjugue(){
		return $this->conjugue;
	}

	public function getconjugue_tratamento(){
		return $this->conjugue_tratamento;
	}

	public function getconjugue_tratamento2(){
		return $this->conjugue_tratamento2;
	}

	public function getconjugue_tratamento3(){
		return $this->conjugue_tratamento3;
	}

	public function getendereco_residencial(){
		return $this->endereco_residencial;
	}

	public function getcidade_residencial(){
		return $this->cidade_residencial;
	}

	public function getcep_residencial(){
		return $this->cep_residencial;
	}

	public function getestado_residencial(){
		return $this->estado_residencial;
	}

	public function getpais_residencial(){
		return $this->pais_residencial;
	}

	public function getclassificacao(){
		return $this->classificacao;
	}

	public function getreferencia(){
		return $this->referencia;
	}

	public function getdata_inclusao(){
		return $this->data_inclusao;
	}

	public function getusuario_inclusao(){
		return $this->usuario_inclusao;
	}

	public function gethora_inclusao(){
		return $this->hora_inclusao;
	}

	public function gettelefone(){
		return $this->telefone;
	}

	public function getcelular(){
		return $this->celular;
	}

 } 