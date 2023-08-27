<?php
/*
 * Created on 14/03/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


include 'entidades.php';
include 'entidadesCadastro.php';
include 'contatos.php';
include 'logs.php';
include 'logsCadastro.php';
include 'banco.php';
include 'contatosCadastro.php';
include 'telefonesCadastro.php';
include 'telefones.php';

$bancoOO = new mysqli('','','','');
if(mysqli_connect_errno()>0){
	die('Problemas ao Conectar ao banco.');
}


$identificacaoEntidade = buscaEntidadePorCodigo(1);
if(is_int($identificacaoEntidade) && $identificacaoEntidade==-1){
	die("Sess�o Inv�lida. Fa�a login novamente.");
}

/*
	function __construct($newCodigo, $newNome, $newAniversario, $newTratamento,
							$newTitulo, $newCargo, $newEntidade,$newEndereco,
							$newCidade, $newCep, $newEstado, $newPais, $newEmail,
							$newObs, $newConjugue, $newConjugueTratamento, $newEnderecoResidencial,
							$newCidadeResidencial, $newCepResidencial, $newEstadoResidencial, $newPaisResidencial,
							$newClassificacao, $newReferencia, $newDataInclusao, $newUsuarioInclusao,
							$newHoraInclusao, $newTelefone, $newCelular,$newTratamento2,$newCargo2,
							$newConjugueTratamento2,$newConjugueTratamento3){

 */
$file = $_GET['nome'];
$handler = fOpen($file,'r');
$linha = fgetcsv($handler,0,';');
while($linha = fgetcsv($handler,0,';')){
	//echo var_dump($linha[6]);
	//die;
	//Considero que a data no arquivo csv est� no formato yyyymmdd
	$contatoNew  = new contatos($linha[0], //c�digo
								trim($linha[1]).' '.trim($linha[2]), //nome
								(strlen($linha[6])==0?'00000000':substr(trim($linha[6]),0,8)), //anivers�rio
								trim($linha[4]), //tratamento
								'', //titulo
								trim($linha[8]), //cargo
								$linha[10], //entidade
								$linha[11].' '.$linha[12], //endereco
								$linha[13], //cidade
								$linha[16], //cep
								substr($linha[14],0,3), //estado
								$linha[17], //pais
								$linha[22],
								$linha[37],//ver observa��o
								$linha[31],
								$linha[32],
								$linha[23],
								$linha[24],
								$linha[27],
								substr($linha[25],0,3),
								$linha[28],
								'', //ver classif
								$linha[3], //ver referencia
								date('Ymd'),
								'0',
								date('His'),
								$linha[18],
								$linha[19],
								$linha[5],
								$linha[9],
								$linha[33],
								$linha[34]);
	incluiContato($contatoNew);
}
fclose($handler);

$handler = null;
$linha = null;

$handler = fOpen($file,'r');
$linha = fgetcsv($handler,0,';');
while(($linha = fgetcsv($handler,0,';')) != false){
	if(strlen($linha[20])>0){
		$telefoneNew  = new telefones(0,
									$linha[0],
									$linha[20],
									'Fax',
									false);
		incluiTelefone($telefoneNew);
	}

	if(strlen($linha[21])>0){
		$telefoneNew  = new telefones(0,
									$linha[0],
									$linha[21],
									'Celular 2',
									false);
		incluiTelefone($telefoneNew);
	}

	if(strlen($linha[29])>0){
		$telefoneNew  = new telefones(0,
									$linha[0],
									$linha[29],
									htmlentities('Tel. Resid�ncia'),
									false);
		incluiTelefone($telefoneNew);
	}

	if(strlen($linha[30])>0){
		$telefoneNew  = new telefones(0,
									$linha[0],
									$linha[30],
									htmlentities('Fax. Resid�ncia'),
									false);
		incluiTelefone($telefoneNew);
	}
}
fclose($handler);

?>
