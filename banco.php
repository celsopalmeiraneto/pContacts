<?php
/*
 * Created on 07/01/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class banco{

  static $banco_    = '';
	static $porta_    = '';
	static $endereco_ = '';
	static $usuario_  = '';
	static $senha_    = '';

	private $link;
 	private $banco;
 	private $query;
 	private $result;
 	
 	function __construct($bancoTmp,$queryTmp){
 		$this->banco = 'pContacts';
 		$this->query = $queryTmp;
 	}
 	
 	public function abreConexao(){
 		$this->link = mysql_connect('', '', '')
 		//$this->link = mysql_connect('', '', '')
 			or die('N�o foi poss�vel realizar conex�o! ' . mysql_error());
 	}

 	public function selecionaBanco(){
 		return mysql_select_db($this->banco) or die('Imposs�vel conectar ao banco.');
 	}

 	public function fechaConexao(){
 		//mysql_free_result($this->result);
 		return mysql_close($this->link);
 	}
 	
 	public function realizaConsulta(){
 		//$this->query  = mysql_real_escape_string($this->query,$this->link);
 		$this->result = mysql_query($this->query) or die('Consulta n�o realizada: ' . mysql_error());
	 	if(mysql_num_rows($this->result)==0){
			return 0;
		}
 	}

 	public function pegaResultados(){
 		$line = mysql_fetch_array($this->result, MYSQL_ASSOC);
 		return $line;
 		
 	}

 	public function lastAutoIncrement(){
 		$line = mysql_insert_id();
 		return $line;
 	}
 	
 	public function setquery($newQuery){
 		$this->query = $newQuery;
 	}
 	
 	public function realizaConsultaSimples(){
 		//$this->query  = mysql_real_escape_string($this->query,$this->link);
 		$this->result = mysql_query($this->query) or die('Consulta n�o realizada: ' . mysql_error());
 		//echo '<br><br>'.mysql_insert_id().'<br>';
 		return $this->result;
 	}
 }
?>
