<table class="tabla_usuarios">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
	<td align="right"><input type="button" id="cargar_repuestos" value="Cargar Repuestos" /> &nbsp; <input type="button" id="recibir_oc" value="Recibir O/C" /></td>
</tr>
<tr>
    <td colspan="2">

    	{if ($cuantos_repuestos <= 0)}
        	<div class="mensaje_no">No existen repuestos para mostrar</div>
        {else}

            <table id="filters" class="tablesorter-metro-dark">
            <thead>
                <tr>
                    <th>Cod. Repuesto</th>
                    <th>Descripci&oacute;n</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
				{for $i=0 to $cuantos_repuestos-1}
                    <tr>
                        <td>{$repuestos[$i]->codigo_repuesto}</td>
                        <td>{$repuestos[$i]->descripcion_repuesto}</td>
                        <td>$ {number_format($repuestos[$i]->precio_venta, 0, '.','.')}</td>
                        <td>{$repuestos[$i]->stock}</td>
                    </tr>
             	{/for}
            </tbody>
            <tfoot>
            	<tr>
            	<td colspan="4">
                	<div id="pager" class="pager tablesorter-metro-dark">
                        <form>
                            <img src="./js/tablesorter-master/addons/pager/icons/first.png" class="first"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/prev.png" class="prev"/>
                            <input type="text" class="pagedisplay"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/next.png" class="next"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/last.png" class="last"/>
                            <select class="pagesize" id="pager_select">
                                <option selected="selected"  value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option  value="40">40</option>
                            </select>
                        </form>
                    </div>
              	</td>
           		</tr>
            </tfoot>
            </table>
		{/if}	                
    </td>
</tr>
</table>



<!-- HTML para recibir OC -->
<div id="dialog-oc" title="Recibir Orden de Compra">
	<form id="finalizar_oc_frm" name="finalizar_oc_frm" method="post" action="" class="ui-front">
        <table class="nuevo_usuario">
        <tr>
            <th width="50%">N&uacute;mero de O/C</th>
            <td><input type="text" name="num_oc" id="num_oc" value="" class="text ui-widget-content ui-corner-all" required>
            </td>
        </tr>
        </table>
        
        <input type="submit" id="finalizar_oc_btn" name="finalizar_oc_btn" style="display:none;" />
        
  	</form>
</div>
<!---------------------------------->


<!-- HTML para recibir OC -->
<div id="dialog-repuestos" title="Cargar Repuestos">
	<form id="formulario" name="formulario" method="post" action="" class="ui-front">
        <table class="nuevo_usuario">
        <tr>
            <td>
            	<!-- progreso -->
                <ul id="progreso">
                    <li class="active">Seleccionar Archivo</li>
                    <li>Finalizar</li>
                </ul>
                
                <fieldset>
                    <h2 class="fs-title">Seleccione un archivo con extensi&oacute;n XLS presionando el bot&oacute;n "Seleccionar Archivo"</h2>
                    <h3 class="fs-subtitle">Paso 1</h3>
                    
                    <input type="file" id="repuestos_upload" name="repuestos_upload" >
                    
                    <br /><br />
                    
             
                    
                    <input type="button" name="next" id="siguiente_carga" class="next action-button" value="Siguiente" disabled="disabled" style="display:none;" />
                
                </fieldset>
                <fieldset>  
                    <h2 class="fs-title" id="titulo_final">&nbsp;</h2>
                    <h3 class="fs-subtitle">Paso 2</h3>
                    
                    <img src="./images/yes.png" id="img_ok" style="display:none;" />
                    
                    <img src="./images/no.png" id="img_error" style="display:none;" />
                    
                    <br /><br />
                    <input type="button" name="previous" id="anterior" class="previous action-button" value="Volver" style="display:none;" />
            
                    <input type="button" name="finalizar_carga" id="finalizar_carga" class="submit action-button" value="Finalizar" style="display:none;"/>
                
                   <br>
                </fieldset>
            
            </td>
        </tr>
        </table>
        
        <input type="submit" id="finalizar_oc_btn" name="finalizar_oc_btn" style="display:none;" />
        
  	</form>
</div>
<!---------------------------------->