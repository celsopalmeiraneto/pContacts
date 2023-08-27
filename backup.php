<?php

/**
 *Rotina de Backup
 * Basicamente exitirão os seguintes arquivos:
 * @param bool $geraBkp
 */
function rotinaBackUp($geraBkp){
	//$dirBkp  = strtr(getcwd(),"/","//");
	$dirBkp  = str_replace("\\","\\\\",getcwd());
	$dirBkp .= "//bkp";
	$entraRotina    = true;
	$botaoGerarBkp  = true;
	$haBkpEmAndamento = false;
	$dataHoraBkpAndamento = "";
	if(!is_dir($dirBkp)){ //Se não houver diretorio bkp, mensagem de erro.
		echo "Falta dir. bkp<br>";
		$entraRotina = false;
	}
	if(is_file($dirBkp.'/'.'gerando')){
		$hand = @fopen($dirBkp.'/'.'gerando','c');
		if(!$hand){
			$botaoGerarBkp = false;
			$haBkpEmAndamento = true;
			$geraBkp = false;
			$dataHoraBkpAndamento = date("d/m/Y H:i:s", filemtime($dirBkp.'/'.'gerando'));
		}else{
			fclose($hand);
		}
	}
	if($geraBkp){
		geraBkp($dirBkp);
	}
	if($entraRotina){
		$bkpsProntos = scandir($dirBkp."/");
	?>
<table>
	<thead>
		<tr>
			<th>Data/Hora</th>
			<th>Nome do Arquivo</th>
			<th>Status</th>
			<th>Excluir</th>
		</tr>
		<?php
			foreach ($bkpsProntos as $i){
				if(substr($i,-3)!=".gz")
					continue;
				echo "<tr>";
				echo "<td>".date("d/m/Y H:i:s",  filemtime($dirBkp.'/'.$i))."</td>";
				echo "<td>".htmlentities($i)."</td>";
				$hand = @fopen($dirBkp.'/'.$i,'c');
				echo "<td>";
				if(!$hand){
					echo "Gerando.";
				}else{
					echo "<a href='bkp/$i'>Download</a>";
				}
				echo "</td><td>";
				if(!$hand){
					echo "";
				}else{
					echo '<img src="img/close.png" onclick=excluiArquivo("'.$i.'") />';
				}
				echo "</td>";
				fclose($hand);
				echo "</tr>";
			}
		?>
	</thead>
	<tbody>
	</tbody>
</table>
	<?php
	if($botaoGerarBkp){
		?>
<button id="geraBkp" onclick="geraBkp()"><img src="img/add.png" />Gera Back-Up</button>
		<?php
	}else{
		echo htmlentities("Há um back-up em andamento que começou às $dataHoraBkpAndamento");
	}
	}
	return 1;
}
function geraBkp($dirBkp){
	global $bancoOO,$identificacaoEntidade;
	
	$tabelas[] = "contatos".$identificacaoEntidade->getcodigo();
	$tabelas[] = "telefones".$identificacaoEntidade->getcodigo();
	$tabelas[] = "telefonemas".$identificacaoEntidade->getcodigo();
	$tabelas[] = "logs".$identificacaoEntidade->getcodigo();
	$tabelas[] = "sessoes".$identificacaoEntidade->getcodigo();

	$handler = fopen($dirBkp.'//'.'gerando','c');
	if(!$handler)
		Die("Já existe bkp em andamento.");
	foreach($tabelas as $i){
		$sQuery = "Select * from $i into outfile'".$dirBkp."//$i'";
		$res = $bancoOO->query($sQuery);
		if(!$res){
			Die("Falha ao executar bkp. <br>".$bancoOO->error." ".$dirBkp);
		}
	}
	
	$zipHand = gzopen($dirBkp."//bkp".date("YmdHis").".gz","w9");	
	if(!$zipHand){
		Die("Falha ao criar o arquivo de backup.");
	}
	foreach($tabelas as $i){
		$arquivo = $dirBkp."//".$i;
		$aux = fopen($arquivo,"r");
		$content = fread($aux,filesize($arquivo));
		fclose($aux);
		gzwrite($zipHand,$content,strlen($content));
		//TarAddHeader($tarFile,$arquivo,"/");
		//TarWriteContents($tarFile,$arquivo);
		//TarAddFooter($tarFile);
		if(!unlink($arquivo))
			Die("Falha ao deletar arquivos de backup.");
	}
	
	//fclose($tarFile);
	//unlink($dirBkp.'//'.date("YmdHis").".tar");
	gzclose($zipHand);
	fclose($handler);
}

function apagaBkp($arquivo){
	$dirBkp  = str_replace("\\","\\\\",getcwd());
	$dirBkp .= "//bkp//";
	unlink($dirBkp.$arquivo);
}

//////
/////Código abaixo foi pego em:http://www.php.net/manual/en/function.gzwrite.php
/////No comentários... foi criado por: calmarius at nospam dot atw dot hu

//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
// Adds file header to the tar file, it is used before adding file content.
// f: file resource (provided by eg. fopen)
// phisfn: path to file
// archfn: path to file in archive, directory names must be followed by '/'
//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
function TarAddHeader($f,$phisfn,$archfn)
{
    $info=stat($phisfn);
    $ouid=sprintf("%6s ", decoct($info[4]));
    $ogid=sprintf("%6s ", decoct($info[5]));
    $omode=sprintf("%6s ", decoct(fileperms($phisfn)));
    $omtime=sprintf("%11s", decoct(filemtime($phisfn)));
    if (@is_dir($phisfn))
    {
         $type="5";
         $osize=sprintf("%11s ", decoct(0));
    }
    else
    {
         $type='';
         $osize=sprintf("%11s ", decoct(filesize($phisfn)));
         clearstatcache();
    }
    $dmajor = '';
    $dminor = '';
    $gname = '';
    $linkname = '';
    $magic = '';
    $prefix = '';
    $uname = '';
    $version = '';
    $chunkbeforeCS=pack("a100a8a8a8a12A12",$archfn, $omode, $ouid, $ogid, $osize, $omtime);
    $chunkafterCS=pack("a1a100a6a2a32a32a8a8a155a12", $type, $linkname, $magic, $version, $uname, $gname, $dmajor, $dminor ,$prefix,'');

    $checksum = 0;
    for ($i=0; $i<148; $i++) $checksum+=ord(substr($chunkbeforeCS,$i,1));
    for ($i=148; $i<156; $i++) $checksum+=ord(' ');
    for ($i=156, $j=0; $i<512; $i++, $j++)    $checksum+=ord(substr($chunkafterCS,$j,1));

    fwrite($f,$chunkbeforeCS,148);
    $checksum=sprintf("%6s ",decoct($checksum));
    $bdchecksum=pack("a8", $checksum);
    fwrite($f,$bdchecksum,8);
    fwrite($f,$chunkafterCS,356);
    return true;
}
//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
// Writes file content to the tar file must be called after a TarAddHeader
// f:file resource provided by fopen
// phisfn: path to file
//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
function TarWriteContents($f,$phisfn)
{
    if (@is_dir($phisfn))
    {
        return;
    }
    else
    {
        $size=filesize($phisfn);
        $padding=$size % 512 ? 512-$size%512 : 0;
        $f2=fopen($phisfn,"rb");
        while (!feof($f2)) fwrite($f,fread($f2,1024*1024));
        $pstr=sprintf("a%d",$padding);
        fwrite($f,pack($pstr,''));
    }
}
//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
// Adds 1024 byte footer at the end of the tar file
// f: file resource
//\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
function TarAddFooter($f)
{
    fwrite($f,pack('a1024',''));
}

?>

