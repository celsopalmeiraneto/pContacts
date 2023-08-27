<?php
session_start();
include 'util.php';
include 'banco.php';
include 'entidades.php';
include 'entidadesCadastro.php';
error_reporting(0);
$bancoOO = new mysqli(Banco::$endereco_,Banco::$usuario_,Banco::$senha_,Banco::$banco_);
if(mysqli_connect_errno()>0){
	die('Problemas ao Conectar ao banco.');
}
if(!$bancoOO->set_charset("utf8")){
	Die("Erro ao selecionar codific. do banco.");
}

if(isset($_SESSION['fatorIdentificador'])){
	$identificacaoEntidade = buscaEntidadePorFatorIdentificador($_SESSION['fatorIdentificador']);///Voltar.
	if(is_int($identificacaoEntidade) && $identificacaoEntidade==-1){ ///Voltar.
		Die();
	}
}else{
	Die();
}


//include 'banco.php';
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];


if (!$sortname)
	$sortname = 'name';
if (!$sortorder)
	$sortorder = 'desc';

$colunas  = $_POST['qtype'];

$_POST['query'] = trim($_POST['query']);

if($_POST['query']!=''){
	if($colunas=='dynamicSearchContatos01'){
		$where = "WHERE contatos_nome LIKE '%".$_POST['query']."%' || contatos_entidade LIKE '%".$_POST['query']."%' || contatos_cargo LIKE '%".$_POST['query']."%' || contatos_titulo LIKE '%".$_POST['query']."%'";
	}else{
		if($colunas=='telefonemas_data'){
			$where = "WHERE `".$colunas."` = ".dateTo($_POST['query'],'')." ";
		}else{
			if($colunas=='contatos_aniversario'){
				$where = "Where month(contatos_aniversario)=month(".dateTo($_POST['query'],'').") && day(contatos_aniversario)=day(".dateTo($_POST['query'],'').") ";
			}else{
				if($colunas=='dynamicSearchLogs01'){
					$where = "Where @USU like '%".$_POST['query']."%' || logs_usuario like '%".$_POST['query']."%' || logs_rotina like '%".$_POST['query']."%' || logs_descricao like '%".$_POST['query']."%' || logs_sqlquery like '%".$_POST['query']."%' ";
				}else{
					$where = "WHERE `".$colunas."` LIKE '%".$_POST['query']."%' ";
				}
			}
		}
	}	

} else {
	if(isset($_GET['filtro0'])){
		$where = "Where ".$_GET['filtro0']." = ".$_GET['filtro1'];
	}else{
		$where ='';
	}
	if(isset($_GET['filtro2'])){
		$where.= "&& ".$_GET['filtro2']." = ".$_GET['filtro3'];
	}
}

if($_POST['letter_pressed']!=''){
	$where = "WHERE `".$colunas."` LIKE '".$_POST['letter_pressed']."%' ";	
}

if($_POST['filtro']=='Realizados'){
	$where = $where = "Where telefonemas_situacao = false";
}
if($_POST['filtro']=='Pendentes'){
	$where = $where = "Where telefonemas_situacao = true";
}
if($_POST['filtro']=='Aniversariantes'){
	$where = $where = "Where month(contatos_aniversario)=month(CurDate()) && day(contatos_aniversario)=day(CurDate())";
}

if(substr($_POST['filtro'],0,15)=='aniversariantes'){
	$where = $where = "Where contatos_aniversario = ".substr($_POST('filtro'),14,strlen($_POST('filtro'))-15);
}

if($_POST['letter_pressed']=='#'){
	$where = "WHERE `".$colunas."` REGEXP '[[:digit:]]' ";
}

$sort = "ORDER BY $sortname $sortorder";

if (!$page)
	$page = 1;
if (!$rp)
	$rp = 10;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

$camposGrid;

$sql = "SELECT ".leCamposGrid($camposGrid)." FROM ".$_GET['table']." ".$where." ".$sort." ".$limit;

$result = runSQL($sql);

$total = countRec($_GET['internID'],$_GET['table'],$where);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");

$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$rc = false;
while ($row = $result->fetch_array()) {
	if ($rc)
		$json .= ",";
	$json .= "\n{";
	$json .= "id:'".$row[$_GET['internID']]."',";
	$json.=	"cell:[";
	$contTmp = 0;
	foreach($camposGrid as $i){
		if($contTmp<>0) $json.=',';

		if(isset($_GET['onClick'])){
			$json.=	"'<a onclick=".$_GET['onClick']."(".$row[$_GET['internID']].")>".($i=='telefonemas_estado'?traduzEstado($row[$i]):convert_line_breaks(htmlentities($row[$i],ENT_QUOTES,"utf-8"),"&nbsp;"))."</a>'";
		}else{
			$json.=	"'".$row[$i]."'";
		}
		$contTmp++;			
	}
	$json .= "]";
	$json .= "}";
	$rc = true;
}

function traduzEstado($var){
	$var  = intval($var);
	$sRetorno = '';
	switch($var){
		case 1:
			$sRetorno = 'Falou';
			break;
		case 2:
			$sRetorno = htmlentities('N�o Completada');
			break;
		case 3:
			$sRetorno = 'Recado';
			break;
		case 4:
			$sRetorno = 'Cancelado';
			break;
		case 5:
			$sRetorno = 'Ocupado';
			break;
	}
	return $sRetorno;
}
/*while ($row = mysql_fetch_array($result)) {
	if ($rc)
		$json .= ",";
	$json .= "\n{";
	$json .= "id:'".$row['usuarios_codigo']."',";
	$json .= "cell:['".$row['usuarios_codigo']."','".$row['usuarios_login']."'";
	$json .= ",'".addslashes($row['usuarios_nome'])."']";
	//$json .= ",'".addslashes($row['numcode'])."']";
	$json .= "}";
	$rc = true;
}*/

$json .= "]\n";
$json .= "}";
echo $json;


function runSQL($rsql) {
	global $bancoOO;
/*	echo $rsql;
	die('');*/
	$result = $bancoOO->query($rsql);
	if(!$result){
		echo $bancoOO->error.'         '.$rsql;
		die();
	}
	return $result;
}

function countRec($fname,$tname,$where) {
	global $bancoOO;
	$sql = "SELECT count($fname) FROM $tname $where";
	//echo $sql;
	//die;
	$result = runSQL($sql);
	while ($row = $result->fetch_array()) {
		return $row[0];
	}
}

function leCamposGrid(&$camposGrid){
	global $identificacaoEntidade;
	$cont = 0;
	$sRetorno = '';
	$printComma = false;
	while(isset($_GET['var'.strval($cont)])){
		if($printComma)
			$sRetorno .= " , ";
		if($_GET['var'.strval($cont)]=='logs_usuario'){
			$sRetorno .= 'concat(logs_usuario,"ss")';//," - ",(select usuarios_nome from usuarios'.$identificacaoEntidade->getcodigo().' where usuarios_codigo=logs_usuario limit 1))';
		}else{
			$sRetorno .= $_GET['var'.strval($cont)];
		}
		$camposGrid[$cont] = $_GET['var'.strval($cont)];
		$cont++;
		$printComma = true;
	}
	return $sRetorno;
}

/**
 * Converts newlines and break tags to an 
 * arbitrary string selected by the user, 
 * defaults to PHP_EOL.
 * 
 * In the case where a break tag is followed by
 * any amount of whitespace, including \r and \n, 
 * the tag and the whitespace will be converted 
 * to a single instance of the line break argument.
 * 
 * @author Matthew Kastor
 * @param string $string
 *   string in which newlines and break tags will be replaced
 * @param string $line_break
 *   replacement string for newlines and break tags
 * @return string
 *   Returns the original string with newlines and break tags
 *   converted
 */
function convert_line_breaks($string, $line_break=PHP_EOL) {
    $patterns = array(    
                        "/(<br>|<br \/>|<br\/>)\s*/i",
                        "/(\r\n|\r|\n)/"
    );
    $replacements = array(    
                            PHP_EOL,
                            $line_break
    );
    $string = preg_replace($patterns, $replacements, $string);
    return $string;
}
?>