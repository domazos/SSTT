<!-- HTML para cargar repuestos -->
<table class="tabla_usuarios" style="width:60%;">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
</tr>
<tr>
    <td colspan="2" align="center">
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
                            <div id="uploader">
                                <p>Tu navegador no soporta Flash, Silverlight o HTML5. Lamentablemente no puedes cargar archivos.<br>Te recomendamos actualizar a la &uacute;ltima versi&oacute;n de tu navegador preferido, para poder utilizar nuestro Sistema.</p>
                            </div>
                        
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
        
        	
        
  		</form>
   	</td>
</tr>
</table>
<!---------------------------------->