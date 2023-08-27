function ajaxFunction(query,returnPlace){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById(returnPlace);
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET","inicio.php?" + query,true);
	ajaxRequest.send(null); 
}

function ajaxjQuery(query,returnPlace){
	$.ajax({
		async: false,
		type: "GET",
		dataType: "html",
		data: query,
		processData: false,
		url: "inicio.php",
		success: function(html){
			$('#'+returnPlace).html(html);
			//$(html).replaceAll('#'+returnPlace);
		}
	});
	pubMask();
}
function ajaxQuery(query,method){
	retorno = $.ajax({
		async: false,
		type: method,
		dataType: "html",
		data: query,
		processData: false,
		url: "inicio.php"
	});
	retorno = retorno.responseText;
	pubMask();
	//alert(html);
	return retorno;
}


/*
function sortAlpha(com)
{ 
jQuery('#flex1').flexOptions({newp:1, params:[{name:'letter_pressed', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
jQuery("#flex1").flexReload(); 
}
*/
function test(com,grid)
{
	if (com=='Delete')
	{
		if($('.trSelected',grid).length>0){
			if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
				var items = $('.trSelected',grid);
				var itemlist ='';
				for(i=0;i<items.length;i++){
					itemlist+= items[i].id.substr(3)+",";
				}
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "delete.php",
					data: "items="+itemlist,
					success: function(data){
						alert("Query: "+data.query+" - Total affected rows: "+data.total);
						$("#flex1").flexReload();
					}
				});
			}
		} 
	}
	else if (com=='Incluir')
	{
		query = 'ajaxRequest=true&tela='+document.tmp.tela.value+'&action=incluir';
		ajaxjQuery(query,document.tmp.retorno.value);		
	}
	else if (com=='Realizados' || com=='Pendentes')
	{
		jQuery('#flex'+document.gridrand.rand.value).flexOptions({newp:1, params:[{name:'filtro', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
		jQuery('#flex'+document.gridrand.rand.value).flexReload(); 

	}	
}

function filtraAniversariantes(com,grid){
	if(com=='Aniversariantes'){
		$(('#flex'+$('#rand').val())).flexOptions({newp:1, params:[{name:'filtro',value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
		$(('#flex'+$('#rand').val())).flexReload();
	}
}

function goAniversarianteSelecionado(elemento){
	document.location = 'inicio.php?goTo=contatos&aniversariante='+elemento;
}

function altera(elemento){
	query = 'ajaxRequest=true&tela='+document.tmp.tela.value+'&action=alterar&elemento='+elemento;
	//ajaxFunction(query,document.tmp.retorno.value);
	ajaxjQuery(query,document.tmp.retorno.value);
	var p = $("#corpotab3");
	var off = p.offset();
	$(window).scrollTop((off.top-30));
}

function altera2(elemento){
	query = 'ajaxRequest=true&tela='+document.tmp.tela.value+'&action=alterar2&elemento='+elemento;
	//ajaxFunction(query,document.tmp.retorno.value);
	ajaxjQuery(query,document.tmp.retorno.value);
	var p = $("#corpotab3");
	var off = p.offset();
	$(window).scrollTop((off.top-30));
}
function alteraSenhaInicio(){
	query='ajaxRequest=true&tela=usuarios&action=alteraSenha&usuario='+$('#codigo').val();
	ajaxjQuery(query,document.tmp.retorno.value);
}

function telefone(contato,elemento){
	query = 'ajaxRequest=true&tela='+document.tmp.tela.value+'&action=alterar3&contato='+contato+'&elemento='+elemento;
	//ajaxFunction(query,document.tmp.retorno.value);
	ajaxjQuery(query,document.tmp.retorno.value);
}

function escondeDiv(){
	$("#escondeDiv").css("display","none");
}
function enviaForm(){
	document.dados.vai.disabled = true;
	document.dados.submit();
}
function enviaFormContatos(){
	document.dados.vai.disabled = true;
	form = $("#formContatos").serialize();
	result = ajaxQuery(form,"POST");
	$("#flex"+$("#rand").val()).flexReload();
	$("#corpotab3").html(result);
}
function enviaFormTelefones(){
	document.dados.vai.disabled = true;
	form = $("#formTelefones").serialize();
	result = ajaxQuery(form,"POST");
	$("#flex"+$("#rand").val()).flexReload();
	$("#corpotab3").html(result);
}
function pubMask(){
	$(function($){
		$(".mask-data").mask("99/99/9999");
		$(".mask-hora").mask("99:99:99");
	});
}
function alteraSenha(){
	$("#mudaSenha").toggle();
	$("#vai").hide();
}
function perfilAcesso(){
	$("#perfilAcesso").toggle();
	$("#vai").hide();
}
function validaNovaSenha(destinoRetorno){
	if($("#novaSenha").val()!=$("#confSenha").val()){
		alert("Confirma&ccedil;&atilde;o Incorreta.");
		return false;
	}else{
		if(destinoRetorno == null)
			destinoRetorno = "mudaSenha"
		ajaxjQuery("altSenha=true&newSenha="+$("#novaSenha").val()+"&oldSenha="+$("#senhaAtual").val()+"&usuSenha="+$("#codigo").val(),destinoRetorno);
		return true;
	}
	return false;
}
function vaiPerfilAcesso(){
	form = $("#formPerfil").serialize();
	//alert("altPerfil=true&usu="+$("#usuario").val()+"&"+form,"perfilAcesso");
	ajaxjQuery("altPerfil=true&usu="+$("#codigo").val()+"&"+form,"perfilAcesso");
}
function excluiTelefone(){
	ans = confirm("Tem certeza que deseja excluir o telefone "+$("#numero").val()+" do contato "+$("#nomeContato").val()+"?");
	if(ans){
		form = "ajaxRequest=true&tela=telefones&action=excluir&elemento="+$("#codigo").val()+"&contato="+$("#contato").val();
		result = ajaxQuery(form,"GET");
		$("#flex"+$("#rand").val()).flexReload();
		$("#corpotab3").html(result);
	}
}
function excluiContato(){
	ans = confirm("Tem certeza que deseja excluir o contato "+$("#nome").val()+"?");
	if(ans){
		form = "ajaxRequest=true&tela=contatos&action=excluir&elemento="+$("#codigo").val()+"&contato="+$("#contato").val();
		result = ajaxQuery(form,"GET");
		$("#flex"+$("#rand").val()).flexReload();
		$("#corpotab3").html(result);
	}
}
function excluiTelefonema(){
	ans = confirm("Tem certeza que deseja excluir o telefonema que trata do assunto "+$("#assunto").val()+"?");
	if(ans){
		form = "ajaxRequest=true&tela=telefonemas&action=excluir&elemento="+$("#codigo").val();
		result = ajaxQuery(form,"GET");
		$("#flex"+$("#rand").val()).flexReload();
		$("#corpotab3").html(result);
	}
}
function inativaUsuario(){
	ans = confirm("Tem certeza que deseja alterar o status de acesso do(a) "+$("#nome").val()+"?");
	if(ans){
		form = "ajaxRequest=true&tela=usuarios&action=inativar&elemento="+$("#codigo").val();
		result = ajaxQuery(form,"GET");
		$("#flex"+$("#rand").val()).flexReload();
		$("#corpotab3").html(result);
	}
}
function geraBkp(){
	ans = confirm("Gerar Back-up?");
	if(ans){
		form = "geraBkp=true";
		result = ajaxQuery(form,"GET");
		alert(result);
		var e = window.location.reload();
		//$("#flex"+$("#rand").val()).flexReload();
		//$("#corpotab3").html(result);
	}
}

function excluiArquivo(arquivo){
	ans = confirm("Apagar Back-up?");
	if(ans){
		form = "apagaBkp="+arquivo;
		result = ajaxQuery(form,"GET");
		alert(result);
		var e = window.location.reload();
		//$("#flex"+$("#rand").val()).flexReload();
		//$("#corpotab3").html(result);
	}
}