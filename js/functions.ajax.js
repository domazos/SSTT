/**=============================================================================
 *
 *	Filename:  function.ajax.js
 *	
 *	(c)Autor: Arkos Noem Arenom
 *	
 *	Description: Ajax para hacer las consultas
 *	
 *	Licence: GPL|LGPL
 *	
 * 	Modificaciones: Jorge Domazos
 *===========================================================================**/

$(document).ready(function(){

	var timeSlide = 800;
	var id_guia = 0;
	
	$('#login_username').focus();
	$('#timer').hide(0);
	$('#timer').css('display','none');
	$('#timer_logout').hide(0);
	$('#timer_logout').css('display','none');
	$('#login_userbttn').on("click", function(){
		$('#timer').fadeIn(300);
		$('.box-info, .box-success, .box-alert, .box-error').fadeIn(timeSlide);
		setTimeout(function(){
			if ( $('#login_username').val() != "" && $('#login_userpass').val() != "" ){
				
				$.ajax({
					type: 'POST',
					url: 'include/log.inout.ajax.php',
					data: 'login_username=' + $('#login_username').val() + '&login_userpass=' + $('#login_userpass').val(),
					success:function(msj){
			
						if ( msj == 1 ){
							$('#alertBoxes').html('<div class="box-success"></div>');
							$('.box-success').hide(0).html('Espera un momento&#133;');
							$('.box-success').fadeIn(timeSlide);
							setTimeout(function(){
								window.location.href = "panel_gestion.php";
							},(timeSlide + 500));
						}
						else if(msj == 2)
						{
							$('#alertBoxes').html('<div class="box-info"></div>');
							$('.box-info').hide(0).html('Su usuario se encuentra inactivo.');
							$('.box-info').fadeIn(timeSlide);							
						}
						else{
							$('#alertBoxes').html('<div class="box-error"></div>');
							$('.box-error').hide(0).html('Lo sentimos, pero los datos ingresados son incorrectos.');
							$('.box-error').fadeIn(timeSlide);
						}
						$('#timer').fadeOut(300);
					},
					error:function(){
						$('#timer').fadeOut(300);
						$('#alertBoxes').html('<div class="box-error"></div>');
						$('.box-error').hide(0).html('Ha ocurrido un error durante la ejecución');
						$('.box-error').fadeIn(timeSlide);
					}
				});
				
			}
			else{
				$('#alertBoxes').html('<div class="box-alert"></div>');
				$('.box-alert').hide(0).html('Los campos estan vacios');
				$('.box-alert').fadeIn(timeSlide);
				$('#timer').fadeOut(300);
			}
		},timeSlide);
		
		return false;
		
	});
	
	
	$('#logout').on("click", function(){
		$('#timer_logout').fadeIn(300);
		$('#alertBoxes').html('<div class="box-success"></div>');
		$('.box-success').hide(0).html('Espera un momento&#133;');
		$('.box-success').fadeIn(timeSlide);
		setTimeout(function(){
			window.location.href = "./include/logout.php";
		},2500);
	});
	
	
	$("table") 
    .tablesorter({widthFixed: false, widgets: ['zebra', 'filter'], sortReset   : true,  sortRestart : true}) 
    .tablesorterPager({container: $("#pager")});
	
	
	// Capturamos el evento "click" de los elementos con clase "boton_panel", para direccionar a la interfaz correspondiente
	
	$('.boton_panel').on("click", function()
	{
		var id = $(this).attr("id");
		
		switch(id)
		{
			case "usuarios"		: 	window.location = './gestion_usuarios.php';
									break;
			case "contratos"	: 	window.location = './gestion_contratos.php';
									break;
			case "clientes"		: 	window.location = './gestion_clientes.php';
									break;
			case "repuestos"	: 	window.location = './gestion_repuestos.php';
									break;
			default				: 	window.location = './index.php';

		}
	});
	
	
	// Asignamos estilo selectmenu de jQuery UI al selector del dialog
	
	$('select').selectmenu({width: 200});
	
	$('#pager_select').selectmenu( "destroy" );
	
	$('#region_cliente').selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
	$('#comuna_cliente').selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
	$('#region_cliente_contrato').selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
	$('#comuna_cliente_contrato').selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
	//////////////////////////////////////////////////////////////////
	// USUARIOS														//
	//////////////////////////////////////////////////////////////////
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el botón "Nuevo Usuario"
	
	$("#nuevo_usuario").on("click", function()
	{
		dialog_crear_usuario.dialog( "open" );	 
	});
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el link "Editar Usuario"
	
	$(".editar_usuario").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_editar_usuario.data('id_usuario', id).dialog( "open" );	 
	});
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el link "Cambiar Pass Usuario"
	
	$(".pass_usuario").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_pass_usuario.data('id_usuario', id).dialog( "open" );	 
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-form-usuario'
	
	dialog_crear_usuario = $( "#dialog-form-usuario" ).dialog({
      autoOpen: false,
      height: 400,
      width: 550,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Crear Usuario': function() { crearUsuario(); },
		  
		  
                'Cancelar': function() { limpiaForm('nuevo_usuario_frm', '-'); $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  $('#nombre_usuario').focus();
	  },
      close: function() {
        limpiaForm('nuevo_usuario_frm', '-');
      }
    });
	
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_crear_usuario.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-form-usuario-edit'
	
	dialog_editar_usuario = $( "#dialog-form-usuario-edit" ).dialog({
		autoOpen: false,
		height: 370,
		width: 550,
		modal: true,
		closeOnEscape: false,
		show: 	{
					effect: "fade",
					duration: 500
		  		},
		hide: 	{
					effect: "fade",
					duration: 500
		  		},
		buttons: {
					'Editar Usuario': function() { editarUsuario(); },
			  
			  
					'Cancelar': function() { limpiaForm('editar_usuario_frm', '-'); $(this).dialog('close');}
		},
		open: function( event, ui )
		{
			$.post('./include/detalle_usuario.php', {id_usuario : $(this).data('id_usuario')}, function(data)
		  	{

				if(data.resultado == "OK")
				{

					$('#id_usuario_edit').val(data.id_usuario);
					$('#nombre_usuario_edit').val(data.nombre);
					
					$('#tipo_usuario_edit').html(data.tipo_usuario);
					$('#tipo_usuario_edit').selectmenu("refresh");
					
					$('#estado_usuario_edit').html(data.estado);
					$('#estado_usuario_edit').selectmenu("refresh");
					
					$('#correo_usuario_edit').val(data.correo);
					$('#telefono_usuario_edit').val(data.telefono);
					$('#login_usuario_edit').val(data.login);
					
				}
				else
					$.prompt("Ha ocurrido un error al intentar recuperar la informaci&oacute;n del usuario.<br>Favor intentar nuevamente, y si el problema persiste informar al administrador del sistema.<br><br>Error: " + data.error, { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });
		  	}, 'json');
		  
		  	$('#nombre_usuario_edit').focus();
	  	},
      	close: function() {
        	limpiaForm('editar_usuario_frm', '-');
      	}
    });
	
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_editar_usuario.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-form-usuario-pass'
	
	dialog_pass_usuario = $( "#dialog-form-usuario-pass" ).dialog({
		autoOpen: false,
		height: 250,
		width: 500,
		modal: true,
		closeOnEscape: false,
		show: 	{
					effect: "fade",
					duration: 500
		  		},
		hide: 	{
					effect: "fade",
					duration: 500
		  		},
		buttons: {
					'Cambiar Pass Usuario': function() { passUsuario(); },
			  
			  
					'Cancelar': function() { limpiaForm('pass_usuario_frm', '-'); $(this).dialog('close');}
		},
		open: function( event, ui )
		{
			$('#id_usuario_pass').val($(this).data('id_usuario'));
			$('#pass_usuario').focus();
	  	},
      	close: function() {
        	limpiaForm('pass_usuario_frm', '-');
      	}
    });
	
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_pass_usuario.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	$('#limpiar_usuario').on('click', function()
	{
		limpiaForm();
	});
	
	function crearUsuario() {
		$('#crear_usr_btn').click();
	}
	
	function editarUsuario() {
		$('#editar_usr_btn').click();
	}
	
	function passUsuario() {
		$('#pass_usr_btn').click();
	}
	
	
	//////////////////////////////////////////////////////////////////
	// FIN USUARIOS													//
	//////////////////////////////////////////////////////////////////
	
	
	
	
	//////////////////////////////////////////////////////////////////
	// CLIENTES														//
	//////////////////////////////////////////////////////////////////
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el botón "Nuevo Cliente"
	
	$("#nuevo_cliente").on("click", function()
	{
		dialog_crear_cliente.dialog( "open" );	 
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-cliente-new'
	
	dialog_crear_cliente = $( "#dialog-cliente-new" ).dialog({
      autoOpen: false,
      height: 550,
      width: 550,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Crear Cliente': function() { $('#crear_cliente_btn').click(); },
		  
		  
                'Cancelar': function() { limpiaForm('nuevo_cliente_frm', '-'); $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  	$('#tipo_cliente').selectmenu("refresh");
		 	$('#region_cliente').selectmenu("refresh");

			$.post("./include/carga_comunas.php", {id_region : 1}, function(data)
												{
													$('#comuna_cliente').html(data);
													$('#comuna_cliente').selectmenu("refresh");
												});
														  
										 
			$('#region_cliente').selectmenu("refresh");
			
		 	$('#region_cliente').selectmenu({
			  								change: function( event, ui ) 
											{
												$.post("./include/carga_comunas.php", {id_region : $(this).val()}, function(data)
												{
													$('#comuna_cliente').html(data);
													$('#comuna_cliente').selectmenu("refresh");
												});
														  
											}
										});
			
			$('#rut_cliente_tr').fadeIn();
			$('#cod_cliente_tr').fadeOut();
			$('#tienda_tr').fadeOut();
			
			$('#rut_cliente').focus();
			$('#rut_cliente').Rut({format_on: 'blur' });
			
			$('#tipo_cliente').selectmenu({
											change: function( event, ui )
											{
												var id = $(this).val();

												if(id == 1)
												{
													$('#rut_cliente_tr').fadeIn();
													$('#cod_cliente_tr').fadeOut();
													$('#tienda_tr').fadeOut();
													$('#cod_cliente').val(0);
													$('#tienda_cliente').html('<option value="0">0</option>');
													$('#rut_cliente').focus();
														
												}
												else if(id == 2)
												{
													
													$.post('./include/consulta_cod_cliente.php', function(data)
													{
														$('#cod_cliente').val(data);
														$('#rut_cliente_tr').fadeOut();
														$('#tienda_tr').fadeOut();
														$('#cod_cliente_tr').fadeIn();
														$('#tienda_cliente').html('<option value="0">0</option>');
														$('#rut_cliente').val('');
														$('#nombre_cliente').focus();
													});
													
												}
												else if(id == 3)
												{
													
													$.post('./include/carga_tiendas.php', function(data)
													{	
														$('#tienda_cliente').html(data);
														$('#tienda_cliente').selectmenu("refresh");
														$('#rut_cliente_tr').fadeOut();
														$('#cod_cliente_tr').fadeOut();
														$('#tienda_tr').fadeIn();
													});
													
												}
												else
												{
													$('#rut_cliente_tr').fadeIn();
													$('#cod_cliente_tr').fadeOut();
													$('#cod_cliente').val(0);
													$('#rut_cliente').focus();
													
												}
												
												$('#tipo_cliente').selectmenu("refresh");
											}
			});
			
	  },
      close: function() {
        limpiaForm('nuevo_cliente_frm', '-');
      }
    });
	
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_crear_cliente.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el link "Editar Cliente"
	
	$(".editar_cliente").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_editar_cliente.data('id_cliente', id).dialog( "open" );	 
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-cliente-edit'
	
	dialog_editar_cliente = $( "#dialog-cliente-edit" ).dialog({
		autoOpen: false,
		height: 550,
		width: 550,
		modal: true,
		closeOnEscape: false,
		show: 	{
					effect: "fade",
					duration: 500
		  		},
		hide: 	{
					effect: "fade",
					duration: 500
		  		},
		buttons: {
					'Editar Cliente': function() { $('#editar_cliente_btn').click(); },
			  
			  
					'Cancelar': function() { limpiaForm('editar_cliente_frm', '-'); $(this).dialog('close');}
		},
		open: function( event, ui )
		{
			$.post('./include/detalle_cliente.php', {id_cliente : $(this).data('id_cliente')}, function(data)
		  	{

				if(data.resultado == "OK")
				{

					$('#id_cliente_edit').val(data.id_cliente);
										
					$('#tipo_cliente_edit').html(data.tipo_cliente);
					$('#tipo_cliente_edit').selectmenu("refresh");
					
					var digito = $.Rut.getDigito(data.rut);
					var rut_format = $.Rut.formatear(data.rut, digito);
										
					
					
					$('#rut_cliente_edit').Rut({format_on: 'blur' });	
					
					
					var tipo_cliente_edit = $('#tipo_cliente_edit').val();
					
					
					if(tipo_cliente_edit == 1)
					{
						$('#rut_cliente_edit').val(rut_format);
						$('#rut_cliente_tr_edit').fadeIn();
						$('#cod_cliente_tr_edit').fadeOut();
						$('#cod_cliente_edit').val(0);
						$('#rut_cliente_edit').focus();	
					}
					else if(tipo_cliente_edit == 2)
					{
						$('#cod_cliente_edit').val(data.cod_cliente);
						$('#rut_cliente_tr_edit').fadeOut();
						$('#cod_cliente_tr_edit').fadeIn();
						$('#rut_cliente_edit').val(0);
						$('#nombre_cliente_edit').focus();	
					}
					else
					{
						$('#rut_cliente_edit').val(rut_format);
						$('#rut_cliente_tr_edit').fadeIn();
						$('#cod_cliente_tr_edit').fadeOut();
						$('#cod_cliente_edit').val(0);
						$('#rut_cliente_edit').focus();		
					}
					
					
					$('#tipo_cliente_edit').selectmenu({
											change: function( event, ui )
											{
												var id = $(this).val();
												
												
												
												/*if(id == 1)
												{
													$('#rut_cliente_tr_edit').fadeIn();
													$('#cod_cliente_tr_edit').fadeOut();
													$('#cod_cliente_edit').val(0);
													$('#rut_cliente_edit').focus();
														
												}
												else if(id == 2)
												{
													
													$.prompt('&iquest;Est&aacute; seguro que desea modificar el tipo de cliente?<br>Esta acci&oacute;n implica borrar el Rut registrado.', { 
															buttons : { 'OK' : true, 'Cancelar' : false }, 
															submit: function(e,v,m,f) 
															{ 
																if(v)
																{
																	$.post('./include/consulta_cod_cliente.php', function(data)
																	{
																		$('#rut_cliente_edit').val('');
																		$('#cod_cliente_edit').val(data);
																		$('#rut_cliente_tr_edit').fadeOut();
																		$('#cod_cliente_tr_edit').fadeIn();
																		$('#nombre_cliente_edit').focus();
																	});				
																}
																else
																{
																	$('#tipo_cliente_edit').html(data.tipo_cliente);
																	$('#tipo_cliente_edit').selectmenu("refresh");
																	$.prompt.close();
																}
															} 
														});
													
												}
												else
												{
													$('#rut_cliente_tr_edit').fadeIn();
													$('#cod_cliente_tr_edit').fadeOut();
													$('#cod_cliente_edit').val(0);
													$('#rut_cliente_edit').focus();
													
												}*/
												
												if(id == 1)
												{
													$('#rut_cliente_tr_edit').fadeIn();
													$('#cod_cliente_tr_edit').fadeOut();
													$('#tienda_tr_edit').fadeOut();
													$('#cod_cliente_edit').val(0);
													$('#tienda_cliente_edit').html('<option value="0">0</option>');
													$('#rut_cliente_edit').focus();
														
												}
												else if(id == 2)
												{
													
													$.post('./include/consulta_cod_cliente.php', function(data)
													{
														$('#cod_cliente_edit').val(data);
														$('#rut_cliente_tr_edit').fadeOut();
														$('#tienda_tr_edit').fadeOut();
														$('#cod_cliente_tr_edit').fadeIn();
														$('#tienda_cliente_edit').html('<option value="0">0</option>');
														$('#rut_cliente_edit').val('');
														$('#nombre_cliente_edit').focus();
													});
													
												}
												else if(id == 3)
												{
													
													$.post('./include/carga_tiendas.php', function(data)
													{	
														$('#tienda_cliente_edit').html(data);
														$('#tienda_cliente_edit').selectmenu("refresh");
														$('#rut_cliente_tr_edit').fadeOut();
														$('#cod_cliente_tr_edit').fadeOut();
														$('#tienda_tr_edit').fadeIn();
													});
													
												}
												else
												{
													$('#rut_cliente_tr_edit').fadeIn();
													$('#cod_cliente_tr_edit').fadeOut();
													$('#cod_cliente_edit').val(0);
													$('#rut_cliente_edit').focus();
													
												}
												
												$('#tipo_cliente_edit').selectmenu("refresh");
											}
			});
					
					
					
					$('#nombre_cliente_edit').val(data.nombre);
					$('#direccion_cliente_edit').val(data.direccion);
					
					$('#region_cliente_edit').html(data.region);
					$('#region_cliente_edit').selectmenu("refresh");
					
					$('#comuna_cliente_edit').html(data.comuna);
					$('#comuna_cliente_edit').selectmenu("refresh");
					
					$('#region_cliente_edit').selectmenu({
			  								change: function( event, ui ) 
											{
												$.post("./include/carga_comunas.php", {id_region : $(this).val()}, function(data)
												{
													$('#comuna_cliente_edit').html(data);
													$('#comuna_cliente_edit').selectmenu("refresh");
												});
														  
											}
										});
					
					$('#correo_cliente_edit').val(data.correo);
					$('#contacto_cliente_edit').val(data.contacto);
					
					$('#telefono_cliente_edit').val(data.telefono);
					$('#celular_cliente_edit').val(data.celular);
					
					$('#estado_cliente_edit').html(data.estado);
					$('#estado_cliente_edit').selectmenu("refresh");
					
				}
				else
					$.prompt("Ha ocurrido un error al intentar recuperar la informaci&oacute;n del cliente.<br>Favor intentar nuevamente, y si el problema persiste informar al administrador del sistema.<br><br>Error: " + data.error, { submit: function(e,v,m,f) { actualiza(v, './gestion_clientes.php'); } });
		  	}, 'json');
		  
		  	$('#rut_cliente_edit').focus();
	  	},
      	close: function() {
        	limpiaForm('editar_cliente_frm', '-');
      	}
    });
	
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_editar_cliente.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	//////////////////////////////////////////////////////////////////
	// FIN CLIENTES													//
	//////////////////////////////////////////////////////////////////
	
	
	
	
	//////////////////////////////////////////////////////////////////
	// CONTRATOS													//
	//////////////////////////////////////////////////////////////////
	
	
	// Instanciamos un calendario en el campo fecha_recepcion
	
	$("#fecha_recepcion").datetimepicker({
											showOn: "button",
										  	buttonImage: "images/date.png",
										  	buttonImageOnly: true,
										  	showWeek: false,
										  	showOtherMonths: true,
										  	selectOtherMonths: true,
										  	changeMonth: true,
										  	changeYear: true,
										  	minDate: "-2y",
										  	maxDate: 0,
										});
	
	
	
	$('#fecha_boleta').datepicker({
									showOn: "button",
									buttonImage: "images/date.png",
									buttonImageOnly: true,
									showWeek: false,
									showOtherMonths: true,
									selectOtherMonths: true,
									changeMonth: true,
									changeYear: true,
									minDate: "-2y",
									maxDate: 0,
								});
	
	$('#fecha_diagnostico, #fecha_entrega').datepicker({
									showOn: "button",
									buttonImage: "images/date.png",
									buttonImageOnly: true,
									showWeek: false,
									showOtherMonths: true,
									selectOtherMonths: true,
									changeMonth: true,
									changeYear: true,
									minDate: 0
								});
								
	$('#fecha_termino_d').datepicker({
									
									buttonImage: "",
									buttonImageOnly: true,
									showWeek: false,
									showOtherMonths: true,
									selectOtherMonths: true,
									changeMonth: true,
									changeYear: true
								});
								
	$('#fecha_inicio_d, #fecha_ppto').datetimepicker({
									showOn: "button",
									buttonImage: "images/date.png",
									buttonImageOnly: true,
									showWeek: false,
									showOtherMonths: true,
									selectOtherMonths: true,
									changeMonth: true,
									changeYear: true,
									minDate: 0,
									maxDate: 0,
								});
								

	
	
	
	$( "#fecha_recepcion, #fecha_boleta, #fecha_diagnostico, #fecha_entrega, #fecha_inicio_d, #fecha_termino_d, #fecha_ppto" ).datepicker( $.datepicker.regional[ "es" ] );
	$( "#fecha_recepcion, #fecha_boleta, #fecha_diagnostico, #fecha_entrega, #fecha_inicio_d, #fecha_termino_d, #fecha_ppto" ).datepicker( "option", "showAnim", "show" );
	
	
	$("#chk_garantia, #chk_buscar, #chk_garantia_diag").buttonset();
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el botón "Nuevo Cliente"
	
	$("#nuevo_contrato").on("click", function()
	{
		dialog_crear_contrato.dialog( "open" );	 
	});
	
	
	$(".fancybox").fancybox();
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-new'
	
	var uploader;
	
	$('body').on("click", '.delete', function()
						{
							var id = $(this).attr("id");
							var parent_id = $(this).closest("div").attr("id");
							eliminaImagen(id, parent_id);
							
						});
	
	dialog_crear_contrato = $( "#dialog-contrato-new" ).dialog({
      autoOpen: false,
      height: 600,
      width: 900,
	  minWidth: 900,
	  minHeight: 600,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Crear Contrato': function() { $('#crear_contrato_btn').click(); $('#crear_contrato_btn').attr('disabled', 'disabled'); },
		  
		  
                'Cancelar': function() { limpiaForm('nuevo_contrato_frm', '-'); $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		
		  	
		  	var currentDate = new Date();  
			
			$("#fecha_recepcion").datepicker("setDate", currentDate);
			
			
			$.post('./include/calcula_fecha.php', {dias: 5}, function(data)
			{

				var parse_date = $.datepicker.parseDate("yy-mm-dd", data);
				
				$('#fecha_diagnostico').datepicker("setDate", parse_date);
				
			});
			
			$.post('./include/calcula_fecha.php', {dias: 20}, function(data)
			{

				var parse_date = $.datepicker.parseDate("yy-mm-dd", data);
				
				$('#fecha_entrega').datepicker("setDate", parse_date);
				
			});
			
	
		  	$('#tipo_cliente_contrato').selectmenu("refresh");
		 	$('#region_cliente_contrato').selectmenu("refresh");
			$('#comuna_cliente_contrato').selectmenu("refresh");
			$('#tipo_ingreso').selectmenu("refresh");
		 	
			
			$.post("./include/carga_comunas.php", {id_region : 1}, function(data)
												{
													$('#comuna_cliente_contrato').html(data);
													$('#comuna_cliente_contrato').selectmenu("refresh");
												});
			$('#region_cliente_contrato').selectmenu("refresh");
			
		 	$('#region_cliente_contrato').selectmenu({
			  								change: function( event, ui ) 
											{
												$.post("./include/carga_comunas.php", {id_region : $(this).val()}, function(data)
												{
													$('#comuna_cliente_contrato').html(data);
													$('#comuna_cliente_contrato').selectmenu("refresh");
												});
														  
											}
										});
			
			$('#rut_cliente_tr_contrato').fadeIn();
			$('#cod_cliente_tr_contrato').fadeOut();
			$('#tienda_tr_contrato').fadeOut();
			
			$('#tipo_cliente_contrato').selectmenu("refresh");
			
			$('#rut_cliente_contrato').Rut({format_on: 'blur' });
			
			$('#tipo_cliente_contrato').selectmenu({
											change: function( event, ui )
											{
												var id = $(this).val();
												
												if(id == 1)
												{
													$('#rut_cliente_tr_contrato').fadeIn();
													$('#cod_cliente_tr_contrato').fadeOut();
													$('#tienda_tr_contrato').fadeOut();
													$('#cod_cliente_contrato').val(0);
													$('#tienda_cliente_contrato').html('<option value="0">0</option>');
													$('#tienda_cliente_contrato').selectmenu("refresh");
													$('#rut_cliente_contrato').focus();
														
												}
												else if(id == 2)
												{
													
													$.post('./include/consulta_cod_cliente.php', function(data)
													{
														$('#cod_cliente_contrato').val(data);
														$('#rut_cliente_tr_contrato').fadeOut();
														$('#tienda_tr_contrato').fadeOut();
														$('#cod_cliente_tr_contrato').fadeIn();
														$('#tienda_cliente_contrato').html('<option value="0">0</option>');
														$('#tienda_cliente_contrato').selectmenu("refresh");
														$('#nombre_cliente_contrato').focus();
													});
													
												}
												else if(id == 3)
												{
													
													$.post('./include/carga_tiendas.php', function(data)
													{	
														$('#tienda_cliente_contrato').html(data);
														$('#tienda_cliente_contrato').selectmenu("refresh");
														$('#rut_cliente_tr_contrato').fadeOut();
														$('#cod_cliente_tr_contrato').fadeOut();
														$('#tienda_tr_contrato').fadeIn();
													});
													
												}
												else
												{
													$('#rut_cliente_tr_contrato').fadeIn();
													$('#cod_cliente_tr_contrato').fadeOut();
													$('#cod_cliente_contrato').val(0);
													$('#rut_cliente_contrato').focus();
													
												}
												
												$('#tipo_cliente_contrato').selectmenu("refresh");
											}
			});
			
			$('#familia_contrato').selectmenu({
			  								change: function( event, ui ) 
											{
												var id = $(this).val();
												
												if(id == 1)
												{
													// Apple	
													$('#serie_sku').html("Num. Serie");
													
													$('#marca_tr').fadeOut();
													$('#modelo_tr').fadeIn();
													$('#garantia_tr').fadeIn();
													$('#busca_iphone_tr').fadeIn();
													$('#fecha_diagnostico_tr').fadeIn();
													
													$('#num_serie').focus();
												}
												else if(id == 2)
												{
													// Terceros
													$('#serie_sku').html("SKU");
													
													$('#marca_tr').fadeIn();
													$('#modelo_tr').fadeOut();
													$('#garantia_tr').fadeOut();
													$('#busca_iphone_tr').fadeOut();
													
													$('#fecha_diagnostico_tr').fadeOut();
													
													$('#num_serie').focus();
												}
												else
												{
													$('#serie_sku').html("Num. Serie");
													
													$('#marca_tr').fadeOut();
													$('#modelo_tr').fadeIn();
													$('#garantia_tr').fadeIn();
													$('#busca_iphone_tr').fadeIn();
													$('#fecha_diagnostico_tr').fadeIn();
													
													$('#num_serie').focus();
												}
											}
			});
			
			
			
			// Custom example logic
			uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button : 'pickfiles', // you can pass an id...
				container: 'container', // ... or DOM Element itself
				url : './include/upload.php',
				flash_swf_url : 'plupload/js/Moxie.swf',
				silverlight_xap_url : 'plupload/js/Moxie.xap',
				
				filters : {
					max_file_size : '5mb',
					mime_types: [
						{title : "Image files", extensions : "jpg,png"}
					]
				},
				init: {
					PostInit: function() {
						$('#filelist').html('<div class="titulo_img">Im&aacute;genes Cargadas <span>(0)</span></div>');
						$('#uploadfiles').on("click", function() {
							uploader.start();
							return false;
						});
						
					},
					FilesAdded: function(up, files) {
						
						plupload.each(files, function(file) {
							$('#filelist span').html("(" + up.files.length + ")");
							$('#filelist').append('<div id="' + file.id + '" class="detalle_img">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><div class="delete_img" id=""><a id="' + file.id + '" class="delete"><img src="./images/delete.png"></div></div>');
						});
					},
					UploadProgress: function(up, file) {
						$('#' + file.id + ' b').html('<span>' + file.percent + "%</span>");
					},
					Error: function(up, err) {
						alert("\nError #" + err.code + ": " + err.message);
					}
				}
			});
			uploader.init();
			
			$('#fieldset_cliente input:not(input[name="cliente_contrato"])').change(function()
			{
				//alert("cambio: " + $(this).attr("id"));
				$('#id_cliente').val(0);
			});
			
			
	  },
      close: function() {
        limpiaForm('nuevo_contrato_frm', '-');
      }
    });
	
	
	function eliminaImagen(id, parent)
	{

		uploader.bind('FilesAdded', function (up, files) {
							//uploader.removeFiles(id);						
								//uploader.splice(id,1);	
							});
		uploader.splice(id,1);
		uploader.refresh();
		$('#filelist' + parent + ' #' + id).fadeOut();
		$('#filelist' + parent + ' span').html("(" + uploader.files.length + ")");
	}
	
	// Indicamos que para todos los formularios dentro del 'dialog' los botones tipo 'submit' no envíen el formulario. Esto con el fin de poder interceptar el submit y darle paso al validador	
	form = dialog_crear_contrato.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
	
	
	
	$("#cliente_contrato").autocomplete(
	{
		source: "./include/busca_cliente.php",
		minLength: 2,
		select: function(event,ui)
				{
					
					$.post('./include/detalle_cliente.php', {id_cliente : ui.item.id}, function(data)
					{
		
						if(data.resultado == "OK")
						{
							//limpiaForm('nuevo_contrato_frm', 'cliente_contrato');
							
							limpiaError('nuevo_contrato_frm');
							
							
							$('#id_cliente').val(data.id_cliente);
												
							$('#tipo_cliente_contrato').html(data.tipo_cliente);
							$('#tipo_cliente_contrato').selectmenu("refresh");
							
							var digito = $.Rut.getDigito(data.rut);
							var rut_format = $.Rut.formatear(data.rut, digito);
												
							
							
							$('#rut_cliente_contrato').Rut({format_on: 'blur' });	
							
							
							var tipo_cliente_contrato = $('#tipo_cliente_contrato').val();
							
							
							if(tipo_cliente_contrato == 1)
							{
								$('#rut_cliente_contrato').val(rut_format);
								$('#rut_cliente_tr_contrato').fadeIn();
								$('#cod_cliente_tr_contrato').fadeOut();
								$('#cod_cliente_contrato').val(0);
								$('#rut_cliente_contrato').focus();	
							}
							else if(tipo_cliente_contrato == 2)
							{
								$('#cod_cliente_contrato').val(data.cod_cliente);
								$('#rut_cliente_tr_contrato').fadeOut();
								$('#cod_cliente_tr_contrato').fadeIn();
								$('#rut_cliente_contrato').val(0);
								$('#nombre_cliente_contrato').focus();	
							}
							else
							{
								$('#rut_cliente_contrato').val(rut_format);
								$('#rut_cliente_tr_contrato').fadeIn();
								$('#cod_cliente_tr_contrato').fadeOut();
								$('#cod_cliente_contrato').val(0);
								$('#rut_cliente_contrato').focus();		
							}
							
							
							$('#tipo_cliente_contrato').selectmenu({
													change: function( event, ui )
													{
														var id = $(this).val();
														
														if(id == 1)
														{
															$('#rut_cliente_tr_contrato').fadeIn();
															$('#cod_cliente_tr_contrato').fadeOut();
															$('#cod_cliente_contrato').val(0);
															$('#rut_cliente_contrato').focus();
																
														}
														else if(id == 2)
														{
															
															$.prompt('&iquest;Est&aacute; seguro que desea modificar el tipo de cliente?<br>Esta acci&oacute;n implica borrar el Rut registrado.', { 
																	buttons : { 'OK' : true, 'Cancelar' : false }, 
																	submit: function(e,v,m,f) 
																	{ 
																		if(v)
																		{
																			$.post('./include/consulta_cod_cliente.php', function(data)
																			{
																				$('#rut_cliente_contrato').val('');
																				$('#cod_cliente_contrato').val(data);
																				$('#rut_cliente_tr_contrato').fadeOut();
																				$('#cod_cliente_tr_contrato').fadeIn();
																				$('#nombre_cliente_contrato').focus();
																			});				
																		}
																		else
																		{
																			$('#tipo_cliente_contrato').html(data.tipo_cliente);
																			$('#tipo_cliente_contrato').selectmenu("refresh");
																			$.prompt.close();
																		}
																	} 
																});
															
														}
														else
														{
															$('#rut_cliente_tr_contrato').fadeIn();
															$('#cod_cliente_tr_contrato').fadeOut();
															$('#cod_cliente_contrato').val(0);
															$('#rut_cliente_contrato').focus();
															
														}
														
														$('#tipo_cliente_contrato').selectmenu("refresh");
													}
							});
							
							
							
							$('#nombre_cliente_contrato').val(data.nombre);
							$('#direccion_cliente_contrato').val(data.direccion);
							
							$('#region_cliente_contrato').html(data.region);
							$('#region_cliente_contrato').selectmenu("refresh");
							
							$('#comuna_cliente_contrato').html(data.comuna);
							$('#comuna_cliente_contrato').selectmenu("refresh");
							
							$('#region_cliente_contrato').selectmenu({
													change: function( event, ui ) 
													{
														$.post("./include/carga_comunas.php", {id_region : $(this).val()}, function(data)
														{
															$('#comuna_cliente_contrato').html(data);
															$('#comuna_cliente_contrato').selectmenu("refresh");
														});
																  
													}
												});
							
							$('#correo_cliente_contrato').val(data.correo);
							$('#contacto_cliente_contrato').val(data.contacto);
							
							$('#telefono_cliente_contrato').val(data.telefono);
							$('#celular_cliente_contrato').val(data.celular);
							
							$('#estado_cliente_contrato').html(data.estado);
							$('#estado_cliente_contrato').selectmenu("refresh");
							
							
						}
						else
							$.prompt("Ha ocurrido un error al intentar recuperar la informaci&oacute;n del cliente.<br>Favor intentar nuevamente, y si el problema persiste informar al administrador del sistema.<br><br>Error: " + data.error, { submit: function(e,v,m,f) { limpiaForm('nuevo_contrato_frm', 'cliente_contrato'); } });
					}, 'json');
				  
					$('#rut_cliente_contrato').focus();
					
					
				}
	});
	
	$('#limpiar_cliente').on('click', function()
	{
		limpiaForm('nuevo_cliente_frm', 'rut_cliente');
	});
	
	$('#limpiar_cliente_edit').on('click', function()
	{
		limpiaForm('editar_cliente_frm', 'rut_cliente_edit');
	});
	
	$('#limpiar_cliente_contrato').on('click', function()
	{
		limpiaForm('nuevo_contrato_frm', 'cliente_contrato');
	});
	
	
	
	//////////////////////////////////////////////////////////////////
	// DIAGNOSTICO CONTRATO											//
	//////////////////////////////////////////////////////////////////
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el link "Diagnóstico Contrato"
	
	$(".diagnostico_contrato").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_diagnostico_contrato.data('id_contrato', id).dialog( "open" );
	});
	
	$(".enviar_presupuesto").on("click", function()
	{
		
		var id = $(this).attr('id');
		$.prompt.close();
		
		$.prompt('Desea enviar el diagn&oacute;stico y presupuesto al cliente?', { 
				
					buttons : { 'SI' : true, 'NO' : false },  
					submit: function(e,v,m,f) 
					{ 
						if(v)
						{
							loading();
							
							$.post('./include/enviar_ppto.php', { id_contrato: id }, function(data)
							{
								loadingOff();
								if(data == "OK")
								{
									$.prompt('El diagnostico y presupuesto se ha enviado al cliente', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
								}
								else
								{
									$.prompt('Ha ocurrido un error al intentar enviar el diagnostico y presupuesto', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
								}
							});	
						}
						else
							 actualiza(v, './gestion_contratos.php'); 
					} 
				});	
				
		
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-diagnostico'
	
	var uploader;
	
	
	dialog_diagnostico_contrato = $( "#dialog-contrato-diagnostico" ).dialog({
      autoOpen: false,
      height: 700,
      width: 1000,
	  minWidth: 1000,
	  minHeight: 700,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Guardar': function() { $('#tipo_guardar').val(1); $('#crear_diagnostico_btn').click(); },
		  
		  		'Guardar y Enviar': function() { $('#tipo_guardar').val(2); $('#crear_diagnostico_btn').click(); },
				
                'Cancelar': function() { $('#tabla_repuestos tr:not(.tabla_no)').remove(); limpiaForm('diagnostico_contrato_frm', '-'); $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  	$('#estado_ppto').val($('#estado_ppto_sel').val());
			
			$('#estado_ppto_sel').attr("disabled", "disabled");
			$('#estado_ppto_sel').selectmenu("refresh");
			
			
			$.post('./include/detalle_contrato.php', {id_contrato : $(this).data('id_contrato')}, function(data)
			{
				
				if(data.resultado == "OK")
				{
					$('#id_contrato').val(data.id_contrato);
					$('#serie_contrato').val(data.num_serie);
					$('#modelo_contrato').val(data.modelo);
					$('#descripcion_contrato').val(data.descripcion);
					$('#falla_cliente_contrato').val(data.falla_cliente);
					$('#nombre_cliente').val(data.nombre);
					$('#telefono_cliente').val(data.telefono);
					$('#correo_cliente').val(data.correo);
					$('#direccion_cliente').val(data.direccion);	
					
					
					
					if(data.id_diagnostico != "")
					{
						$('#diagnostico_contrato_frm #accion').val("guardar_diagnostico");
						$('#diagnostico_contrato_frm #id_diagnostico').val(data.id_diagnostico);
						
						if(data.id_estado_cont == 4)
							$('#diagnostico_contrato_frm #id_presupuesto').val(-1);
						else
							$('#diagnostico_contrato_frm #id_presupuesto').val(data.id_presupuesto);
							
							
						$('#diagnostico_contrato_frm #id_cliente').val(data.id_cliente);
						
						if(data.garantia == 1)
							$('#aplica_garantia').val("si_g");
						else
							$('#aplica_garantia').val("no_g");
						
						$('#aplica_garantia').selectmenu('refresh');
						
						var parse_date_ii = $.datepicker.parseDateTime("yy-mm-dd", "h:mm", data.fecha_inicio_d, null, {timeFormat:"h:mm"})
						var parse_date_t = $.datepicker.parseDate("yy-mm-dd", data.fecha_termino_d);
						
						$('#fecha_inicio_d, #fecha_termino_d, #fecha_ppto').datepicker("option", "minDate", "-2y");
						
						$('#fecha_inicio_d').datepicker("setDate", parse_date_ii);
						$('#fecha_termino_d').datepicker("setDate", parse_date_t);
						
						
						
						$('#respuesta_tipo').val(data.id_respuesta);
						$('#respuesta_tipo').selectmenu("refresh");
						
						if((data.otra_respuesta != "") && (data.id_respuesta == 2))
						{
							$('#observacion_otra_respuesta').val(data.otra_respuesta);
							$('#otra_respuesta_tr').fadeIn();
						}
						
						
						$('#diagnostico_cliente').val(data.diagnostico_c);
						$('#diagnostico_interno').val(data.diagnostico_i);
						$('#num_gsx').val(data.num_gsx);
						
						// Buscar si el contrato tiene imágenes en etapa diagnóstico
						
						$.post('./include/busca_imagenes.php', { id_contrato: data.id_contrato, etapa: 'diagnostico' }, function(data)
						{
							if(data != "NO")
							{
								// Se encontraron imagenes
								$('#listado_imagenes').html(data);
								$('#listado_imagenes').fadeIn();	
							}
							else
							{
								$('#listado_imagenes').html('');
								$('#listado_imagenes').fadeOut();
							}
						});
						

						/*if(data.id_estado_cont == 4)
						{
							
							$('#aplica_garantia').selectmenu( "disable" );
							$('#fecha_inicio_d').datepicker( "option", "disabled" );
							$('#fecha_inicio_d').attr('readonly', 'readonly');
							$('#fecha_termino_d').datepicker( "option", "disabled" );
							$('#fecha_termino_d').attr('readonly', 'readonly');
							$('#respuesta_tipo').selectmenu( "disable" );
							$('#observacion_otra_respuesta').attr('readonly', 'readonly');
							$('#num_gsx').attr('readonly', 'readonly');
							$('#diagnostico_interno').attr('readonly', 'readonly');
							$('#container_diag').css('display', 'none');
							$('#filelist_diag').css('display', 'none');
						}
						else
						{
							$('#aplica_garantia').selectmenu( "enable" );
							$('#fecha_inicio_d').datepicker( "option", "enable" );
							$('#fecha_inicio_d').removeAttr('readonly');
							$('#fecha_termino_d').datepicker( "option", "enable" );
							$('#fecha_termino_d').removeAttr('readonly');
							$('#respuesta_tipo').selectmenu( "enable" );
							$('#observacion_otra_respuesta').removeAttr('readonly');
							$('#num_gsx').removeAttr('readonly');
							$('#diagnostico_interno').removeAttr('readonly');
							$('#container_diag').css('display', 'block');
							$('#filelist_diag').css('display', 'block');
						}*/
						
						// PPTO
						
						if(data.id_estado_cont != 4)
						{
						
							var parse_date_p = $.datepicker.parseDateTime("yy-mm-dd", "h:mm", data.fecha_ppto, null, {timeFormat:"h:mm"})
							$('#fecha_ppto').datepicker("setDate", parse_date_p);
							
							$('#estado_ppto_sel').val(data.estado_ppto);
							$('#estado_ppto_sel').selectmenu("refresh");
							
							$('#observaciones_ppto').val(data.observaciones);
							
							// Agregar repuestos
							
							var i = 1;
							
							var cuantos_r = data.repuestos.length;
							
							if(cuantos_r > 0)
							{	
								
								$.each(data.repuestos, function(posicion, repuesto){
									agregaRepuesto(i);
									
									$('#id_' + i).val(repuesto.id);
									$('#id_repuesto_' + i).val(repuesto.id_repuesto);
									
									$('#tipo_repuesto_' + i).val(repuesto.tipo_repuesto);
									$('#cod_repuesto_' + i).val(repuesto.cod_repuesto);
									$('#des_repuesto_' + i).val(repuesto.des_repuesto);
									$('#cant_repuesto_' + i).val(repuesto.cant_repuesto);
									$('#unit_repuesto_limpio_' + i).val(repuesto.prec_repuesto);
									$('#unit_repuesto_' + i).val(Moneda(String(repuesto.prec_repuesto)));
									$('#total_repuesto_limpio_' + i).val(repuesto.total_repuesto);
									$('#total_repuesto_' + i).val(Moneda(String(repuesto.total_repuesto)));
																	
									i++;
								});
								
								$('#sub_total').val(Moneda(String(data.sub_total)));
								$('#iva').val(Moneda(String(data.iva)));
								$('#total_final').val(Moneda(String(data.total)));
								$('#total_pagar').val(Moneda(String(data.total_pagar)));
							}
							else
							{
								agregaRepuesto(1);
								
								$('#sub_total').val(Moneda(String(0)));
								$('#iva').val(Moneda(String(0)));
								$('#total_final').val(Moneda(String(0)));
								$('#total_pagar').val(Moneda(String(0)));
							}
						}
						else
						{
							
						
						
							agregaRepuesto(1);
						
				
							
							// PPTO
				
							var currentDate = new Date();  
							
							$("#fecha_ppto").datepicker("setDate", currentDate);
						}
						
							
						
						
					}
					else
					{
						$('#diagnostico_contrato_frm #accion').val("guardar_diagnostico");
						$('#diagnostico_contrato_frm #id_diagnostico').val(0);
						$('#diagnostico_contrato_frm #id_presupuesto').val(0);
						$('#diagnostico_contrato_frm #id_cliente').val(data.id_cliente);
						
						$('#listado_imagenes').fadeOut();
						
						var currentDate = new Date();  
			
						$("#fecha_inicio_d").datepicker("setDate", currentDate);
						
						// Buscar "Tipo" en 
						
						$.post('./include/calcula_fecha.php', {dias: 5}, function(data)
						{
			
							var parse_date = $.datepicker.parseDate("yy-mm-dd", data);
							
							$('#fecha_termino_d').datepicker("setDate", parse_date);
							$('#fecha_termino_d').datepicker("option", "minDate", parse_date);
							$('#fecha_termino_d').datepicker("option", "maxDate", parse_date);
							
						});
						
						agregaRepuesto(1);
						
			
						
						// PPTO
			
						var currentDate = new Date();  
						
						$("#fecha_ppto").datepicker("setDate", currentDate);
						
						
						
					}
				}
				else
					$.prompt('Ha ocurrido un error al intentar recuperar la informaci&oacute;n del contrato.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
			}, 'json');	  
		  
		  				
						
		  	$('#respuesta_tipo').selectmenu({
														change: function( event, ui )
														{
															var id = $(this).val();
															
															if(id == 2)
																$('#otra_respuesta_tr').fadeIn();
															else
																$('#otra_respuesta_tr').fadeOut();
														}
						});	
												
			$('#aplica_garantia').selectmenu({
														change: function( event, ui )
														{
							
															var id = $(this).val();
															
															if(id == 'si_g')
															{
																$('#check_g').val(1);
																$('#num_gsx').attr('required', '');
															}
															else
															{
																$('#check_g').val(0); 
																$('#num_gsx').removeAttr('required');
															}
															
															calculaTotales();
														}
								
						});
															
			
			
			// Custom example logic
			uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button : 'pickfiles_diag', // you can pass an id...
				container: 'container_diag', // ... or DOM Element itself
				url : './include/upload.php',
				flash_swf_url : 'plupload/js/Moxie.swf',
				silverlight_xap_url : 'plupload/js/Moxie.xap',
				
				filters : {
					max_file_size : '5mb',
					mime_types: [
						{title : "Image files", extensions : "jpg,png"}
					]
				},
				init: {
					PostInit: function() {
						$('#filelist_diag').html('<div class="titulo_img">Im&aacute;genes Cargadas <span>(0)</span></div>');
						
						
					},
					FilesAdded: function(up, files) {
						
						plupload.each(files, function(file) {
							$('#filelist_diag span').html("(" + up.files.length + ")");
							$('#filelist_diag').append('<div id="' + file.id + '" class="detalle_img">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><div class="delete_img" id="_diag"><a id="' + file.id + '" class="delete"><img src="./images/delete.png"></div></div>');
						});
					},
					UploadProgress: function(up, file) {
						$('#' + file.id + ' b').html('<span>' + file.percent + "%</span>");
					},
					Error: function(up, err) {
						alert("\nError #" + err.code + ": " + err.message);
					}
				}
			});
			uploader.init();
			
			
			
			
	  },
      close: function() {
		  
		$('#tabla_repuestos tr:not(.tabla_no)').remove();
        limpiaForm('diagnostico_contrato_frm', '-');
      }
    });
	
	$('.chk_garantia').on('click', function()
	{
		var id = $(this).attr("id");
		
		if((id == 'si_g') && ($(this).is(':checked')))
			$('#check_g').val(1);
		else
			$('#check_g').val(0); 
		
		calculaTotales();	
	});
		
	
	//$('#lista_repuestos').on('click', '#nuevo_repuesto', function()
	$('#nuevo_repuesto').on("click", function() 
	{
		var cant 	= parseInt($('#cant_filas').val());
		var i		= cant + 1;
		
		agregaRepuesto(i);
		
	});
	
	
	//////////////////////////////////////////////////////////////////
	// VER CONTRATO										//
	//////////////////////////////////////////////////////////////////
	
	
	
	// Llamamos al método "open" de la librería Dialog cuando se presiona el link "Diagnóstico Contrato"
	
	$(".ver_contrato").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_ver_contrato.data('id_contrato', id).dialog( "open" );
	});
	
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-diagnostico'
	
	dialog_ver_contrato = $( "#dialog-contrato-ver" ).dialog({
      autoOpen: false,
      height: 700,
      width: 1000,
	  minWidth: 1000,
	  minHeight: 700,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		
                'Cerrar': function() { $('#tabla_repuestos_ver tr:not(.tabla_no)').remove(); $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  $( "#tabs" ).tabs({
						  active: 0
						});
		  // Busco el detalle del contrato
		  
		  limpiaForm('ver_contrato', '-');
		  
		  $.post('./include/detalle_contrato.php', {id_contrato : $(this).data('id_contrato')}, function(data)
		  {
			  
			  if(data.resultado == "OK")
			  {
				  $('#id_contrato').val(data.id_contrato);
				  
				  $('#tipo_cliente_ver').val(data.tipo_cliente);
				  $('#tipo_cliente_ver').selectmenu("refresh");
				  
				  
				  if(data.tipo_cliente == 1)
				  {
					  $('#rut_cliente_tr_ver').fadeIn();
					  $('#rut_cliente_ver').val(data.rut_cliente);
					  $('#cod_cliente_tr_ver').fadeOut();
					  $('#tienda_tr_ver').fadeOut();
						  
				  }
				  else if(data.tipo_cliente == 2)
				  {
					  $('#cod_cliente_ver').val(data.cod_cliente);
					  $('#rut_cliente_tr_ver').fadeOut();
					  $('#tienda_tr_ver').fadeOut();
					  $('#cod_cliente_tr_ver').fadeIn();
				  
				  }
				  else if(data.tipo_cliente == 3)
				  {
					  
					  $.post('./include/carga_tiendas.php', function(data_tienda)
					  {	
						  $('#tienda_cliente_ver').html(data_tienda);
						  $('#tienda_cliente_ver').val(data.tienda_cliente);
						  $('#tienda_cliente_ver').selectmenu("refresh");
						  
						  $('#rut_cliente_tr_ver').fadeOut();
						  $('#cod_cliente_tr_ver').fadeOut();
						  $('#tienda_tr_ver').fadeIn();
					  });
					  
				  }
				  else
				  {
					  $('#rut_cliente_tr_ver').fadeIn();
					  $('#rut_cliente_ver').val(data.rut_cliente);
					  $('#cod_cliente_tr_ver').fadeOut();
					  
				  }
					  
				  
				  $('#serie_contrato_ver').val(data.num_serie);
				  $('#modelo_contrato_ver').val(data.modelo);
				  $('#descripcion_contrato_ver').val(data.descripcion);
				  $('#falla_cliente_contrato_ver').val(data.falla_cliente);
				  $('#nombre_cliente_ver').val(data.nombre);
				  $('#telefono_cliente_ver').val(data.telefono);
				  $('#correo_cliente_ver').val(data.correo);
				  $('#contacto_cliente_ver').val(data.contacto_cliente);
				  $('#direccion_cliente_ver').val(data.direccion);	
				  $('#celular_cliente_ver').val(data.celular_cliente);
				  
				  $('#region_cliente_ver').val(data.region_cliente);
				  $('#region_cliente_ver').selectmenu("refresh");
				  
				  $.post("./include/carga_comunas.php", {id_region : data.region_cliente}, function(data_comuna)
												{
													$('#comuna_cliente_ver').html(data_comuna);
													$('#comuna_cliente_ver').selectmenu("refresh");
													
													$('#comuna_cliente_ver').val(data.comuna_cliente);
				  									$('#comuna_cliente_ver').selectmenu("refresh");
												});
				  
				 
				 // Datos del contrato
				 
				 $('#tipo_ingreso_ver').val(data.tipo_contrato);
				 $('#tipo_ingreso_ver').selectmenu("refresh");
				 
				 $('#fecha_recepcion_ver').val(data.fecha_recepcion);
				 
				 $('#familia_contrato_ver').val(data.familia_contrato);
				 $('#familia_contrato_ver').selectmenu("refresh");
				 
				 $('#num_serie_ver').val(data.num_serie);
				 $('#modelo_ver').val(data.modelo);
				 $('#descripcion_ver').val(data.descripcion);
				 $('#marca_ver').val(data.marca);
				 
				 
				 $('#estado_contrato_ver').val(data.estado_contrato);
				 
				 
				 
				if(data.garantia == 1)
					$('#garantia_ver').val("SI");
				else
					$('#garantia_ver').val("NO");
				
				if(data.buscar_iphone == 1)
					$('#buscar_iphone_ver').val("SI");
				else
					$('#buscar_iphone_ver').val("NO");
				  
				
				if(data.rayas == 1)
					$('#rayas_ver').prop("checked", true)
				else
					$('#rayas_ver').prop("checked", false)
				
				if(data.golpes == 1)
					$('#golpes_ver').prop("checked", true)
				else
					$('#golpes_ver').prop("checked", false)
					
				if(data.abolladuras == 1)
					$('#abolladuras_ver').prop("checked", true)
				else
					$('#abolladuras_ver').prop("checked", false)
					
				if(data.marcas == 1)
					$('#marcas_ver').prop("checked", true)
				else
					$('#marcas_ver').prop("checked", false)
					
				if(data.liquido == 1)
					$('#liquido_ver').prop("checked", true)
				else
					$('#liquido_ver').prop("checked", false)
					
				if(data.intervenido == 1)
					$('#intervenido_ver').prop("checked", true)
				else
					$('#intervenido_ver').prop("checked", false)
				
				$('#falla_cliente_ver').val(data.falla_cliente);
				$('#tecnico_asignado_ver').val(data.tecnico_asignado);
				
				if(data.id_usuario == 4)
				{
					$('#tr_cod_vendedor_ver').fadeIn();
					$('#cod_vendedor_ver').val(data.cod_vendedor);
				}
				else
					$('#tr_cod_vendedor_ver').fadeOut();
				
				
				if(data.num_boleta != "" || data.num_boleta != 0)
					$('#num_boleta_ver').val(data.num_boleta);
				else
					$('#num_boleta_ver').val("");
					

				if(data.fecha_boleta == '00-00-0000' || data.fecha_boleta == '0000-00-00')	
					$('#fecha_boleta_ver').val('');
				else
					$('#fecha_boleta_ver').val(data.fecha_boleta);
					
				$('#fecha_diagnostico_ver').val(data.fecha_tent_diag);
				$('#fecha_entrega_ver').val(data.fecha_tent_entre);
				
				
				// Buscar si el contrato tiene imágenes en etapa recepción
					
					$.post('./include/busca_imagenes.php', { id_contrato: data.id_contrato, etapa: 'recepcion' }, function(data_img)
					{
						if(data_img != "NO")
						{
							// Se encontraron imagenes
							$('#listado_imagenes_recep_ver').html(data_img);
							$('#listado_imagenes_recep_ver').fadeIn();	
						}
						else
						{
							$('#listado_imagenes_recep_ver').html('');
							$('#listado_imagenes_recep_ver').fadeOut();
						}
					});
				
				
				
				// Diagnostico

				if(data.id_diagnostico != "")
				{
					$('#tabs').tabs('enable', 2);
					$('#tabs').tabs('enable', 3);
					
					
					if(data.id_estado_cont == 7)
					{
						$('#tabs').tabs('enable', 4);
						//$('#observaciones_finales_ver').val(data.observacion_final);
						//$('#fecha_obs_final').val(data.fecha_obs_final);

						$('#respuesta_tipo_final_ver').val(data.id_respuesta_fin);
						$('#respuesta_tipo_final_ver').selectmenu("refresh");
						
						
						if((data.otra_respuesta_fin != "") && (data.id_respuesta_fin == 2))
						{
							$('#observacion_otra_respuesta_fin_ver').val(data.otra_respuesta_fin);
							$('#otra_respuesta_final_ver_tr').fadeIn();
						}
						
						//$('#fecha_obs_final').val(data.fecha_obs_final);
						$('#fecha_res_final').val(data.fecha_res_final);
						
						
					}
					else
						$('#tabs').tabs('disable', 4);
					
					$('#aplica_garantia_ver').val(data.garantia);
					$('#aplica_garantia_ver').selectmenu("refresh");
					
					$('#fecha_inicio_d_ver').val(data.fecha_inicio_d2);
					$('#fecha_termino_d_ver').val(data.fecha_termino_d2);
					
					$('#respuesta_tipo_ver').val(data.id_respuesta);
					$('#respuesta_tipo_ver').selectmenu("refresh");
					
					if((data.otra_respuesta != "") && (data.id_respuesta == 2))
					{
						$('#observacion_otra_respuesta_ver').val(data.otra_respuesta);
						$('#otra_respuesta_tr_ver').fadeIn();
					}
					
					
					$('#diagnostico_cliente_ver').val(data.diagnostico_c);
					$('#diagnostico_interno_ver').val(data.diagnostico_i);
					$('#num_gsx_ver').val(data.num_gsx);
					
					// Buscar si el contrato tiene imágenes en etapa diagnóstico
					
					$.post('./include/busca_imagenes.php', { id_contrato: data.id_contrato, etapa: 'diagnostico' }, function(data_img)
					{
						if(data_img != "NO")
						{
							// Se encontraron imagenes
							$('#listado_imagenes_ver').html(data_img);
							$('#listado_imagenes_ver').fadeIn();	
						}
						else
						{
							$('#listado_imagenes_ver').html('');
							$('#listado_imagenes_ver').fadeOut();
						}
					});
					
	
					$('#fecha_ppto_ver').val(data.fecha_ppto);
					
					$('#estado_ppto_sel_ver').val(data.estado_ppto);
					$('#estado_ppto_sel_ver').selectmenu("refresh");
					
					
					if(data.id_respuesta_rechazo != 0)
					{
						$('#tr_respuesta_rechazo_ver').fadeIn();
						
						$('#respuesta_rechazo_ver').val(data.respuesta_rechazo);
					}
					else
					{
						$('#tr_respuesta_rechazo_ver').fadeOut();
						
						$('#respuesta_rechazo_ver').val('');
					}
					
					$('#observaciones_ppto_ver').val(data.observaciones);
					
					// Agregar repuestos
					
					var i = 1;
					
					var cuantos_r = data.repuestos.length;
	
					if(cuantos_r > 0)
					{	
						
						$.each(data.repuestos, function(posicion, repuesto){
							agregaRepuestoVer(i);
							
							$('#tipo_repuesto_' + i).val(repuesto.tipo_repuesto);
							$('#cod_repuesto_' + i).val(repuesto.cod_repuesto);
							$('#des_repuesto_' + i).val(repuesto.des_repuesto);
							$('#cant_repuesto_' + i).val(repuesto.cant_repuesto);
							$('#unit_repuesto_' + i).val(Moneda(String(repuesto.prec_repuesto)));
							$('#total_repuesto_' + i).val(Moneda(String(repuesto.total_repuesto)));
															
							i++;
						});
						
						$('#sub_total_ver').val(Moneda(String(data.sub_total)));
						$('#iva_ver').val(Moneda(String(data.iva)));
						$('#total_final_ver').val(Moneda(String(data.total)));
						$('#total_pagar_ver').val(Moneda(String(data.total_pagar)));
					}
					else
					{
						$('#sub_total_ver').val(Moneda(String(0)));
						$('#iva_ver').val(Moneda(String(0)));
						$('#total_final_ver').val(Moneda(String(0)));
						$('#total_pagar_ver').val(Moneda(String(0)));
					}
					
					
					
					
					
					if(($('#tipo_repuesto_' + i).val() == 1) && (data.garantia == 1))
						$('#total_pagar_ver').val(Moneda(String(data.total_pagar)));
					else if(($('#tipo_repuesto_' + i).val() == 0) && (data.garantia == 1))
						$('#total_pagar_ver').val(Moneda(String(0)));
					else 
						$('#total_pagar_ver').val(Moneda(String(data.total_pagar)));
						
						
					/*if(data.garantia == 1)
						$('#total_pagar_ver').val(Moneda(String(0)));
					else
						$('#total_pagar_ver').val(Moneda(String(data.total_pagar)));*/
				}
				else
				{
					$('#tabs').tabs("disable",2);
					$('#tabs').tabs("disable",3);
					$('#tabs').tabs("disable",4);
				}
					
				
				
			  }
		  },'json');
		  
	  },
      close: function() {
		  $('#tabla_repuestos_ver tr:not(.tabla_no)').remove();
		
      }
    });
	
	
	
	
	//////////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////////
	// PAGAR PPTO													//
	//////////////////////////////////////////////////////////////////
	
	$(".pagar_contrato").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_pagar_contrato.data('id_contrato', id).dialog( "open" );
	});
	
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-diagnostico'
	
	dialog_pagar_contrato = $( "#dialog-contrato-pagar" ).dialog({
      autoOpen: false,
      height: 400,
      width: 600,
	  minWidth: 600,
	  minHeight: 400,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Pagar' : function() { $('#pagar_contrato_btn').click(); },
                'Cerrar': function() { $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		$.post('./include/detalle_contrato.php', { id_contrato:  $(this).data('id_contrato')}, function(data)
		{
			var id_presupuesto 	= data.id_presupuesto;
			var total_pagar		= data.total_pagar;
			
			$('#id_contrato_pagar').val(data.id_contrato);
			$('#total_contrato').val('$ ' + Moneda(String(total_pagar)));
			$('#total_contrato_limpio').val(total_pagar);
			
			if((data.boleta_ppto != "") && (data.boleta_ppto != 0))
			{
				$('#boleta_contrato').val(data.boleta_ppto);
				//$('#boleta_contrato').attr('readonly', 'reanonly');		
			}
			else
			{
				//$('#boleta_contrato').removeAttr('readnonly');
				$('#boleta_contrato').focus();
			}
				
		}, 'json');
		  
		},
      close: function() {
		
      }
    });
	
	
	//////////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////////
	// CAMBIAR ESTADO CONTRATO										//
	//////////////////////////////////////////////////////////////////
	
	$(".estado_contrato").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_estado_contrato.data('id_contrato', id).dialog( "open" );
	});
	
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-estado'
	
	dialog_estado_contrato = $( "#dialog-contrato-estado" ).dialog({
      autoOpen: false,
      height: 500,
      width: 700,
	  minWidth: 400,
	  minHeight: 300,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Guardar' : function() { $('#cambiar_estado_contrato_btn').click(); },
                'Cerrar': function() { $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  	$('#id_contrato_estado').val($(this).data('id_contrato'));
			
			
			
			
				
		  	
		  	$.post('./include/detalle_contrato.php', { id_contrato:  $(this).data('id_contrato')}, function(data)
			{
				var estados_html = '';
				
				$.post('./include/carga_estados_contrato.php', { id_estado_actual: data.id_estado_cont },  function(data_estados)
				{
					estados_html = data_estados;	
					
				
					$('#estado_actual').html(estados_html);
					$('#estado_actual').selectmenu("refresh");
					
					$('#estado_nuevo').html(estados_html);
					$('#estado_nuevo').selectmenu("refresh");
					
					$('#estado_actual').val(data.id_estado_cont);
					$('#estado_actual').selectmenu("refresh");
				});
				
			}, 'json');

		
		},
      close: function() {
		
      }
    });
	
	
	//////////////////////////////////////////////////////////////////
	
	
	//////////////////////////////////////////////////////////////////
	// FINALIZAR CONTRATO										//
	//////////////////////////////////////////////////////////////////
	
	$(".finalizar_contrato").on("click", function()
	{
		var id = $(this).attr('id');
		dialog_finalizar_contrato.data('id_contrato', id).dialog( "open" );
	});
	
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-contrato-finalizar'
	
	dialog_finalizar_contrato = $( "#dialog-contrato-finalizar" ).dialog({
      autoOpen: false,
      height: 300,
      width: 400,
	  minWidth: 400,
	  minHeight: 300,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Guardar' : function() { $('#finalizar_contrato_btn').click(); },
                'Cerrar': function() { $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  $('#id_contrato_fin').val($(this).data('id_contrato'));
		  
		  $('#respuesta_tipo_final').selectmenu({
														change: function( event, ui )
														{
															var id = $(this).val();
															
															if(id == 2)
																$('#otra_respuesta_final_tr').fadeIn();
															else
																$('#otra_respuesta_final_tr').fadeOut();
														}
						});	
								
		  
		},
      close: function() {
		
      }
    });
	
	
	//////////////////////////////////////////////////////////////////
	
	
	// REPUESTOS
	
	$('#recibir_oc').on('click', function()
	{
		//var id = $(this).attr('id');
		dialog_oc.dialog( "open" );
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-oc'
	
	dialog_oc = $( "#dialog-oc" ).dialog({
      autoOpen: false,
      height: 200,
      width: 400,
	  minWidth: 400,
	  minHeight: 200,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Guardar' : function() { $('#finalizar_oc_btn').click(); },
                'Cerrar': function() { $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  
		  
		},
      close: function() {
		
      }
    });
	
	//////////////////////////////////////////////////////////////////
	
	
	
	// CARGAR REPUESTOS
	
	$('#cargar_repuestos').on('click', function()
	{
		//var id = $(this).attr('id');
		dialog_repuestos.dialog( "open" );
	});
	
	
	// Instanciamos el 'dialog' de jQuery UI definido en el formulario 'dialog-oc'
	
	dialog_repuestos = $( "#dialog-repuestos" ).dialog({
      autoOpen: false,
      height: 500,
      width: 600,
	  minWidth: 600,
	  minHeight: 500,
      modal: true,
	  closeOnEscape: false,
	  show: {
        effect: "fade",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      buttons: {
		  		'Cargar Repuestos' : function() { $('#finalizar_carga_btn').click(); },
                'Cerrar': function() { $(this).dialog('close');}
      },
	  open: function( event, ui )
	  {
		  
		  
		},
      close: function() {
		
      }
    });
	
	/****************************************************************************************************************************/
	
	
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //propiedades fieldset que vamos a animar
	var animating; //
	
	$(".next").on("click", function(){
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		//activar el siguiente paso en progreso usando el índice de next_fs
		$("#progreso li").eq($("fieldset").index(next_fs)).addClass("active");

		//mostrar el siguiente fieldset
		next_fs.show(); 
		//ocultar el fieldset actual con estilo
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//como la opacidad de current_fs está reducida a 0 - almacenado en "now"
				//1. escala current_fs hasta 80%
				scale = 1 - (1 - now) * 0.2;
				//2. traer next_fs desde la derecha (50%)
				left = (now * 50)+"%";
				//3. aumentar la opacidad de next_fs a 1 a medida que avanza
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
			}, 
			//Esto viene del plugin easing
			easing: 'easeInOutBack'
		});
	});
	
	
	
	$(".previous").on("click", function(){
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//des-activar paso actual en progreso
		$("#progreso li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//mostrar el fieldset anterior
		previous_fs.show(); 
		//ocultar el fieldset actual con estilo
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. escalar previous_fs de 80% a 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
			}, 
			//Esto viene del plugin easing
			easing: 'easeInOutBack'
		});
	});


	

	/****************************************************************************************************************/
	
	$('#repuestos_upload').uploadify({
									'uploader'  : './uploadify/uploadify.swf',
									'script'    : './uploadify/uploadify.php',
									'cancelImg' : './uploadify/cancel.png',
									'folder'    : './uploads',
									'fileExt'   : '*.xls',
									'fileDesc'  : 'Archivos Excel',
									'auto'      : false,
									'buttonImg' : './uploadify/button.png',
									'height'    : 27,
									'width'		: 135,
									'method'	: 'post',
									'onSelect' : function(file) {
																	//$.prompt('El archivo fue agregado a la fila de espera.');
																	$('#siguiente_carga').removeAttr('disabled');
																	$('#siguiente_carga').fadeIn();
																	
																},
									'onComplete' : 	function(event, ID, fileObj, response, data) 
													{
														$.post("./include/creaDirectorio.php", { file:  fileObj.name }, function(data) 
														{
															//$('#loading').css("display", "block");
															loading();
															var resp = data.split("|");
															
															
															if(resp[0] == "OK")
															{
																$.post("./include/subelo.php", { file: fileObj.name, path: fileObj.filePath, fecha: resp[1] }, function(data) 
																{
																	if(data == 99)
																	{
																		//$('#loading').css("display", "none");
																		loadingOff();
																   		//$.prompt('El archivo "' + fileObj.name + '" no cumple con el formato requerido.', { submit: function(e,v,m,f) { actualiza(v, './cargar_inventario.php'); } });	
																		$('#titulo_final').html('El archivo "' + fileObj.name + '" no cumple con el formato requerido.');		
																		$('#img_ok').fadeOut();
																		$('#img_error').fadeIn();
																		
																		$('#anterior').fadeIn();
																		
																	}
																	else if(data == "ERROR")
																	{
																		//$('#loading').css("display", "none");
																		loadingOff();
																   		//$.prompt('Ha ocurrido un error al intentar cargar el archivo "' + fileObj.name + '". Int&eacute;ntelo nuevamente o cont&aacute;ctese con el administrador del sistema, para solicitar orientaci&oacute;n.', { submit: function(e,v,m,f) { actualiza(v, './cargar_inventario.php'); } });	
																		
																		$('#titulo_final').html('Ha ocurrido un error al intentar cargar el archivo "' + fileObj.name + '". Int&eacute;ntelo nuevamente o cont&aacute;ctese con el administrador del sistema, para solicitar orientaci&oacute;n.');
																		$('#img_ok').fadeOut();		
																		$('#img_error').fadeIn();
																		$('#anterior').fadeIn();
																		
																	}
																	else if(data == "OK")
																	{
																   		//$('#loading').css("display", "none");
																		loadingOff();
																   		//$.prompt('La informaci&oacute;n del archivo "' + fileObj.name + '" fue cargada exitosamente en la Base de Datos.');
																		$('#titulo_final').html('La informaci&oacute;n del archivo "' + fileObj.name + '" fue cargada exitosamente en la Base de Datos');																		
																		$('#img_error').fadeOut();
																		$('#img_ok').fadeIn();
																		$('#anterior').fadeOut();
																		$('#finalizar_carga').fadeIn();
																		
																	}
																	else
																	{
																		//$('#loading').css("display", "none");
																		loadingOff();
																   		//$.prompt('Ha ocurrido un error al intentar cargar el archivo "' + fileObj.name + '". Int&eacute;ntelo nuevamente o cont&aacute;ctese con el administrador del sistema, para solicitar orientaci&oacute;n.', { submit: function(e,v,m,f) { actualiza(v, './cargar_inventario.php'); } });	
																		
																		$('#titulo_final').html('Ha ocurrido un error al intentar cargar el archivo "' + fileObj.name + '". Int&eacute;ntelo nuevamente o cont&aacute;ctese con el administrador del sistema, para solicitar orientaci&oacute;n.');
																		$('#img_ok').fadeOut();		
																		$('#img_error').fadeIn();
																		$('#anterior').fadeIn();
																		
																	}
																 });	
																 
															}
														});
													}
                  				});
	
	
	$("#siguiente_carga").on("click", function()
	{
		$('#repuestos_upload').uploadifyUpload();
	});
	
	$("#finalizar_carga").on("click", function()
	{
		actualiza(true, './');
	});
	
	
	
	
	//////////////////////////////////////////////////////////////////
	
	
	
	
	//////////////////////////////////////////////////////////////////
	// VALIDAR FORMULARIOS											//
	//////////////////////////////////////////////////////////////////
	
	$.validator.setDefaults({
		
		showErrors: function(map, list) {
			
			// there's probably a way to simplify this
			var focussed = document.activeElement;

			if (focussed && $(focussed).is("input, textarea")) {

				$(this.currentForm).tooltip("close");
			}
			this.currentElements.removeAttr("title").removeClass("ui-state-error");
			$.each(list, function(index, error) {
				$(error.element).attr("title", error.message).addClass("ui-state-error");
			});
			if (focussed && $(focussed).is("input, textarea")) {
				$(this.currentForm).tooltip("open");
			}
		}
	});
	
	
	$.validator.addMethod("rut", function(value, element) {
	  return this.optional(element) || $.Rut.validar(value);
	}, "Este campo debe ser un rut valido.");
	
	
	// Tooltip; deshabilitar animaciones por ahora y habilitar el "track" de los tooltip a través del input correspondiente
	$("#nuevo_usuario_frm, #editar_usuario_frm, #pass_usuario_frm, #nuevo_cliente_frm, #editar_cliente_frm, #nuevo_contrato_frm, #diagnostico_contrato_frm, #pagar_contrato_frm, #estado_contrato_frm, #finalizar_contrato_frm, #finalizar_oc_frm").tooltip({
		show: false,
		hide: false,
		track: true
	});

	

	// Reglas de validación para el formulario "Crear Usuario"
	$("#nuevo_usuario_frm").validate({
		//onsubmit: false,
		rules: {
			nombre_usuario: "required",
			telefono_usuario: { required: true, digits: true }, 
			login_usuario: "required",
			
			correo_usuario: {
				required: true,
				email: true
			},
			pass_usuario : {
                minlength : 5
            },
            confirm_pass_usuario : {
              	minlength : 5,
                equalTo : "#pass_usuario"
           	}

		},
		messages: {
			nombre_usuario: "Ingrese un nombre",
			telefono_usuario: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			login_usuario: "Ingrese login",
			correo_usuario: "Ingrese un correo v\u00e1lido",
			pass_usuario: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			confirm_pass_usuario: "Las contrase\u00f1as no coinciden"
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			$.post('./include/guarda_usuario.php', $('#nuevo_usuario_frm').serialize(), function(data)
			{
				if(data == "OK")
					$.prompt('El usuario ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });
				else
					$.prompt('Ha ocurrido un error al crear el usuario.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });	
			});
		}
	});
	
	
	// Reglas de validación para el formulario "Editar Usuario"
	$("#editar_usuario_frm").validate({
		//onsubmit: false,
		rules: {
			nombre_usuario_edit: "required",
			telefono_usuario_edit: { required: true, digits: true }, 
			login_usuario_edit: "required",
			
			correo_usuario_edit: {
				required: true,
				email: true
			},
			pass_usuario_edit : {
                minlength : 5
            },
            confirm_pass_usuario_edit : {
              	minlength : 5,
                equalTo : "#pass_usuario_edit"
           	}

		},
		messages: {
			nombre_usuario_edit: "Ingrese un nombre",
			telefono_usuario_edit: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			login_usuario_edit: "Ingrese login",
			correo_usuario_edit: "Ingrese un correo v\u00e1lido",
			pass_usuario_edit: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			confirm_pass_usuario_edit: "Las contrase\u00f1as no coinciden"
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			$.post('./include/guarda_usuario.php', $('#editar_usuario_frm').serialize(), function(data)
			{
				if(data == "OK")
					$.prompt('El usuario ha sido editado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });
				else
					$.prompt('Ha ocurrido un error al editar el usuario.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });	
			});
		}
	});
	
	
	// Reglas de validación para el formulario "Editar Usuario"
	$("#pass_usuario_frm").validate({
		//onsubmit: false,
		rules: {
			pass_usuario_p : {
                minlength : 5
            },
            confirm_pass_usuario_p : {
              	minlength : 5,
                equalTo : "#pass_usuario_p"
           	}

		},
		messages: {
			pass_usuario_p: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			confirm_pass_usuario_p: "Las contrase\u00f1as no coinciden"
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			$.post('./include/guarda_usuario.php', $('#pass_usuario_frm').serialize(), function(data)
			{
				if(data == "OK")
					$.prompt('La contrase&ntilde;a del usuario ha sido modificada con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });
				else
					$.prompt('Ha ocurrido un error al intentar cambiar la contrase&ntilde;a del usuario.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_usuarios.php'); } });	
			});
		}
	});
	
	
	
	// Reglas de validación para el formulario "Crear Cliente"
	$("#nuevo_cliente_frm").validate({
		//onsubmit: false,
		rules: {
			tipo_cliente: { required: true },
			rut_cliente: { required: true, rut: true }, 
			nombre_cliente: "required",
			direccion_cliente: "required",
			region_cliente: "required",
			comuna_cliente: "required",
			
			correo_cliente: {
				required: true,
				email: true
			},
			contacto_cliente: "required",
			telefono_cliente: { required: true, digits: true }, 
			celular_cliente: { required: true, digits: true }

		},
		messages: {
			tipo_cliente: "Seleccione un tipo",
			rut_cliente: "Ingrese un rut v\u00e1lido",
			nombre_cliente: "Ingrese nombre cliente",
			direccion_cliente: "Ingrese direcci\u00f3n cliente",
			region_cliente: "Seleccione una regi\u00f3n",
			comuna_cliente: "Seleccione una comuna",
			
			correo_cliente: "Ingrese un correo v\u00e1lido",
			contacto_cliente: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			telefono_cliente: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			celular_cliente: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			$.post('./include/guarda_cliente.php', $('#nuevo_cliente_frm').serialize(), function(data)
			{
				var aux = data.split("|");
						
				var mensaje 	= aux[0];
				var id_cliente	= aux[1];
				
				if(mensaje == "OK")
					$.prompt('El cliente ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_clientes.php'); } });
				else
					$.prompt('Ha ocurrido un error al crear el cliente.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_clientes.php'); } });	
			});
			
		}
	});
	
	
	
	// Reglas de validación para el formulario "Editar Cliente"
	$("#editar_cliente_frm").validate({
		//onsubmit: false,
		rules: {
			tipo_cliente_edit: { required: true },
			rut_cliente_edit: { required: true, rut: true }, 
			nombre_cliente_edit: "required",
			direccion_cliente_edit: "required",
			region_cliente_edit: "required",
			comuna_cliente_edit: "required",
			
			correo_cliente_edit: {
				required: true,
				email: true
			},
			contacto_cliente_edit: "required",
			telefono_cliente_edit: { required: true, digits: true }, 
			celular_cliente_edit: { required: true, digits: true }

		},
		messages: {
			tipo_cliente_edit: "Seleccione un tipo",
			rut_client_edite: "Ingrese un rut v\u00e1lido",
			nombre_cliente_edit: "Ingrese nombre cliente",
			direccion_cliente_edit: "Ingrese direcci\u00f3n cliente",
			region_cliente_edit: "Seleccione una regi\u00f3n",
			comuna_cliente_edit: "Seleccione una comuna",
			
			correo_cliente_edit: "Ingrese un correo v\u00e1lido",
			contacto_cliente_edit: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			telefono_cliente_edit: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			celular_cliente_edit: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			$.post('./include/guarda_cliente.php', $('#editar_cliente_frm').serialize(), function(data)
			{
				if(data == "OK")
					$.prompt('El cliente ha sido modificado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_clientes.php'); } });
				else
					$.prompt('Ha ocurrido un error al modificar el cliente.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_clientes.php'); } });	
			});
			
		}
	});
	
	
	// Reglas de validación para el formulario "Crear Contrato"
	$("#nuevo_contrato_frm").validate({
		//onsubmit: false,
		rules: {
			tipo_cliente_contrato: { required: true },
			rut_cliente_contrato: { required: true, rut: true,  maxlength: 12 }, 
			nombre_cliente_contrato: { required: true,  maxlength: 250 },
			direccion_cliente_contrato: { required: true,  maxlength: 250 },
			region_cliente_contrato: { required: true },
			comuna_cliente_contrato: { required: true },
			
			correo_cliente_contrato: {
				required: true,
				email: true,  
				maxlength: 100 
			},
			contacto_cliente_contrato: { required: false,  maxlength: 250 },
			telefono_cliente_contrato: { required: false, digits: true,  maxlength: 15  }, 
			celular_cliente_contrato: { required: true, digits: true,  maxlength: 15  },
			tipo_ingreso: { required: true },
			fecha_recepcion: { required: true },
			familia_contrato: { required: true },
			num_serie: { required: true,  maxlength: 250 },
			modelo: { required: true,  maxlength: 250 },
			descripcion: { required: true,  maxlength: 250 },
			marca: { required: true,  maxlength: 250 },
			falla_cliente: { required: true, maxlength: 250 },
			cod_vendedor: { required:true, digits: true,  maxlength: 5 },
			//num_boleta: {required: true, digits: true },
			num_boleta: { 	digits: true, 
							required: function(element) {
        													return $("#familia_contrato").val() == 2;
      													},
							maxlength: 10,
							minlength: 5 
			},		
			fecha_boleta: { required: function(element) {
        													return $("#familia_contrato").val() == 2;
      													} },
			fecha_diagnostico: { required: true },
			fecha_entrega: { required: true }

		},
		messages: {
			tipo_cliente_contrato: "Seleccione un tipo",
			rut_cliente_contrato: "Ingrese un rut v\u00e1lido",
			nombre_cliente_contrato: "Ingrese nombre cliente (m\u00e1x. 250 carac.)",
			direccion_cliente_contrato: "Ingrese direcci\u00f3n cliente (m\u00e1x. 250 carac.)",
			region_cliente_contrato: "Seleccione una regi\u00f3n",
			comuna_cliente_contrato: "Seleccione una comuna",
			
			correo_cliente_contrato: "Ingrese un correo v\u00e1lido (m\u00e1x. 100 carac.)",
			//contacto_cliente_contrato: "Ingresar contrase\u00f1a de 5 caracteres m\u00ednimo",
			//telefono_cliente_contrato: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			celular_cliente_contrato: "Ingrese un tel\u00e9fono (s\u00f3lo n\u00fameros)",
			
			tipo_ingreso: 'Seleccion un tipo',
			fecha_recepcion: 'Seleccione una fecha v\u00e1lida',
			familia_contrato: 'Seleccione una familia',
			num_serie: 'Ingrese un n\u00famero de serie',
			modelo: 'Ingrese un modelo',
			descripcion: 'Ingrese una descripci\u00f3lon',
			marca: 'Ingrese una marca',
			falla_cliente: 'Detalle la falla seg\u00fan cliente (m\u00e1x 200 caracteres)',
			cod_vendedor: 'Ingrese c\u00f3lod. vendedor',
			num_boleta: "Ingrese un n\u00famero de boleta (s\u00f3lo n\u00fameros, min. 10 dig.)",
			fecha_boleta: 'Seleccione una fecha v\u00e1lida',
			fecha_diagnostico: 'Seleccione una fecha v\u00e1lida',
			fecha_entrega: 'Seleccione una fecha v\u00e1lida'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			if($('#id_cliente').val() == 0)
			{
				// Se ingresaron los datos del cliente manualmente, sin utilizar el autocomplete. Por lo tanto se debe guardar el nuevo cliente.
				var cliente_ok;
				
				$.post('./include/guarda_cliente.php', {
															accion				: 'nuevo',	
															tipo_cliente		: $('#tipo_cliente_contrato').val(),
															rut_cliente			: $('#rut_cliente_contrato').val(),
															cod_cliente			: $('#cod_cliente_contrato').val(),
															tienda_cliente		: $('#tienda_cliente_contrato').val(),
															nombre_cliente		: $('#nombre_cliente_contrato').val(),
															direccion_cliente	: $('#direccion_cliente_contrato').val(),
															region_cliente		: $('#region_cliente_contrato').val(),
															comuna_cliente		: $('#comuna_cliente_contrato').val(),
															correo_cliente		: $('#correo_cliente_contrato').val(),
															contacto_cliente	: $('#contacto_cliente_contrato').val(),
															telefono_cliente	: $('#telefono_cliente_contrato').val(),
															celular_cliente		: $('#celular_cliente_contrato').val()
														}, function(data)
				{
					var aux = data.split("|");
						
					var mensaje 	= aux[0];
					var id_cliente	= aux[1];
					
					
					
					if(mensaje == 'OK')
					{
						$('#id_cliente').val(id_cliente);
						
						
						
						$.post('./include/guarda_contrato.php', $('#nuevo_contrato_frm').serialize(), function(data)
						{
								var aux = data.split("|");
								
								var mensaje 	= aux[0];
								var id_contrato	= aux[1];
								
								var error_temp 	= data.split(' -> ');
						
								var error_smtp = error_temp[0];
						
								if(mensaje == "OK")
								{
									loadingOff();
											
									$('#cliente_contrato').focus();
									
									if (uploader.files.length > 0)
									{ 
										uploader.setOption("url", "./include/upload.php?id=" + id_contrato + "&paso=recepcion");
										uploader.start();
										
										uploader.bind("UploadComplete", function (up, file) 
										{
											if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) 
											{
												if(error_smtp == "SMTP")
													$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
												else
													$.prompt('El contrato ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
											}
											else
												$.prompt('Ha ocurrido un error al crear el contrato.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
										});
									}
									else
										$.prompt('El contrato ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else if(mensaje == "NO CLIENTE")
								{
									loadingOff();
									
									$('#cliente_contrato').focus();
											
									$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al cliente.<br>Intente enviar el correo desde el panel de administraci&oacute;n', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else if(mensaje == "NO TECNICO")
								{
									loadingOff();
									
									$('#cliente_contrato').focus();
									
									$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else if(mensaje == "ERROR CORREO")
								{
									loadingOff();
									
									$('#cliente_contrato').focus();
									
									$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else if(error_smtp == "SMTP")
								{
									loadingOff();
									
									$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else
								{
									loadingOff();
									$('#cliente_contrato').focus();
									
									$.prompt('Ha ocurrido un error al crear el contrato.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
									
							
						});
						
					}
					else
					{
						loadingOff();
						
						$('#cliente_contrato').focus();
						
						$.prompt('Ha ocurrido un error al intentar guardar el nuevo cliente.<br>Favor intentar nuevamente, y si el problema persiste p&oacute;nganse en contacto con el administrador del sistema.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
					}
				});
															
															
			}
			else
			{
			
				$.post('./include/guarda_contrato.php', $('#nuevo_contrato_frm').serialize(), function(data)
				{
						var aux = data.split("|");
						
						var mensaje 	= aux[0];
						var id_contrato	= aux[1];
						
						var error_temp 	= data.split(' -> ');
						
						var error_smtp = error_temp[0];
						
						loading();
									
						if(mensaje == "OK")
						{
							loadingOff();
							
							$('#cliente_contrato').focus();
							
							if (uploader.files.length > 0)
							{ 
								uploader.setOption("url", "./include/upload.php?id=" + id_contrato + "&paso=recepcion");
								uploader.start();
								
								uploader.bind("UploadComplete", function (up, file) 
								{
									if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) 
									{
										if(error_smtp == "SMTP")
											$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
										else
											$.prompt('El contrato ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
									}
									else
										$.prompt('Ha ocurrido un error al crear el contrato.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								});
							}
							else
								$.prompt('El contrato ha sido creado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						}
						else if(error_smtp == "SMTP")
						{
							loadingOff();
							$('#cliente_contrato').focus();
							
							$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						}
						else
						{
							loadingOff();
							$('#cliente_contrato').focus();
							
							$.prompt('Ha ocurrido un error al crear el contrato.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						}
							
							
					
				});
			}
		}
	});
	
	
	// Reglas de validación para el formulario "Crear Diagnosotico"
	$("#diagnostico_contrato_frm").validate({
		//onsubmit: false,
		rules: {
			fecha_inicio_d: { required: true },
			fecha_termino_d: { required: true }, 
			respuesta_tipo: { required: true },
			diagnostico_cliente: { required: true, maxlength: 250 },
			diagnostico_interno: { required: false, maxlength: 250 },
			fecha_ppto: { required: true },
			observacion_otra_respuesta: { required: function(element) {
																			return $('#respuesta_tipo').val() == 2;
																	}
			},
			//estado_ppto_sel: { required: true },
			num_gsx: { 
						required: function(element) {
        												return $("#check_g").val() == 1;
      												},
						maxlength: 50
			},											
													
			cod_repuesto_1: 'required'
			
		},
		messages: {
			fecha_inicio_d: 'Seleccione una fecha v\u00e1lida',
			fecha_termino_d: 'Seleccione una fecha v\u00e1lida',

			respuesta_tipo: 'Seleccione una respuesta v\u00e1lida',
			diagnostico_cliente: 'Ingrese detalle diagn\u00f3stico cliente',
			diagnostico_interno: 'M\u00e1x. 250 caract.',
			fecha_ppto: 'Seleccione una fecha v\u00e1lida',
			//estado_ppto: 'Seleccione un estado',
			num_gsx: 'Ingrese n\u00famero GSX v\u00e1lido',
			cod_repuesto_1: 'Debe ingresar al menos un repuesto',
			observacion_otra_respuesta: 'Debe ingresar un detalle para la respuesta'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			
			$.post('./include/guarda_contrato.php', $('#diagnostico_contrato_frm').serialize(), function(data)
			{
				var aux = data.split("|");
						
				var mensaje 		= aux[0];
				var id_contrato		= aux[1];
				
				var error_temp		= data.split(" -> ");
				var error_smpt		= error_temp[0];
				
				if((mensaje == "OK") || (mensaje == "CORREO") || (mensaje == "ENVCORREO"))
				{
					if (uploader.files.length > 0)
					{ 
						uploader.setOption("url", "./include/upload.php?id=" + id_contrato + "&paso=diagnostico");
						uploader.start();
						
						uploader.bind("UploadComplete", function (up, file) 
						{
							loadingOff();
							$('#serie_contrato').focus();
									
							if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) 
							{
								if(mensaje == "OK")
								{
									
									if(error_smpt == "SMTP")
										$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
									else
										$.prompt('El diagn&oacute;stico ha sido guardado y enviado al cliente con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
								}
								else if(mensaje == "CORREO")
									$.prompt('Ha ocurrido un error al enviar el correo al cliente. Sin embargo, el diagn&oacute;stico ha sido guardado con &eacute;xito.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
								else if(mensaje == "ENVCORREO")
									$.prompt('El diagn&oacute;stico ha sido guardado con &eacute;xito.<br>Recuerda que no lo enviaste al cliente en esta oportunidad.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
								else if(error_smpt == "SMTP")
									$.prompt('El contrato ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
							}
							else
								$.prompt('Ha ocurrido un error al guardar las im&aacute;genes del diagn&oacute;stico. Sin embargo la informaci&oacute;n del diagn&oacute;stico fue guardada con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
								//alert("ERROR");
						});
					}
					else
					{
						loadingOff();
						$('#serie_contrato').focus();
							
						if(mensaje == "OK")
							$.prompt('El diagn&oacute;stico ha sido guardado y enviado al cliente con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						else if(mensaje == "CORREO")
							$.prompt('Ha ocurrido un error al enviar el correo al cliente. Sin embargo, el diagn&oacute;stico ha sido guardado con &eacute;xito.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						else if(mensaje == "ENVCORREO")
									$.prompt('El diagn&oacute;stico ha sido guardado con &eacute;xito.<br>Recuerda que no lo enviaste al cliente en esta oportunidad.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
						else if(error_smpt == "SMTP")
									$.prompt('El diagn&oacute;stico ha sido creado con &eacute;xito, pero ha ocurrido un error al enviar el correo al t&eacute;cnico asignado y al cliente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });		
					}
				}
				else
				{
					loadingOff();
					$('#serie_contrato').focus();
							
					$.prompt('Ha ocurrido un error al guardar el diagn&oacute;stico.<br>Error: ' + data, { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
					//alert("ERROR");
				}
				
			});
			
		}
	});
	
	
	// Reglas de validación para el formulario "Pagar Contrato"
	$("#pagar_contrato_frm").validate({
		//onsubmit: false,
		rules: {
			boleta_contrato: { required: true, digits: true }
			
		},
		messages: {
			boleta_contrato: 'Ingrese un n\u00famero v\u00e1lido'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			
			$.post('./include/guarda_pago.php', $('#pagar_contrato_frm').serialize(), function(data)
			{
				
				var mensaje 		= data;
				loadingOff();
				
				if(mensaje == "OK")
				{
					$.prompt('El pago del presupuesto ha sido guardado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
				}
				else
				{
					$.prompt('Ha ocurrido un error al intentar guardar el pago del presupuesto.<br>Favor intentar nuevamente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
				}
				
			});
			
		}
	});
	
	
	// Reglas de validación para el formulario "Cambiar Estado Contrato"
	$("#estado_contrato_frm").validate({
		//onsubmit: false,
		rules: {
			estado_nuevo: { required: true }
			
		},
		messages: {
			estado_nuevo: 'Debe seleccionar un nuevo estado'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			$.post('./include/cambia_estado_contrato.php', $('#estado_contrato_frm').serialize(), function(data)
			{
				var mensaje 		= data;
					
				loadingOff();
				
				if(mensaje == "OK")
				{
					$.prompt('El estado del contrato ha sido modificado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
				}
				else
				{
					$.prompt('Ha ocurrido un error al intentar modificar el estado del contrato.<br>Favor intentar nuevamente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
				}
				
			});
			
		}
	});
	
	
	// Reglas de validación para el formulario "Finalizar Contrato"
	$("#finalizar_contrato_frm").validate({
		//onsubmit: false,
		rules: {
			observaciones_finales: { required: true, maxlength: 250 }
			
		},
		messages: {
			observaciones_finales: 'Debe ingresar una observacion final'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			$.post('./include/finalizar_contrato.php', $('#finalizar_contrato_frm').serialize(), function(data)
			{
				var mensaje 		= data;
				
				loadingOff();
					
				if(mensaje == "OK")
				{
					$.prompt('El contrato ha sido finalizado con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });
				}
				else
				{
					$.prompt('Ha ocurrido un error al intentar finalizar el contrato.<br>Favor intentar nuevamente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_contratos.php'); } });	
				}
				
			});
			
		}
	});
	
	
	
	// Reglas de validación para el formulario "Finalizar OC"
	$("#finalizar_oc_frm").validate({
		//onsubmit: false,
		rules: {
			num_oc: { required: true, digits: true }
			
		},
		messages: {
			num_oc: 'Debe ingresar una orden de compra'
		},
		
		submitHandler: function(form) {
			// do other things for a valid form
			loading();
			$.post('./include/finalizar_oc.php', $('#finalizar_oc_frm').serialize(), function(data)
			{
				var mensaje 		= data;
					
				loadingOff();
					
				if(mensaje == "OK")
				{
					$.prompt('La Orden de Compra ha sido recibida con &eacute;xito', { submit: function(e,v,m,f) { actualiza(v, './gestion_repuestos.php'); } });
				}
				else
				{
					$.prompt('Ha ocurrido un error al intentar recibir la Orden de Compra.<br>Favor intentar nuevamente.', { submit: function(e,v,m,f) { actualiza(v, './gestion_repuestos.php'); } });	
				}
				
			});
			
		}
	});
	
	
	
	// Desactivar el submit del formulario al presionar tecla "Enter"
	$('#nuevo_usuario_frm, #editar_usuario_frm, #pass_usuario_frm, #nuevo_cliente_frm, #editar_cliente_frm, #nuevo_contrato_frm, #diagnostico_contrato_frm, #pagar_contrato_frm, #estado_contrato_frm, #finalizar_contrato_frm, #finalizar_oc_frm').keydown(function(event)
	{

		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	});
	
	
	
	
	
	//////////////////////////////////////////////////////////////////
	// FIN VALIDAR FORMULARIOS										//
	//////////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////////
	// FUNCIONES VARIAS												//
	//////////////////////////////////////////////////////////////////
	
	
	//$('.elimina_repuesto').on('click', function()
	
	
	// Función utilizada para que luego de presionar "SI" en un mensaje $.prompt se redireccione a la URL contenida en el parámetro "destino". Si presiona "NO", cierra el $.prompt
	function actualiza(v, destino)
	{
		if(!v)
			$.prompt.close();
		else
		{
			$.prompt.close();
			window.location = destino;
		}
	}

			
	
	// Función para dar al parámetro "entrada", formato de moneda.
	function Moneda(entrada)
	{
		var num = entrada.replace(/\./g,"");
		if(!isNaN(num))
		{
			num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
			num = num.split("").reverse().join("").replace(/^[\.]/,"");
			entrada = num;
		}
		else
		{
			entrada = input.value.replace(/[^\d\.]*/g,"");
		}
		
		return entrada;
	}
	
	// Función para limpiar todos los campos del formulario indicado en el parámetro "miForm"
	function limpiaForm(miForm, campoFoco) {
		// recorremos todos los campos que tiene el formulario
		
		if(miForm == 'nuevo_contrato_frm')
			$('#id_cliente').val('0');
		
		var validator = $("#" + miForm).validate();
		validator.resetForm();
		
		$(':input', '#' + miForm).each(function() 
		{

			var type = this.type;
			var tag = this.tagName.toLowerCase();
			
			//limpiamos los valores de los campos…
			if (type == 'text' || type == 'password' || tag == 'textarea')
			{

				if($('#' + this.id).attr('id') != 'cod_cliente' && $('#' + this.id).attr('id') != 'cod_cliente_contrato' && $('#' + this.id).attr('id') != 'tecnico_asignado' && $('#' + this.id).attr('id') != 'id_tecnico' && $('#' + this.id).attr('id') != 'fecha_recepcion')
				{
					
					this.value = "";
					$('#' + this.id).removeAttr("title");
					$('#' + this.id).removeClass("ui-state-error");
				}
			}
		
			// excepto de los checkboxes y radios, le quitamos el checked
			// pero su valor no debe ser cambiado
			else if (type == 'checkbox' || type == 'radio')
				this.checked = false;
			
			// los selects le ponesmos el indice a -
			else if (tag == 'select')
			{
				$('select').each(function() {
					//$(this).find('option:first').attr('selected',true);
					$(this).prop('selectedIndex',0);
					
				})
				
			}
		});
		
		if(campoFoco != "-")
		{
			$("#" + campoFoco).focus();
		}
	}
	
	function limpiaError(miForm)
	{
		var validator = $("#" + miForm).validate();
		validator.resetForm();
		
		$(':input', '#' + miForm).each(function() 
		{

			var type = this.type;
			var tag = this.tagName.toLowerCase();	
			
			$('#' + this.id).removeAttr("title");
			$('#' + this.id).removeClass("ui-state-error");
		});
	}
	
	
	function agregaRepuesto(i)
	{
		var req_codigo = '';
		var elimina = '';
		
		if(i == 1)
			req_codigo = 'required';
		//else
		//	elimina = '<a href="#" id="elimina_rep_' + i + '" class="elimina_repuesto" onclick="eliminaRepuesto(' + i + ');"><img src="./images/delete.png" width="10" height="10"></a>';
		
		var html 	= '<tr id="tr_' + i + '"> \
                        	<td align="center"> \
                            	<input type="hidden" name="id_' + i + '" id="id_' + i + '" value="0" /> \
								<input type="hidden" name="id_repuesto_' + i + '" id="id_repuesto_' + i + '" value="0" /> \
                            	<input type="text" name="cod_repuesto_' + i + '" id="cod_repuesto_' + i + '" class="repuesto" value="" ' + req_codigo + ' /> \
								<input type="hidden" name="tipo_repuesto_' + i + '" id="tipo_repuesto_' + i + '" value="1" /> \
                            </td> \
                            <td align="center"><input type="text" name="des_repuesto_' + i + '" id="des_repuesto_' + i + '" value="" readonly="readonly" /></td> \
                            <td align="center"><input type="text" name="cant_repuesto_' + i + '" id="cant_repuesto_' + i + '" class="cantidad" value="1" style="width:80px; text-align:center;" /></td> \
                            <td align="center"> \
                            	<input type="text" name="unit_repuesto_' + i + '" id="unit_repuesto_' + i + '" value="" style="width:80px; text-align:right;" readonly="readonly" /> \
                                <input type="hidden" name="unit_repuesto_limpio_' + i + '" id="unit_repuesto_limpio_' + i + '" value="" style="width:80px; text-align:right;" /> \
                            </td> \
                            <td align="center"> \
                            	<input type="text" name="total_repuesto_' + i + '" id="total_repuesto_' + i + '" value="" style="width:80px; text-align:right;" readonly="readonly" /> \
                            	<input type="hidden" name="total_repuesto_limpio_' + i + '" id="total_repuesto_limpio_' + i + '" value="" style="width:80px; text-align:right;" /> \
                            </td> \
							<td>' + elimina + '</td> \
                        </tr>';	
						
		$('#tabla_repuestos tbody:last').before(html);	
		$('#cant_filas').val(i);
		
		
		$("#cod_repuesto_" + i).autocomplete(
		{
			source: "./include/busca_repuesto.php",
			minLength: 2,
			select: function(event,ui)
					{
						var aux = $(this).attr('id').split('_');
						var i	= aux[2];
								
							
						$.post('./include/detalle_repuesto.php', {id_repuesto : ui.item.id}, function(data)
						{
							if(data.resultado == "OK")
							{
								
								limpiaError('diagnostico_contrato_frm');
								
								
								$('#id_repuesto_' + i).val(data.id_repuesto);
								$('#tipo_repuesto_' + i).val(data.tipo_repuesto);
													
								$('#cod_repuesto_' + i).val(data.codigo_repuesto);
								$('#des_repuesto_' + i).val(data.descripcion_repuesto);
								$('#unit_repuesto_' + i).val(Moneda(data.precio_repuesto));
								$('#unit_repuesto_limpio_' + i).val(data.precio_repuesto);
								
								var cantidad 		= parseInt($('#cant_repuesto_' + i).val());
								var precio_repuesto	= parseInt(data.precio_repuesto);
								
								var total_repuesto 	= (cantidad * precio_repuesto);
								
								calculaTotales();
								
								$('#total_repuesto_' + i).val(Moneda(String(total_repuesto)));
								$('#total_repuesto_limpio_' + i).val(total_repuesto);
								
								
							}
							else
								$.prompt("Ha ocurrido un error al intentar recuperar la informaci&oacute;n del repuesto.<br>Favor intentar nuevamente, y si el problema persiste informar al administrador del sistema.<br><br>Error: " + data.error, { submit: function(e,v,m,f) { limpiaForm('diagnostico_contrato_frm', 'repuesto_' + i); } });
						}, 'json');
					  
						
						
						
					}
		});
		
		$('#cant_repuesto_' + i).on('blur', function(e)
		{
			var aux = $(this).attr('id').split('_');
			var id	= aux[2];
			
			if($(this).val().length === 0)
			{
				$('#cant_repuesto_' + id).val(1);
				calculaTotales();
				$('#cant_repuesto_' + id).select(); 
			}
		});
		
		
		$('#cant_repuesto_' + i).on("keyup", function(e)
		{
	
			var aux = $(this).attr('id').split('_');
			var id	= aux[2];
			
			var key;
			if (e.keyCode)
				key = e.keyCode;
			else
				key = e.which;
	
			if ((key < 48 || key > 57) && (key < 96 || key > 105) && (key != 8) && (key != 9))
			{
	
				if(navigator.appName == "Microsoft Internet Explorer")
				{
					window.event.keyCode=0;
					
				}
				else
				{
					e.preventDefault();
					e.stopPropagation();
					$(this).val(1);
					calculaTotales();
					$(this).select();
				}
			}
			else
			{
			
					var next_id = parseInt(id) + 1;
					
					
					$.post('./include/verifica_stock.php', {cantidad : $('#cant_repuesto_' + id).val(), codigo : $('#cod_repuesto_' + id).val() }, function(data)
					{
						if(data == "OK")
						{
							calculaTotales();
						}
						else if(data == "NO")
						{
							$("#unit_repuesto_" + id).focus();
							$.prompt("El repuesto seleccionado no tiene stock", 
									{
			
										submit: function(e,v,m,f) 
										{ 
											if(!v)
											{
												$.prompt.close();
												
											}
											else
											{
												limpia_repuesto(v, id)
											}
										} 
									});		
											
							
						}
						else if(data == "MAYOR")
						{
							$("#unit_repuesto_" + id).focus();
							
							$.prompt("La cantidad solicitada excede el stock disponible del repuesto", 
										{
											submit: function(e,v,m,f) 
											{ 
												if(!v)
													$.prompt.close();
												else
												{
													$('#cant_repuesto_' + id).val(1); 
													calculaTotales();
													$('#cant_repuesto_' + id).select();
												}
											} 
										}
									);	
						}
						else
						{
							$("#unit_repuesto_" + id).focus();
							$.prompt("Ha ocurrido un error al intentar verificar el stock del repuesto.\nFavor intentar nuevamente.", 
								{
									submit: function(e,v,m,f) 
									{ 
										if(v)
										{
											limpia_repuesto(v, id)
										}
													
									} 
								});	
						}
					});
				
			}
					  
		});
		
		$('.repuesto').on('blur', function()
		{
			var aux = $(this).attr('id').split('_');
			var id	= aux[2];
			
			if($(this).val() == "")
			{
				//$('#id_repuesto_' + id).val(0);	
				limpia_repuesto(true, id);
			}
		});
		
	}
	
	
	
	function agregaRepuestoVer(i)
	{
		var req_codigo = '';
		
		if(i == 1)
			req_codigo = 'required';
		
		var html 	= '<tr id="tr_' + i + '"> \
                        	<td align="center"> \
								<input type="hidden" name="tipo_repuesto_' + i + '" id="tipo_repuesto_' + i + '" value="1" readonly="readonly" /> \
                            	<input type="text" name="cod_repuesto_' + i + '" id="cod_repuesto_' + i + '" class="repuesto" value=""  readonly="readonly" ' + req_codigo + ' /> \
                            </td> \
                            <td align="center"><input type="text" name="des_repuesto_' + i + '" id="des_repuesto_' + i + '" value="" readonly="readonly" /></td> \
                            <td align="center"><input type="text" name="cant_repuesto_' + i + '" id="cant_repuesto_' + i + '" class="cantidad" value="1" readonly="readonly" style="width:80px; text-align:center;" /></td> \
                            <td align="center"> \
                            	<input type="text" name="unit_repuesto_' + i + '" id="unit_repuesto_' + i + '" value="" style="width:80px; text-align:right;" readonly="readonly" /> \
                                <input type="hidden" name="unit_repuesto_limpio_' + i + '" id="unit_repuesto_limpio_' + i + '" value="" style="width:80px; text-align:right;" /> \
                            </td> \
                            <td align="center"> \
                            	<input type="text" name="total_repuesto_' + i + '" id="total_repuesto_' + i + '" value="" style="width:80px; text-align:right;" readonly="readonly" /> \
                            	<input type="hidden" name="total_repuesto_limpio_' + i + '" id="total_repuesto_limpio_' + i + '" value="" style="width:80px; text-align:right;" /> \
                            </td> \
                        </tr>';	
						
		$('#tabla_repuestos_ver tbody:last').before(html);	
	
	}
	
	function calculaTotales()
	{
		var i;
		var cantidad;
		var precio_unitario;
		var total_repuesto;
		
		var total_ppto = 0;
		var total_prod;

		var cuantos = $('#cant_filas').val();
		
		for(i=1; i<=cuantos; i++)
		{
			if($('#unit_repuesto_limpio_' + i).val() != 0)
			{
			
				cantidad		= parseInt($('#cant_repuesto_' + i).val());	
				precio_unitario	= parseInt($('#unit_repuesto_limpio_' + i).val());
			
				// Precio total por cada repuesto ingresado
				total_repuesto	= parseInt(precio_unitario * cantidad);
			
				$('#total_repuesto_' + i).val(Moneda(String(total_repuesto)));
				$('#total_repuesto_limpio_' + i).val(total_repuesto);

				if(($('#tipo_repuesto_' + i).val() == 1) && ($('#check_g').val() == 1))
					total_ppto		+= total_repuesto;
				else if(($('#tipo_repuesto_' + i).val() == 0) && ($('#check_g').val() == 1))
					total_ppto		+= 0;
				else 
					total_ppto 		+= total_repuesto;
				
				
				
			}
					
			
		}
		
		
		
		var neto_ppto	= parseInt(total_ppto / 1.19);
		
		var iva_ppto	= parseInt(total_ppto) - parseInt(neto_ppto);
		
		
		
		$('#total_final').val(Moneda(String(total_ppto)));
		$('#total_final_limpio').val(total_ppto);
		
		$('#sub_total').val(Moneda(String(neto_ppto)));
		$('#sub_total_limpio').val(neto_ppto);
				
		$('#iva').val(Moneda(String(iva_ppto)));
		$('#iva_limpio').val(iva_ppto);	
		
		/*if($('#check_g').val() == 1)
		{
			$('#total_pagar').val(Moneda(String(0)));
			$('#total_pagar_limpio').val(0);	
		}
		else
		{*/
			$('#total_pagar').val(Moneda(String(total_ppto)));
			$('#total_pagar_limpio').val(total_ppto);
		
		//}
		
	}
	
	function limpia_repuesto(resp, id)
	{
		
		if(resp)
		{
			$.prompt.close();
			
			$('#id_repuesto_' + id).val(0);
			
			$('#cod_repuesto_' + id).val('');
			$('#des_repuesto_' + id).val('');
			$('#cant_repuesto_' + id).val('');
			$('#unit_repuesto_' + id).val('');
			$('#unit_repuesto_limpio_' + id).val(0);
			$('#total_repuesto_' + id).val('');
			$('#total_repuesto_limpio_' + id).val(0);
			
			calculaTotales();
			
			$('#cod_repuesto_' + id).val('');
			$('#cod_repuesto_' + id).focus();
				
		}
		else
		{
			$.prompt.close();
			return false;
		}
	}
	
	
	function loading()
	{
		var capaLoading = $('<div class="loading"><img src="/images/loading.gif" width="60" height="60"></div>');	
		capaLoading.appendTo('body');
		
		capaLoading.delay("slow").fadeIn();
		
	}
	
	function loadingOff()
	{
		$('.loading').fadeOut();	
	}
	
	
	function eliminaRepuesto(id)
	{
		
		var cant 	= parseInt($('#cant_filas').val());
		var nueva_c	= parseInt(cant - 1);
		
		$('#cant_filas').val(nueva_c);
		
		$('#id_repuesto_' + id).val('');
		$('#cod_repuesto_' + id).val('');
		$('#des_repuesto_' + id).val('');
		$('#cant_repuesto_' + id).val(1);
		$('#unit_repuesto_' + id).val('');
		$('#unit_repuesto_limpio_' + id).val('');
		$('#total_repuesto_' + id).val('');
		$('#total_repuesto_limpio_' + id).val('');
		
		$('#tr_' + id).fadeOut();
		
		calculaTotales();
		
	}
	
	
});
	