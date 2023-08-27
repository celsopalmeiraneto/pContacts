<?php
/*
 * Created on 17/04/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
include 'contatos.php';
include 'banco.php';
include 'contatosCadastro.php';
include 'telefonesCadastro.php';
include 'telefones.php';

$banco = new banco('','');
$banco->abreConexao();
$banco->selecionaBanco();

$nHandler = fopen('CONTATOS.csv','r');
if($nHandler){
	while($res = fgetcsv($nHandler,17,';')){
		$query = 'Update contatos set contatos_aniversario = '.substr($res[1],6,4).substr($res[1],3,2).substr($res[1],0,2).' where contatos_codigo='.$res[0];
		echo var_dump($res).'<br>'; 
		$banco->setquery($query);
		$banco->realizaConsultaSimples();
	}
}
//Olá mundo!
fclose($nHandler);
$banco->fechaConexao();

?>
