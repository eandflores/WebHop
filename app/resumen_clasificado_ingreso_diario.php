<?php
if ($op1=='Pdf') {$wbpagina=10;$encabezado=true;}
$file="resumen_clasificado_ingreso_diario";
	
if (!$archivomaestro) {include ("archivomaestro.php");}
if($op1<>'Pdf'){include("header.php");}

if(!$var_id_se) { $var_id_se=$var_sede; }
if($var_sede==1 ||$var_sede==2 || $var_sede==7 || $var_sede==14|| $var_sede==12){$string_sede="id_se=1 Or id_se=14 or id_se=12";}elseif($var_sede==6 || $var_sede==9 || $var_sede==15){$string_sede="id_se=6 Or id_se=15";}elseif($var_sede==8 || $var_sede==5){$string_sede="id_se=5 Or id_se=8";}elseif($var_sede==4 || $var_sede==3 || $var_sede==10 || $var_sede==11){$string_sede="id_se=3 Or id_se=11";}elseif($var_sede==0 || $var_sede==13){$string_sede="id_se=0";}
//if($op1=='Cancelar'){unset($op1);}

    if($op1<>'Pdf'){
        OpenTable("Resumen clasificado ingreso caja diaria",1);
        echo("<FORM NAME=delmov METHOD=POST ACTION=$PHP_SELF?op=modload&name=$name&file=$file>");
    }

	if($var_rut_eje) {list($nombre_empleado)=Sql_fetch_row(Sql_query("select nombre_pe||' '||apellido_pe From personas where rut_pe=$var_rut_eje"));}
	if($var_id_se>=7){$tipo_alumno=0;}
    $var_hora=date("h:i");
 
	$myfecha=substr($var_fh_pg,6,4)."-".substr($var_fh_pg,3,2)."-".substr($var_fh_pg,0,2);
	//$myfechat=substr($var_fh_pgt,6,4)."-".substr($var_fh_pgt,3,2)."-".substr($var_fh_pgt,0,2);//$myfecha;
	//$myfechat=$myfecha;
	$myfechat=substr($var_fh_pgt,6,4)."-".substr($var_fh_pgt,3,2)."-".substr($var_fh_pgt,0,2);
if($op1=='Pdf' || $op1=='Generar Resumen'){
	unset($_let);unset($_cuo);unset($_mat);unset($_tit);unset($_cer);unset($_int);
	unset($_efe);unset($_chd);unset($_chf);unset($_dep);unset($_tar);
	unset($_id_ca);unset($_sw);unset($_total);
	$_puntero=0;
	$result=Sql_query("Select rut_em From pagos Where fh_pg>='$myfecha'::date And fh_pg<='$myfechat'::date Group by rut_em");
	//echo("SQL: " . "Select rut_em From pagos Where fh_pg>='$myfecha'::date And fh_pg<='$myfechat'::date Group by rut_em");
While ($row=Sql_Fetch_array($result)){
	$sql_consolidado="Select * From Resumen_Clasificado_CajaDiaria($row[0],$var_id_se,'$myfecha'::date,'$myfechat'::date,$tipo_alumno) As Salida_Resumen_Clasificado_CajaDiaria(A,B,C,D,E,F,G,H,I,J,K,M,N,O,P) Order By a;";
	echo "-->$sql_consolidado <br>";
	$result2=Sql_query($sql_consolidado);
	While($row2=Sql_fetch_array($result2)){
	if($excluir==1 And $row2[1]==3){$_autoriza=1;}else{$_autoriza=0;}
	if($_autoriza==0){
		$_id_ca[$row2[9]]=$row2[9];
		$_int[$row2[9]]=$_int[$row2[9]]+$row2[7];
		
		//->if($row2[14]==1 && ($row2[4]==2 || $row2[4]==4 || $row2[4]==26)){
//		if($row2[14]==1){
//		&& ($row2[4]==2 || $row2[4]==4 || $row2[4]==26 || $row[4]==23)){



        $_es_letra=0;
		if($row2[14]==1){if($row2[4]==2 || $row2[4]==4 || $row2[4]==26 || $row2[4]==23){$_es_letra=1;}}
        if($_es_letra==1){
			$_let[$row2[9]]=$_let[$row2[9]]+$row2[6];
		//-->}elseif($row2[14]>100 || $row2[4]==2){
		}elseif($row2[14]>100){
			if($row2[4]==2 || $row2[4]==26 || $row2[4]==4){$_cuo[$row2[9]]=$_cuo[$row2[9]]+$row2[6];}elseif($row2[4]==1){$_mat[$row2[9]]=$_mat[$row2[9]]+$row2[6];}
	    }elseif($row2[4]==2){
			$_cuo[$row2[9]]=$_cuo[$row2[9]]+$row2[6];		
		}elseif($row2[4]==1 || $row2[4]==29 || $row2[4]==25){
			$_mat[$row2[9]]=$_mat[$row2[9]]+$row2[6];
		}elseif($row2[4]==5){
			$_tit[$row2[9]]=$_tit[$row2[9]]+$row2[6];
		}else{
			if($row2[14]==0 && $row2[4]==4){$_cuo[$row2[9]]=$_cuo[$row2[9]]+$row2[6];}else{$_cer[$row2[9]]=$_cer[$row2[9]]+$row2[6];}
		}
		$_total[$row2[9]]=$_let[$row2[9]]+$_cuo[$row2[9]]+$_mat[$row2[9]]+$_tit[$row2[9]]+$_cer[$row2[9]]+$_int[$row2[9]];
		$_total[$row2[9]]=$_total[$row2[9]]+$row2[7]+$row2[6];
		
		if($row2[5]==1){
			$_efe[$row2[9]]=$_efe[$row2[9]]+$row2[6]+$row2[7];
			//-->$_efe[0]=$_efe[0]+$row2[6]+$row2[7];
		}elseif($row2[5]==21){
			$_chd[$row2[9]]=$_chd[$row2[9]]+$row2[6]+$row2[7];
		}elseif($row2[5]==22){
			$_chf[$row2[9]]=$_chf[$row2[9]]+$row2[6]+$row2[7];
		}elseif($row2[5]==3){
			$_dep[$row2[9]]=$_dep[$row2[9]]+$row2[6]+$row2[7];
		}elseif($row2[5]==4){
			$_tar[$row2[9]]=$_tar[$row2[9]]+$row2[6]+$row2[7];
		}
		$_total_2[$row2[9]]=$_efe[$row2[9]]+$_chd[$row2[9]]+$_chf[$row2[9]]+$_dep[$row2[9]]+$_tar[$row2[9]];
	}
	}
}
$_sw=0;$_sql="";unset($_total2);
foreach ($_id_ca as $i => $valor) {
	if($_sw==1){$_sql.=" Union ";}
	list($_carrera)=Sql_fetch_row(Sql_query("Select nombre_ca From carreras Where id_ca=$_id_ca[$i]"));
	$_sql.="Select '$_carrera' As Carrera, to_char(Coalesce('$_let[$i]',0),'999,999,999') As Letra, to_char(Coalesce('$_cuo[$i]',0),'999,999,999') As Cuota, to_char(Coalesce('$_mat[$i]',0),'999,999,999') As Matricula, to_char(Coalesce('$_tit[$i]',0),'999,999,999') As Titulo, to_char(Coalesce('$_cer[$i]',0),'999,999,999') As Cetificados, to_char(Coalesce('$_int[$i]',0),'999,999,999') As Interes, to_char(Coalesce('$_total[$i]',0),'999,999,999') As SubTotal, to_char(Coalesce('$_efe[$i]',0),'999,999,999') As Efectivo, to_char(Coalesce('$_chd[$i]',0),'999,999,999') As Cheque_Dia, to_char(Coalesce('$_chf[$i]',0),'999,999,999') As Cheque_fecha, to_char(Coalesce('$_dep[$i]',0),'999,999,999') As Deposito, to_char(Coalesce('$_tar[$i]',0),'999,999,999') As Tarjeta, to_char(Coalesce('$_total_2[$i]',0),'999,999,999') As SubTotal2";
	echo "SQL: " . $_sql;
	$_sw=1;
	$_let[0]=$_let[0]+$_let[$i];
	$_cuo[0]=$_cuo[0]+$_cuo[$i];
	$_mat[0]=$_mat[0]+$_mat[$i];
	$_tit[0]=$_tit[0]+$_tit[$i];
	$_cer[0]=$_cer[0]+$_cer[$i];
	$_int[0]=$_int[0]+$_int[$i];
	$_total[0]=$_total[0]+$_total[$i];
	$_efe[0]=$_efe[0]+$_efe[$i];
	$_chd[0]=$_chd[0]+$_chd[$i];
	$_chf[0]=$_chf[0]+$_chf[$i];
	$_dep[0]=$_dep[0]+$_dep[$i];
	$_tar[0]=$_tar[0]+$_tar[$i];
	$_total2[0]=$_total2[0]+$_efe[$i]+$_chd[$i]+$_chf[$i]+$_dep[$i]+$_tar[$i];
}
	$_sql.=" Union Select 'Totales' As Carrera, to_char(Coalesce('$_let[0]',0),'999,999,999') As Letra, to_char(Coalesce('$_cuo[0]',0),'999,999,999') As Cuota, to_char(Coalesce('$_mat[0]',0),'999,999,999') As Matricula, to_char(Coalesce('$_tit[0]',0),'999,999,999') As Titulo, to_char(Coalesce('$_cer[0]',0),'999,999,999') As Cetificados, to_char(Coalesce('$_int[0]',0),'999,999,999') As Interes, to_char(Coalesce('$_total[0]',0),'999,999,999') As SubTotal, to_char(Coalesce('$_efe[0]',0),'999,999,999') As Efectivo, to_char(Coalesce('$_chd[0]',0),'999,999,999') As Cheque_Dia, to_char(Coalesce('$_chf[0]',0),'999,999,999') As Cheque_fecha, to_char(Coalesce('$_dep[0]',0),'999,999,999') As Deposito, to_char(Coalesce('$_tar[0]',0),'999,999,999') As Tarjeta, to_char(Coalesce('$_total2[0]',0),'999,999,999') As SubTotal2";
	$_sql.=" Order By Carrera;";

}	
if($op1=='Pdf'){
	$matriz=Array();
	$result=Sql_query("$_sql");
	While ($row=Sql_Fetch_array($result)){
	$data1=array(1=>array('0'=>$row[0],
							'1'=>$row[1],
							'2'=>$row[2],
							'3'=>$row[3],
							'4'=>$row[4],
							'5'=>$row[5],
							'6'=>$row[6],
							'7'=>$row[7],
							'8'=>$row[8],
							'9'=>$row[9],
							'10'=>$row[10],
							'11'=>$row[11],
							'12'=>$row[12],
							'13'=>$row[13]));
	$matriz=array_merge($matriz,$data1);
	}
	list($var_fecha)=Sql_fetch_row(Sql_query("Select fecha_palabras(now()::date)"));
	list($my_sede, $nombre_sede)=Sql_fetch_row(Sql_query("Select sector_se, nombre_se from sedes where id_se=$var_id_se"));
	include('class.ezpdf.php');
$pdf = new Cezpdf('A4','landscape');//portrait
	$mainFont = './fonts/Times-Roman.afm';
	$pdf->selectFont($mainFont);
	$var_otra_hoja=0;
    $pdf->ezSetMargins(5,5,10,10);
	$pdf->addJpegFromFile('images/logoCFT2.jpg',400,550,40,0);
	$pdf->addtext(380,542,7,"<b>Departameto De Cobranza</b>",0);
	$pdf->addtext(600,540,7,$my_sede.", ".$var_fecha." - ".$var_hora.".",0); 
	$pdf->addtext(20,540,5,"_____________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________",0);
    $pdf->addtext(250,525,12,"<b>RESUMEN CLASIFICADO INGRESO CAJA DIARIA</b>",0);
	$pdf->addtext(400,510,12,"<b>Desde: $myfecha - Hasta: $myfechat</b>",0);
	$titulo=array('0'=>"\nCarrera",
							'1'=>"\nLetra",
							'2'=>"\nCuota",
							'3'=>"\nMatricula",
							'4'=>"\nTitulo",
							'5'=>"\nCertificados",
							'6'=>"\nInteres",
							'7'=>"\nSub Total",
							'8'=>"\nEfectivo",
							'9'=>"Cheque\ndía    ",
							'10'=>"Cheque\nFecha\t  ",
							'11'=>"\nDeposito",
							'12'=>"\nTarjeta",
							'13'=>"\nSub Total");
	$pdf->ezText("\n\n\n\n\n\n\n\n",9,array('left'=>10,'right'=>10,'justification'=>'full'));
	$pdf->ezTable($matriz, $titulo," ",array('titleFontSize'=>"8",'fontSize'=>"8",'showLines'=>1,'shaded'=>0,'cols'=>array('10'=>array('justification'=>'right'),'2'=>array('justification'=>'right'),'3'=>array('justification'=>'right'),'4'=>array('justification'=>'right'),'5'=>array('justification'=>'right'),'6'=>array('justification'=>'right'),'7'=>array('justification'=>'right'),'8'=>array('justification'=>'right'),'9'=>array('justification'=>'right'),'10'=>array('justification'=>'right'),'11'=>array('justification'=>'right'),'12'=>array('justification'=>'right'),'13'=>array('justification'=>'right'))));
//exit;
$pdf->ezStream();
}elseif($op1=='Generar Resumen'){
	include("modules/academico/mo_sede.php");
	echo "<br>";
	
	$var_encabezado="Resumen Clasificado Ingreso Caja Diaria<br>Desde: $var_fh_pg - Hasta: $var_fh_pgt";
	$var_titulo_sql="'Resumen Clasificado Ingreso Caja Diaria\nDesde: $var_fh_pg - Hasta: $var_fh_pgt'";
	
	$result2=Sql_Query("$_sql");
	grilla1($result2,1,"","orden8",1, "$var_encabezado");
	$sql="Select $var_titulo_sql; $_sql";

    echo "<input type='hidden' name='var_fh_pg' value='$var_fh_pg'>";
	 echo "<input type='hidden' name='var_fh_pgt' value='$var_fh_pgt'>";
   	echo "<input type='hidden' name='var_id_se' value='$var_id_se'>";
	echo "<input type='hidden' name='tipo_alumno' value='$tipo_alumno'>";
	echo "<input type='hidden' name='excluir' value='$excluir'>";
	//http://sga.crecic.cl - super2345 Crecic
	//$excluir echo("<input type='button' name='link' value='Generar Informe Pdf' onClick=self.location.href='".query("Resumen Clasificado Ingreso Caja Diaria con Fecha $var_fh_pg",$sql,"<texto aling=center size=8 tipo=3></texto>;",2,'Pdf')."'>");
    //echo("<input type='button' name='link' value='Generar Informe Xls' onClick=self.location.href='".query("Resumen Clasificado Ingreso Caja Diaria con Fecha $var_fh_pg",$_sql,"<texto aling=center size=8 tipo=3></texto>;",2,'Xls')."'>");
	echo("&nbsp<input type=submit value='Pdf' name='op1'>");
	echo("<input type='button' name='link' value='Xls' onClick=self.location.href='".query("Resumen Clasificado Ingreso Caja Diaria con Fecha $var_fh_pg",$_sql,"$var_titulo_sql;",2,'Xls')."'>");
	echo("&nbsp<input type=submit value='Cancelar' name='op1'>");
} else {
	include("modules/academico/mo_sede.php");
	echo("<br>");
	echo("<table>");echo("<tr><td>");
	OpenTable("");
		echo "<Table Border='0' Align='Left'>";
		echo "<tr><td nowrap>Sede</td><td nowrap>";$var_id_se=lista_no_modificable(SQL_query("select id_se, nombre_se||', '||id_se From sedes Where $string_sede"),"var_id_se",1,"$var_id_se","id_se",1); echo "</td></tr>";
		if($var_id_se<=6){echo("<Tr><Td nowrap>Tipo Carrera</Td><Td nowrap>");$tipo_alumno=lista_no_modificable(SQL_query("Select 1 as x, 'Distancia' as y Union Select 0 as x, 'Presencial' as y"),"tipo_alumno",1,"$tipo_alumno","x");echo("</td></tr>");}
		echo("<Tr><Td nowrap>Excluir C.I.</Td><Td nowrap>");$excluir=lista_no_modificable(SQL_query("Select 0 as x, 'No' as y Union Select 1 as x, 'Si' as y Order By x;"),"excluir",1,"$excluir","x");echo("</td></tr>");
		echo "<tr><td>Fecha Inicio</td><td nowrap>";
	                if(!$var_fh_pg){$var_fh_pg=date('d-m-Y');}
                    echo("<input type='text' name='var_fh_pg' value='$var_fh_pg' size='10' maxlength='10' >");
                    echo("<img src=".icono("","mimetypes/vcalendar.png.gif","$wbtemaiconos")." border='0' onClick=fechadinamica(document.delmov.var_fh_pg);>");
        echo "</td></tr>";
		
			echo "<tr><td>Fecha Termino</td><td nowrap>";
			if(!$var_fh_pgt){$var_fh_pgt=date('d-m-Y');}
			echo("<input type='text' name='var_fh_pgt' value='$var_fh_pgt' size='10' maxlength='10' >");
			echo("<img src=".icono("","mimetypes/vcalendar.png.gif","$wbtemaiconos")." border='0' onClick=fechadinamica(document.delmov.var_fh_pgt);>");
			echo "</td></tr>";
		
		echo("<Tr><Td Nowrap Colspan=2><input type=submit value='Generar Resumen' name=op1>");
		echo("</td></tr>");
		echo("</Table>");
	CloseTable();
	echo("</td></tr>");echo("</table>");
}
	if($op1<>'Pdf'){
		echo("</form>");
		CloseTable();
		include("footer.php");
	}
?>
<script language="JavaScript" src="incluciones/popcalendar.js"></script>
<script language="JavaScript">
function fechadinamica(link) {
	popcalendar.selectWeekendHoliday(1,1)
	popcalendar.show(link, null, "")
}
popcalendar = getCalendarInstance()
popcalendar.shadow = 1
popcalendar.initCalendar()
</script>