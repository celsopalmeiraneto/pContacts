<?php
/*
 * Created on 15/01/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
/**
 */ 
class flexigrid{
	private $url;    		//String. Url do post (onde o javascript vai trabalhar.)
	private $display;
	//teste 2 do carlinhos
	/**
	 * $display é composto de:
	 * [x][0] -> display  Ex: 'Codigo'
	 * [x][1] -> name     Ex: 'usuarios_codigo'
	 * [x][2] -> width    Ex: '40'
	 * [x][3] -> sortable Ex: 'true'
	 * [x][4] -> align    Ex: 'center'
	 */
	private $buttons;
	/*
	 * $buttons é composto de:
	 * [x][0] -> display  Ex: 'Incluir'
	 * [x][1] -> bclass   Ex: 'add'
	 * [x][2] -> onpress  Ex: 'test'
	 */
	private $search;
	/*
	 * $search é composto de:
	 * [x][0] -> display   Ex: 'Codigo'
	 * [x][1] -> name      Ex: 'usuarios_codigo'
	 * [x][2] -> isdefault Ex: 'false'
	 */
	private $order;		//string com a variável que será a ordem. Ex: 'usuarios_login' 
	private $sortOrder;	//Ordem: 1 -> Crescente | 2 -> Decrescente
	private $title;		//Strig com título da janela.
	private $width;		//Largura amanho da Janela
	private $height;	//Altura da janela.
	private $internID;  //Id interno do FlexiGrid (dar preferência a código).
	private $table;
	private $onClick;
	private $exibeBotoes; //true / false.. se exibe botões ou não.
	private $exibeProcura; //true / false.. se exibe procura ou não.
	private $filtro; //Vetor com duas posições... onde a primeira é ex: usuarios_codigo  e a segunda 1, logo, será interpretado usuarios_codigo=1
	
	function __construct($newUrl, $newDisplay, $newButtons, $newSearch, $newOrder,
						 $newSortOrder, $newTitle, $newWidth, $newHeight,$newInternID,
						 $newTable,$newOnClick,$newExibeBotoes,$newExibeProcura,$newFiltro){
		$this->url          = $newUrl;
		$this->display      = $newDisplay;
		$this->buttons      = $newButtons;
		$this->search       = $newSearch;
		$this->order        = $newOrder;
		$this->sortOrder    = $newSortOrder;
		$this->title        = $newTitle;
		$this->width        = $newWidth;
		$this->height       = $newHeight;
		$this->internID     = $newInternID;
		$this->table        = $newTable;
		$this->onClick      = $newOnClick;
		$this->exibeBotoes  = $newExibeBotoes;
		$this->exibeProcura = $newExibeProcura;
		$this->filtro       = $newFiltro;
		$this->montaUrl();
	}
	
	function toSring(){
		$nRandom = rand(1,500);
		$sReturn = '';
		$sReturn .= '<form name="gridrand"><input type="hidden" id="rand" name="rand" value="'.$nRandom.'"></form>';
		$sReturn .= '<table id="flex'.$nRandom.'"></table>';
		$sReturn .= '<script type="text/javascript">';
		$sReturn .= '$("#flex'.$nRandom.'").flexigrid';
		$sReturn .= '({';
		$sReturn .= "url: '".$this->url."',";
		$sReturn .= "dataType: 'json',";
		$sReturn .= "colModel : [";
		$contTmp = 0;
		foreach($this->display as $i){
			if($contTmp<>0)
				$sReturn.=',';
			$sReturn.=	"{display: '".$i[0].
						"',"."name:'".$i[1].
						"',"."width:".$i[2].
						","."sortable:".$i[3].
						","."align:'".$i[4]."'}";
			$contTmp++;
		}
		$sReturn .= "],";
		$sReturn .= "buttons:[";
		if($this->exibeBotoes){
			$contTmp = 0;
			foreach($this->buttons as $i){
				if($contTmp<>0)
					$sReturn.=',';
				$sReturn.=	"{name:'".$i[0].
							"',"."bclass:'".$i[1].
							"',"."onpress:".$i[2]."}";
				$contTmp++;			
		}
		$sReturn .=",{separator: true},";
		$sReturn .="{name: 'A', onpress: sortAlpha".$nRandom."},{name: 'B', onpress: sortAlpha".$nRandom."},{name: 'C', onpress: sortAlpha".$nRandom."},{name: 'D', onpress: sortAlpha".$nRandom."},{name: 'E', onpress: sortAlpha".$nRandom."},{name: 'F', onpress: sortAlpha".$nRandom."},{name: 'G', onpress: sortAlpha".$nRandom."},{name: 'H', onpress: sortAlpha".$nRandom."},{name: 'I', onpress: sortAlpha".$nRandom."},{name: 'J', onpress: sortAlpha".$nRandom."},{name: 'K', onpress: sortAlpha".$nRandom."},{name: 'L', onpress: sortAlpha".$nRandom."},{name: 'M', onpress: sortAlpha".$nRandom."},{name: 'N', onpress: sortAlpha".$nRandom."},{name: 'O', onpress: sortAlpha".$nRandom."},{name: 'P', onpress: sortAlpha".$nRandom."},{name: 'Q', onpress: sortAlpha".$nRandom."},{name: 'R', onpress: sortAlpha".$nRandom."},{name: 'S', onpress: sortAlpha".$nRandom."},{name: 'T', onpress: sortAlpha".$nRandom."},{name: 'U', onpress: sortAlpha".$nRandom."},{name: 'V', onpress: sortAlpha".$nRandom."},{name: 'W', onpress: sortAlpha".$nRandom."},{name: 'X', onpress: sortAlpha".$nRandom."},{name: 'Y', onpress: sortAlpha".$nRandom."},{name: 'Z', onpress: sortAlpha".$nRandom."},{name: '#', onpress: sortAlpha".$nRandom."}";
		}
		$sReturn .="],";
		$sReturn .="searchitems : [";
		$contTmp = 0;
		foreach($this->search as $i){
			if($contTmp<>0)
				$sReturn.=',';
			$sReturn.=	"{display:'".$i[0].
						"',"."name:'".$i[1].
						"',"."isdefault:".$i[2].
						","."cls:'".$i[3]."'}";
			/*$sReturn.=	"{display:'".$i[0].
						"',"."name:'".$i[1].
						"',"."isdefault:".$i[2].
						","."class:'".$i[3]."'}";*/
			$contTmp++;			
		}
		$sReturn .="],";
		$sReturn .='sortname: "'.$this->order.'",';
		$sReturn .='sortorder: '.($this->sortOrder==1?'"asc"':'"desc"') .',';
		$sReturn .='usepager: '.($this->exibeProcura?'true':'false').',';
		$sReturn .="title: '".$this->title."',";
		$sReturn .="pagestat: 'Exibindo {from} a {to} de {total} itens.',";
		$sReturn .="procmsg: 'Processando, aguarde!!!',";
		$sReturn .="searchmsg: 'Procura:',";
		$sReturn .="searchclr: 'Limpar Procura',";
		$sReturn .="searchbtn: 'Buscar',";
		$sReturn .="procmsg: 'Processando, aguarde!!!',";
		$sReturn .="nomsg: '".htmlentities('Não há itens para ser exibidos.')."',";
		$sReturn .="useRp: true,";
		$sReturn .="rp: 10,";
		$sReturn .="showTableToggleBtn: true,";
		$sReturn .="width: ".$this->width.",";
		$sReturn .="height: ".$this->height."});";
		$sReturn .='$';
		$sReturn .="('#flexigrid b.top').click(function (){";
		$sReturn .= '$';
		$sReturn .= "(this).parent().toggleClass('fh');});";

		$sReturn .= "function sortAlpha".$nRandom."(com){";
		$sReturn .= "jQuery('#flex".$nRandom."').flexOptions({newp:1, params:[{name:'letter_pressed', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});";
		$sReturn .= "jQuery('#flex".$nRandom."').flexReload();}"; 
		$sReturn .= '</script>';
		return $sReturn;
	}
	
	private function montaUrl(){
		$cont = 0;
		$this->url .= "?";
		$this->url .= "internID=".$this->internID;
		$this->url .= "&table=".$this->table;
		foreach($this->display as $i){
			$this->url .= "&var".strval($cont)."=".$i[1];
			$cont++;
		}
		if(isset($this->onClick)){
			$this->url .= "&onClick=".$this->onClick;
		}
		
		$cont = 0;
		if(isset($this->filtro)){
			foreach($this->filtro as $i){
				$this->url .= "&filtro".strval($cont)."=".$i;
				$cont++;
			}
		}
	}
}
?>
