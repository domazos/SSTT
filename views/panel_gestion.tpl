<table class="tabla_panel">
<tr>
	{if (($tipo_usuario == 1) || ($tipo_usuario == 2)) }
	<td>
    	<a href="#" id="usuarios" class="boton_panel">
        	<img src="{$root_dir}images/gestion_usuarios.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Usuarios
      	</a>
   	</td>
    <td>
    	<a href="#" id="contratos" class="boton_panel">
        	<img src="{$root_dir}images/contratos.png" width="60" height="60" border="0">
            <br>Contratos de Reparaci&oacute;n
      	</a>
   	</td>
    <td>
    	<a href="#" id="clientes" class="boton_panel">
        	<img src="{$root_dir}images/clientes.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Clientes
      	</a>
   	</td>
    <td>
    	<a href="#" id="repuestos" class="boton_panel">
        	<img src="{$root_dir}images/repuestos.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Repuestos
      	</a>
   	</td>
    {elseif (($tipo_usuario == 3) || ($tipo_usuario == 4))}
    <td>
    	<a href="#" id="contratos" class="boton_panel">
        	<img src="{$root_dir}images/contratos.png" width="60" height="60" border="0">
            <br>Contratos de Reparaci&oacute;n
      	</a>
   	</td>
    {/if}
    
    
</tr>
</table>