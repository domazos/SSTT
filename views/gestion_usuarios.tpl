<table class="tabla_usuarios">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
	<td align="right">{if ($tipo_usuario == 1) }<input type="button" id="nuevo_usuario" value="Crear Nuevo Usuario" />{/if}</td>
</tr>
<tr>
    <td colspan="2">

    	{if ($cuantos_usuarios <= 0)}
        	<div class="mensaje_no">No existen usuarios para mostrar</div>
        {else}

            <table id="filters" class="tablesorter-metro-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tel&eacute;fono</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
				{for $i=0 to $cuantos_usuarios-1}
                    <tr>
                        <td>{$usuarios[$i]->id_usuario}</td>
                        <td>{$usuarios[$i]->nombre}</td>
                        <td>{$usuarios[$i]->correo}</td>
                        <td>{$usuarios[$i]->telefono}</td>
                        <td>{$usuarios[$i]->usuario}</td>
                        <td>{($usuarios[$i]->activo == 1) ? 'Activo' : 'Inactivo'}</td>
                        <td>
                        	<input type="hidden" id="editar_usuario_{$usuarios[$i]->id_usuario}" value="{$usuarios[$i]->id_usuario}" />
                            	<span class="edit">
                                	<a href="#" id="{$usuarios[$i]->id_usuario}" class="editar_usuario" title="Editar Usuario">&nbsp;</a>
                               	</span>
                                
                                <span class="pass">
                                	<a href="#" id="{$usuarios[$i]->id_usuario}" class="pass_usuario" title="Cambiar Pass Usuario">&nbsp;</a>
                               	</span>
                        </td>
                        
                    </tr>
             	{/for}
            </tbody>
            <tfoot>
            	<tr>
            	<td colspan="7">
                	<div id="pager" class="pager tablesorter-metro-dark">
                        <form>
                            <img src="./js/tablesorter-master/addons/pager/icons/first.png" class="first"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/prev.png" class="prev"/>
                            <input type="text" class="pagedisplay"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/next.png" class="next"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/last.png" class="last"/>
                            <select class="pagesize">
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

<div id="dialog-form-usuario" title="Crear Nuevo Usuario">
 
	<form id="nuevo_usuario_frm" name="nuevo_usuario_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="guardar" />
    	<fieldset class="ui-widget ui-corner-all" style="width:90%;">
  		<table class="nuevo_usuario">
        <tr>
        	<td>
            	<table width="100%">
                <tr>
                	<th width="50%"><label for="tipo_usuario">Tipo Usuario</label></th>
                    <td width="50%">
                    	<select name="tipo_usuario" id="tipo_usuario" \>
                    		{$tipos_usuario}
                        </select>
                    
                    </td>
              	</tr>
                <tr>
                	<th><label for="nombre_usuario">Nombre</label></th>
                    <td><input type="text" name="nombre_usuario" id="nombre_usuario" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr>
                    <th><label for="correo_usuario">Correo</label></th>
                    <td><input type="text" name="correo_usuario" id="correo_usuario" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>
                	<th><label for="telefono_usuario">Tel&eacute;fono</label></th>
                    <td><input type="text" name="telefono_usuario" id="telefono_usuario" value="" class="text ui-widget-content ui-corner-all" required ></td>
               	</tr>
                <tr>
                    <th><label for="login_usuario">Login Usuario</label></th>
                    <td><input type="text" name="login_usuario" id="login_usuario" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                	<th><label for="pass_usuario">Contrase&ntilde;a</label></th>
                    <td><input type="password" name="pass_usuario" id="pass_usuario" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>
                	<th><label for="confirm_pass_usuario">Confirmar Contrase&ntilde;a</label></th>
                    <td><input type="password" name="confirm_pass_usuario" id="confirm_pass_usuario" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>    
             		<th colspan="2">
                    	<input type="submit" id="crear_usr_btn" name="crear_usr_btn" style="display:none;" />
                    	<input type="reset" name="limpiar_usuario" id="limpiar_usuario" value="Limpiar Campos" tabindex="-1" >
                  	</th>
                    
                </tr>
                </table>
            </td>       
        </tr>
        
        </table>
		<input type="submit" id="crear_usuario_btn" name="crear_usuario_btn" style="display:none;" />    	
      </fieldset>
	
  </form>
</div>

<!-- HTML para dialog "Editar Usuario" -->

<div id="dialog-form-usuario-edit" title="Editar Usuario">
 
	<form id="editar_usuario_frm" name="editar_usuario_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="editar" />
        <input type="hidden" name="id_usuario_edit" id="id_usuario_edit" value="" />
    	<fieldset class="ui-widget ui-corner-all" style="width:90%;">
  		<table class="nuevo_usuario">
        <tr>
        	<td>
            	<table width="100%">
                <tr>
                	<th width="50%"><label for="tipo_usuario_edit">Tipo Usuario</label></th>
                    <td width="50%">
                    	<select name="tipo_usuario_edit" id="tipo_usuario_edit" \>
                    		{$tipos_usuario}	
                        </select>
                    
                    </td>
              	</tr>
                <tr>
                	<th><label for="nombre_usuario_edit">Nombre</label></th>
                    <td><input type="text" name="nombre_usuario_edit" id="nombre_usuario_edit" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr>
                    <th><label for="correo_usuario_edit">Correo</label></th>
                    <td><input type="text" name="correo_usuario_edit" id="correo_usuario_edit" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>
                	<th><label for="telefono_usuario_edit">Tel&eacute;fono</label></th>
                    <td><input type="text" name="telefono_usuario_edit" id="telefono_usuario_edit" value="" class="text ui-widget-content ui-corner-all" required ></td>
               	</tr>
                <tr>
                    <th><label for="login_usuario_edit">Login Usuario</label></th>
                    <td><input type="text" name="login_usuario_edit" id="login_usuario_edit" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                	<th width="50%"><label for="estado_usuario_edit">Estado Usuario</label></th>
                    <td width="50%">
                    	<select name="estado_usuario_edit" id="estado_usuario_edit" \>
                    			
                        </select>
                    
                    </td>
              	</tr>
                <tr>    
             		<th colspan="2">
                    	<input type="submit" id="editar_usr_btn" name="editar_usr_btn" style="display:none;" />
                    	<input type="reset" name="limpiar_usuario" id="limpiar_usuario" value="Limpiar Campos" tabindex="-1" >
                  	</th>
                    
                </tr>
                </table>
            </td>       
        </tr>
        
        </table>
		<input type="submit" id="editar_usuario_btn" name="editar_usuario_btn" style="display:none;" />    	
      </fieldset>
	
  </form>
</div>

<!--------------------------------------->


<!-- HTML para dialog "Editar Pass Usuario" -->


<div id="dialog-form-usuario-pass" title="Cambiar Pass Usuario">
 
	<form id="pass_usuario_frm" name="pass_usuario_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="pass" />
        <input type="hidden" name="id_usuario_pass" id="id_usuario_pass" value="" />
    	<fieldset class="ui-widget ui-corner-all" style="width:90%;">
  		<table class="nuevo_usuario">
        <tr>
            <th><label for="pass_usuario">Contrase&ntilde;a</label></th>
            <td><input type="password" name="pass_usuario_p" id="pass_usuario_p" value="" class="text ui-widget-content ui-corner-all" required ></td>
        </tr>
        <tr>
            <th><label for="confirm_pass_usuario">Confirmar Contrase&ntilde;a</label></th>
            <td><input type="password" name="confirm_pass_usuario_p" id="confirm_pass_usuario_p" value="" class="text ui-widget-content ui-corner-all" required ></td>
        </tr>
        <tr>    
            <th colspan="2">
                <input type="submit" id="pass_usr_btn" name="pass_usr_btn" style="display:none;" />
                <input type="reset" name="limpiar_usuario" id="limpiar_usuario" value="Limpiar Campos" tabindex="-1" >
            </th>
            
        </tr>
        </table>
          
		<input type="submit" id="pass_usuario_btn" name="pass_usuario_btn" style="display:none;" />    	
      </fieldset>
	
  </form>
</div>

<!--------------------------------------->