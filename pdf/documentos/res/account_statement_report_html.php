<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
        <?php
            $configuration = mysqli_query($con, "select * from configuration");
        ?>
            <tr>
                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Sistemas Web "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>
        <?php foreach ($configuration as $settings) { ?> 
        <?php if ($settings['name']=="logo") { ?>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../images/<?php echo $settings['val']; ?>" alt="Logo"><br>
            </td>
        <?php } ?>   
		<?php } //end foreach ?>   
            <td style="width: 75%;text-align:right">
                <h2 style="color: #5c66bf;">Reporte de Estado de Cuenta</h2>
            </td>
        </tr>
    </table>
    <br>

	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
		<tr>
			<td style="width: 100%;text-align:right">
			Fecha: <?php echo date("d/m/Y");?>
			</td>
		</tr>
	</table>

    <br>
  
    <table cellspacing="0" style="width: 100%; border: solid 1px #5c66bf; background: #5c66bf;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 15%">FECHA</th>            
            <th style="width: 40%">DESCRIPCION</th>
            <th style="width: 15%">DEBITO</th>
            <th style="width: 15%">CREDITO</th>
            <th style="width: 15%">BALANCE</th>
            
            
        </tr>
    </table>

	<table cellspacing="0" style="width: 100%; border: solid 1px #5c66bf;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php

      $sTable="transactions_all";
			
			list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where date_transaction between '$fecha_inicial' and '$fecha_final' ";		
			if ($account_id>0){
                $sWhere .=" and account_id='$account_id'";
            }
			 if ($type>0){
                $sWhere .=" and type_transaction='$type'";
            }
			$sWhere.=" order by id_transaction asc";
			$sql="SELECT * FROM  $sTable $sWhere";
			$query = mysqli_query($con, $sql);
			$sumador_total_debit=0;
            $sumador_total_credit=0;
			while ($key=mysqli_fetch_array($query)) {
				$date=$key['date_transaction'];
                $description=$key['description'];
                $type=$key['type_transaction'];
                $debit=$key['debit'];
                $credit=$key['credit'];
                $balance=$key['balance'];


                 
				 ?>
			<tr>
				<td style="width: 15%; text-align: center"><?php echo date("d/m/Y", strtotime($date)); ?></td>
                <td style="width: 40%; text-align: left;"><?php echo $description; ?></td>
                <td style="width: 15%; text-align: center"><?php echo number_format($debit,2); ?></td>
				<td style="width: 15%; text-align: center;"><?php echo  number_format($credit,2); ?></td>
				<td style="width: 15%; text-align: right;"><?php echo number_format($balance,2); ?></td>
				
			</tr>	 
				 <?php
				 $sumador_total_debit+=$debit;
                 $sumador_total_credit+=$credit;
			}	

    ?>     
        <?php 
                $coin = mysqli_query($con, "select * from configuration where name=\"coin\" ");
                while($r_coin=mysqli_fetch_array($coin)){
                    $coin_c = $r_coin['val'];
                }
       ?>
        
           
		<tr>
            
             
			<td style='text-align:center; border-top:solid 1px #5c66bf;'><strong>TOTAL <?php echo $coin_c;?></strong> </td>
            <td style='text-align:center; border-top:solid 1px #5c66bf' > </td>
			<td style='text-align:center; border-top:solid 1px #5c66bf' > <strong><?php echo number_format($sumador_total_debit,2);?></strong></td>
            <td style='text-align:center; border-top:solid 1px #5c66bf' > <strong><?php echo number_format($sumador_total_credit,2);?></strong></td>
            <td style='text-align:right; border-top:solid 1px #5c66bf' > <strong><?php echo number_format($balance,2);?></strong></td>
			
		 </tr>
    </table>
    <br><br><br><br>	
	
</page>