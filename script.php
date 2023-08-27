<?php
include 'banco.php';
$bancoOO = new mysqli(Banco::$endereco_,Banco::$usuario_,Banco::$senha_,Banco::$banco_);

$res = $bancoOO->query("select contatos_codigo,contatos_nome,contatos_aniversario from contatos1 where month(contatos_aniversario)='04' || month(contatos_aniversario)='03' order by contatos_aniversario");
if(!$res){
	Die("Erro na query.");
}else{
	$sReturn = "<html><body><table>";
	while($row = $res->fetch_row())
		$sReturn .= "<tr><td>".$row[0]."</td><td>".htmlentities($row[1],null,'UTF-8')."</td><td>".$row[2]."</td></tr>";
	$sReturn .="</table></body></html>";
}
echo $sReturn;
?>
