<?php
$t1 = microtime(true);
include 'banco.php';

$bancoOO = new mysqli(Banco::$endereco_,Banco::$usuario_,Banco::$senha_,Banco::$banco_);
if(mysqli_connect_errno()>0){
	die('Problemas ao Conectar ao banco.');
}
////Teste do NEto junto com o Roger no dia 23/04/2012 10:16:51
$sQuery = "Select contatos_codigo,
						contatos_nome,
						contatos_tratamento,
						contatos_entidade,
						contatos_obs,
						contatos_referencia,
						contatos_email,
						contatos_conjugue,
						contatos_tratamento2,
						contatos_titulo,
						contatos_cargo,
						contatos_cargo2,
						contatos_endereco,
						contatos_cidade,
						contatos_cep,
						contatos_estado,
						contatos_pais,
						contatos_conjugue_tratamento,
						contatos_conjugue_tratamento2,
						contatos_conjugue_tratamento3,
						contatos_endereco_residencial,
						contatos_cidade_residencial,
						contatos_cep_residencial,
						contatos_estado_residencial,
						contatos_pais_residencial,
						contatos_classificacao,
						contatos_telefone,
						contatos_celular
						from contatos1";

$res = $bancoOO->query($sQuery);

$cont = 0;
while($row = $res->fetch_row()){
	$vetCerto[$cont][0]  = $row[0];
	$vetCerto[$cont][1]  = $row[1];
	$vetCerto[$cont][2]  = $row[2];
	$vetCerto[$cont][3]  = $row[3];
	$vetCerto[$cont][4]  = $row[4];
	$vetCerto[$cont][5]  = $row[5];
	$vetCerto[$cont][6]  = $row[6];
	$vetCerto[$cont][7]  = $row[7];
	$vetCerto[$cont][8]  = $row[8];
	$vetCerto[$cont][9]  = $row[9];
	$vetCerto[$cont][10] = $row[10];
	$vetCerto[$cont][11] = $row[11];
	$vetCerto[$cont][12] = $row[12];
	$vetCerto[$cont][13] = $row[13];
	$vetCerto[$cont][14] = $row[14];
	$vetCerto[$cont][15] = $row[15];
	$vetCerto[$cont][16] = $row[16];
	$vetCerto[$cont][17] = $row[17];
	$vetCerto[$cont][18] = $row[18];
	$vetCerto[$cont][19] = $row[19];
	$vetCerto[$cont][20] = $row[20];
	$vetCerto[$cont][21] = $row[21];
	$vetCerto[$cont][22] = $row[22];
	$vetCerto[$cont][23] = $row[23];
	$vetCerto[$cont][24] = $row[24];
	$vetCerto[$cont][25] = $row[25];
	$vetCerto[$cont][26] = $row[26];
	$vetCerto[$cont][27] = $row[27];
	$cont++;
}

if(!$bancoOO->set_charset("utf8")){
	Die("Erro ao selecionar codific. do banco.");
}

$sQuery = "update contatos1 set  contatos_nome=?,
											contatos_tratamento=?,
											contatos_entidade=?,
											contatos_obs=?,
											contatos_referencia=?,
											contatos_email=?,
											contatos_conjugue=?,
											contatos_tratamento2=?,
											contatos_titulo=?,
											contatos_cargo=?,
											contatos_cargo2=?,
											contatos_endereco=?,
											contatos_cidade=?,
											contatos_cep=?,
											contatos_estado=?,
											contatos_pais=?,
											contatos_conjugue_tratamento=?,
											contatos_conjugue_tratamento2=?,
											contatos_conjugue_tratamento3=?,
											contatos_endereco_residencial=?,
											contatos_cidade_residencial=?,
											contatos_cep_residencial=?,
											contatos_estado_residencial=?,
											contatos_pais_residencial=?,
											contatos_classificacao=?,
											contatos_telefone=?,
											contatos_celular=?
											where contatos_codigo=?";

$pStmt = $bancoOO->prepare($sQuery);
if(!$pStmt)
	Die("Falha heheheh".$bancoOO->error);
$pStmt->bind_param("sssssssssssssssssssssssssssd",
							$nome,
							$tratamento,
							$entidade,
							$obs,
							$ref,
							$email,
							$conj,
							$contatos_tratamento2,
							$contatos_titulo,
							$contatos_cargo,
							$contatos_cargo2,
							$contatos_endereco,
							$contatos_cidade,
							$contatos_cep,
							$contatos_estado,
							$contatos_pais,
							$contatos_conjugue_tratamento,
							$contatos_conjugue_tratamento2,
							$contatos_conjugue_tratamento3,
							$contatos_endereco_residencial,
							$contatos_cidade_residencial,
							$contatos_cep_residencial,
							$contatos_estado_residencial,
							$contatos_pais_residencial,
							$contatos_classificacao,
							$contatos_telefone,
							$contatos_celular,
							$codigo);
$c=0;
$b=0;
foreach ($vetCerto as $i) {
	$nome       = $bancoOO->escape_string($i[1]);
	$tratamento = $bancoOO->escape_string($i[2]);
	$entidade   = $bancoOO->escape_string($i[3]);
	$obs        = $bancoOO->escape_string($i[4]); 
	$ref			= $bancoOO->escape_string($i[5]);
	$email		= $bancoOO->escape_string($i[6]);
	$conj			= $bancoOO->escape_string($i[7]);
	$contatos_tratamento2 = $bancoOO->escape_string($i[8]);
	$contatos_titulo = $bancoOO->escape_string($i[9]);
	$contatos_cargo = $bancoOO->escape_string($i[10]);
	$contatos_cargo2 = $bancoOO->escape_string($i[11]);
	$contatos_endereco = $bancoOO->escape_string($i[12]);
	$contatos_cidade = $bancoOO->escape_string($i[13]);
	$contatos_cep = $bancoOO->escape_string($i[14]);
	$contatos_estado = $bancoOO->escape_string($i[15]);
	$contatos_pais = $bancoOO->escape_string($i[16]);
	$contatos_conjugue_tratamento = $bancoOO->escape_string($i[17]);
	$contatos_conjugue_tratamento2 = $bancoOO->escape_string($i[18]);
	$contatos_conjugue_tratamento3 = $bancoOO->escape_string($i[19]);
	$contatos_endereco_residencial = $bancoOO->escape_string($i[20]);
	$contatos_cidade_residencial = $bancoOO->escape_string($i[21]);
	$contatos_cep_residencial = $bancoOO->escape_string($i[22]);
	$contatos_estado_residencial = $bancoOO->escape_string($i[23]);
	$contatos_pais_residencial = $bancoOO->escape_string($i[24]);
	$contatos_classificacao = $bancoOO->escape_string($i[25]);
	$contatos_telefone = $bancoOO->escape_string($i[26]);
	$contatos_celular = $bancoOO->escape_string($i[27]);
	$codigo = $i[0]; 
	if(!$pStmt->execute()){
		$erros[$c][0] = $codigo;
		$erros[$c][1] = $nome;
		$c++;
	}
	if($b==1000)
		exit;
}
echo microtime(true)-$t1;
if($c>0){
	echo "Houveram erros:<br>";
	echo print_r($erros);
}
?>
