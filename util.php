<?php
/*
 * Created on 17/01/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

/**
 * Passa uma matriz onde a primeira linha é o cabeçalho, e o restante é conteúdo.
 * 
 */
function geraTabelinha($matriz){
	$sRetorno ='';
	$sRetorno .= '<div class="tabelinhaDeMentira" style="display: table">';
	foreach($matriz as $i){
		$sRetorno .= '<div style="display: table-row">';
		foreach($i as $j){
			$sRetorno .='<div style="display: table-cell; padding: 2px 2px 2px 2px;">';
			$sRetorno .= $j;
			$sRetorno .='</div>';
		}
		$sRetorno .= '</div>';
	}
	$sRetorno .= '</div>';
	return $sRetorno;
} 

/**
 * entrada: String data no formato YYYY/MM/DD 
 * saida: String data no formato DD+separador+MM+separador+YYYY
 * se não for passado parâmetro retorna data atual no formato de saída. 
 * se não for passado separador retorna /. 
 */
function dateToUk($data,$separador){
	if(!is_string($data)){
		$data = '';
	}
	if(!is_string($separador)){
		$separador = '/';
	}
	$sRetorno = $data;
	if(strlen($sRetorno)>0){
		$sRetorno = substr($sRetorno,8,2).$separador.substr($sRetorno,5,2).$separador.substr($sRetorno,0,4);
	}else{
		$sRetorno = date('d'.$separador.'m'.$separador.'Y');
	}
	return $sRetorno;
}


/**
 * entrada: String data no formato DD/MM/YYYY
 * saida: String data no formato YYYY+separador+MM+separador+DD
 * se não for passado parâmetro retorna data atual no formato de saída. 
 * se não for passado separador retorna /. 
 */
function dateTo($data,$separador){
	if(!is_string($data)){
		$data = '';
	}
	if(!is_string($separador)){
		$separador = '/';
	}
	$sRetorno = $data;
	if(strlen($sRetorno)>0){
		$sRetorno = substr($sRetorno,6,4).$separador.substr($sRetorno,3,2).$separador.substr($sRetorno,0,2);
	}else{
		$sRetorno = date('Y'.$separador.'m'.$separador.'d');
	}
	return $sRetorno;
}

?>
