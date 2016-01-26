<style type="text/Css">
<!--
.tabla_oc
{
    border: solid 1px #FF0000;
    background: #FFFFFF;
    border-collapse: collapse;
}
-->
</style>
<page style="font-size: 14px">
    <table style="text-align: left; width: 80%" align="left">
    <tr>
    	<td style="width: 100%;"><img src="../images/logo.jpg" width="200" height="60"></td>
    </tr>
    <tr>
    	<td style="width:100%; font-size:10px; font-weight:bold;">C. Conquistador del Monte 5024<br>
Huechuraba - Santiago<br>
Fono : 6781200<br>
Rut : 96.999.950-1</td>
    </tr>
    </table>
    
    <br><br>
    
    <table style="text-align: center; width: 80%" align="center">
    <tr>
    	<td style="width: 100%; text-transform:uppercase; font-size:16px; font-weight:bold;">Orden de Compra N&deg;: <?php echo $id_oc; ?></td>
    </tr>
    <tr>
    	<td style="width:100%;">Perteneciente al contrato N&deg;:<?php echo $id_contrato; ?></td>
    </tr>
    </table>
    
    <br /><br />
    
    <table style="text-align: left; width: 90%; text-transform:uppercase; font-size:10px;" align="center">
    <tr>
    	<th style="width: 12%">Se&Ntilde;ores</th>
        <td style="width: 38%"> : <?php echo $para_oc; ?></td>
        
        <th style="width: 12%">RUT</th>
        <td style="width: 38%"> : <?php echo $rut_oc; ?></td>
    </tr>
    <tr>
    	<th style="width: 12%">Atenci&Oacute;n</th>
        <td style="width: 38%"> : <?php echo $atencion_oc; ?></td>
        
        <th style="width: 15%">Fecha de emisi&Oacute;n</th>
        <td style="width: 35%"> : <?php echo $fecha_oc; ?></td>
    </tr>
    <tr>
    	<th style="width: 12%">Tel&Eacute;fono</th>
        <td style="width: 38%"> : <?php echo $fono_oc; ?></td>
        
        <td style="width: 12%">&nbsp;</td>
        <td style="width: 38%">&nbsp;</td>
    </tr>
    </table>
    
    <br /><br /><br />
    
    
    <table style="text-align: center; width: 87%; font-size:10px; border: 2px #000 solid;" align="center" cellpadding="0" cellspacing="0">
    <tr>
    	<th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:5%">#</th>
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:15%">N&deg; Art&iacute;culo</th>
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:30%">Descripci&oacute;n</th>
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:15%">Cantidad</th>
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:15%">Precio</th>
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:15%">Descuento</th>
        <th style="border-bottom: 2px #000 solid; width:20%">Total</th>
    </tr>
    <?php echo $cuerpo_detalle; ?>
    
    </table>
    
    <br><br>
    
    <table style="text-align: right; width: 50%; font-size:10px; border: 2px #000 solid; margin-right:150px;" align="right" cellpadding="0" cellspacing="0">
    <tr style="line-height:50px;">
    	<th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:20%">Subtotal</th>
        <td style="border-bottom: 2px #000 solid; width:20%;">$ <?php echo number_format($sub_total, 0, '.','.'); ?></td>
    </tr>
    <tr style="line-height:50px;">
        <th style="border-bottom: 2px #000 solid; border-right: 2px #000 solid; width:20%">Impuesto</th>
        <td style="border-bottom: 2px #000 solid; width:20%;">$ <?php echo number_format($iva, 0, '.','.'); ?></td>
    </tr>
    <tr style="line-height:50px;">
        <th style="border-right: 2px #000 solid; width:20%">Total</th>
        <td style="width:20%;">$ <?php echo number_format($total, 0, '.','.'); ?></td>
        
    </tr>
    </table>
    
    <br /><br />
    
    <table style="text-align: left; width: 95%; text-transform:uppercase; font-size:10px;" align="left">
    <tr>
    	<th style="width: 25%">Fecha de Entrega</th>
        <td style="width: 75%"> : <?php echo date("d-m-Y"); ?></td>
    </tr>
    <tr>
    	<th style="width: 25%">Condiciones de Pago</th>
        <td style="width: 75%"> : Cta. Cte. 30 d&iacute;as</td>
    </tr>
    <tr>
    	<th style="width: 25%">Observaciones</th>
        <td style="width: 75%"> : <?php echo $obs; ?></td>
	</tr>
    </table>    
    
    
    <br /><br />
    
    <div align="left" style="font-weight:bold; font-size:14px; text-decoration:underline;">FACTURAR Y DESPACHAR A:</div>
    <br>
    <table style="text-align: left; width: 95%; font-size:10px;" align="left">
    <tr>
    	<th style="width: 25%">Empresa</th>
        <td style="width: 70%; font-weight:bold;"> : REIFSCHNEIDER S.A</td>
    </tr>
    <tr>
    	<th style="width: 25%">Rut</th>
        <td style="width: 70%; font-weight:bold;"> : 96.999.950-1</td>
    </tr>
    <tr>
    	<th style="width: 25%">Direcci&oacute;n</th>
        <td style="width: 70%; font-weight:bold;"> : CAM EL CONQUISTADOR DEL MONTE 5024 <br>
									HUECHURABA - SANTIAGO - CHILE RM 8590909</td>
	</tr>
    <tr>
    	<th style="width: 25%">Fono</th>
        <td style="width: 70%; font-weight:bold;"> : (56-2) 26781200</td>
    </tr>
    </table>
    
    <br><br><br><br>
    <table style="text-align: center; width: 95%; font-size:10px; border:2px #000 solid;" align="center">
    <tr>
    	<th style="width: 100%; border-bottom:2px #000 solid;">FAVOR CITAR EL N° DE ORDEN DE COMPRA EN TODAS LAS GUIAS Y FACTURAS</th>
    </tr>
    <tr>
    	<th style="width: 100%;">ENTREGAS : LUNES a VIERNES desde las 08:30 hasta las 13:30 hrs.</th>
    </tr>
    </table>
</page>