
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
                <h2 style="color: #5c66bf;">Reporte de gastos por día</h2>
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
  
    <table cellspacing="0" style="width: 100%; border: solid 1px #5c66bf; background: #5c66bf; color:white;text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 10%">FECHA</th>
            <th style="width: 60%"></th>
            <th style="width: 15%"></th>
            <th style="width: 15%">MONTO</th>
            
        </tr>
    </table>

	<table cellspacing="0" style="width: 100%; border: solid 1px #5c66bf;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
		
		$sTable="expenses";
        
			list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where created_at between '$fecha_inicial' and '$fecha_final' ";
		
			
			$sWhere.=" group by created_at order by  day(created_at) asc ";
			$sql="SELECT * FROM  $sTable $sWhere";
			$query = mysqli_query($con, $sql);
			$sumador_total=0;
			while ($key=mysqli_fetch_array($query)) {
				 			$date=date('d/m/Y', strtotime($key['created_at']));                    
                            $amount=$key['amount'];
							
							$created_at=$key['created_at'];
									
							$sql_sum=mysqli_query($con,"select SUM(amount) as amount from expenses where created_at='$created_at'");
							$rw=mysqli_fetch_array($sql_sum);	
							$amount=$rw['amount'];
				
	?>
			<tr>
				<td style="width: 10%; text-align: left"><?php echo date("d/m/Y", strtotime($key['created_at'])); ?></td>
				<td style="width: 60%; text-align: left;"></td>
				<td style="width: 15%; text-align: center"></td>
				<td style="width: 15%; text-align: right;"><?php echo number_format($amount,2); ?></td>
				
			</tr>	
				
				<?php
				$sumador_total+=$amount;
			}
		?>     
        <?php 
		    $coin = mysqli_query($con, "select * from configuration where name=\"coin\" ");
                while($r_coin=mysqli_fetch_array($coin)){
                    $coin_c = $r_coin['val'];
                }
       ?>
        
            
		 <tr>
			<td style='text-align:right; border-top:solid 1px #5c66bf' colspan=3><strong>TOTAL <?php echo $coin_c;?></strong> </td>
			<td style='text-align:right; border-top:solid 1px #5c66bf' > <strong><?php echo number_format($sumador_total,2);?></strong></td>
			<td style='text-align:right; border-top:solid 1px #5c66bf' > </td>
		 </tr>
  
    </table>
  

</page>