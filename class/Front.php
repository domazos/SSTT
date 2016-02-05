<?php
session_name('sstt');
session_start();

include(dirname(__FILE__) . '/../include/defines.inc.php');


class Front extends Smarty
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplateDir(_TPL_DIR_);
        $this->setCompileDir(_SMARTY_DIR_ . 'templates_c/');
        $this->setConfigDir(_SMARTY_DIR_ . 'configs/');
        $this->setCacheDir(_SMARTY_DIR_ . 'cache/');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
		
	}
	
	public function displayHeader()
	{
		
		$smarty = new Front;
		$smarty->caching = false;
		# CSS
		
		$css_files	= array(
								_CSS_DIR_ . 'style.css',
								_CSS_DIR_ . 'jquery.fancybox.css',
								_CSS_DIR_ . 'impromptu.css',
								'//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css',
								#_CSS_DIR_ . 'jquery-ui.css',
								#_ROOT_DIR_ . 'uploadify/uploadify.css',
								_JS_DIR_ . 'tablesorter-master/css/theme.metro-dark.css',
								_CSS_DIR_ . 'estilo.css',
								_CSS_DIR_ . 'jquery-ui-timepicker-addon.css',
								_CSS_DIR_ . 'plupload.css'
								

		
							);

		# JS
		
		$js_files	= array(
								'//code.jquery.com/jquery-1.10.2.js',
								#_JS_DIR_ . 'jquery-1.10.2.js',
								'//code.jquery.com/ui/1.11.4/jquery-ui.js',
								#_JS_DIR_ . 'jquery-ui.js',
								_JS_DIR_ . 'jquery.validate.js',								
								_JS_DIR_ . 'calendario_es.js',
								_JS_DIR_ . 'functions.ajax.js',
								_JS_DIR_ . 'jquery.fancybox.js',
								_JS_DIR_ . 'jquery-impromptu.5.2.4.js',
								_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.js',
								_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.widgets.js',
								_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.widgets-filter-custom-search.js',
								_JS_DIR_ . 'tablesorter-master/addons/pager/jquery.tablesorter.pager.js',
								_JS_DIR_ . 'printArea.js',
								'//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
								_JS_DIR_ . 'jquery.Rut.js',
								_JS_DIR_ . 'jquery-ui-timepicker-addon.js',
								_JS_DIR_ . 'jquery-ui-sliderAccess.js',
								#_JS_DIR_ . 'plupload/js/plupload.full.min.js',
								#_ROOT_DIR_ . 'uploadify/swfobject.js',
								#_ROOT_DIR_ . 'uploadify/jquery.uploadify.v2.1.4.min.js',
								'//www.plupload.com/plupload/js/plupload.full.min.js',
								'//www.plupload.com/plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js',
								_JS_DIR_ . 'plupload/js/i18n/es.js'
								

							);
		
		# Varios
		
		$titulo		= "Sistema Servicio T&eacute;cnico - Reifschneider S.A";
		#$logo		= '<img src="images/logo_blanco.png" width="200">';
		$logo		= "<div class='titulo'>Sistema Servicio T&eacute;cnico - Reifschneider S.A</div>";
		$salir		= "";
		
		if($this->isLoged())
		{
			extract($_SESSION);
			$salir = 'Bienvenido '.$nombreUser.' <a id="logout" href="#">(salir)</a><span class="timer_logout" id="timer_logout"></span>';
		}
		
		$smarty->assign('logout', $salir);	
		
		
		$smarty->assign('titulo', $titulo);
		$smarty->assign('logo', $logo);
		$smarty->assign('css_files', $css_files);
		$smarty->assign('js_files', $js_files);
		
		
		$smarty->display('header.tpl');
	}
	
	
	public function displayHeaderCliente()
	{
		
		$smarty = new Front;
		$smarty->caching = false;
		# CSS
		
		$css_files	= array(
								_CSS_DIR_ . 'style.css',
								_CSS_DIR_ . 'jquery.fancybox.css',
								_CSS_DIR_ . 'impromptu.css',
								'//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css',
								#_JS_DIR_ . 'tablesorter-master/css/theme.metro-dark.css',
								_CSS_DIR_ . 'estilo.css'
								
							);

		# JS
		
		$js_files	= array(
								'//code.jquery.com/jquery-1.10.2.js',
								'//code.jquery.com/ui/1.11.4/jquery-ui.js',
								_JS_DIR_ . 'jquery.validate.js',								
								_JS_DIR_ . 'jquery.fancybox.js',
								_JS_DIR_ . 'jquery-impromptu.5.2.4.js',
								#_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.js',
								#_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.widgets.js',
								#_JS_DIR_ . 'tablesorter-master/js/jquery.tablesorter.widgets-filter-custom-search.js',
								#_JS_DIR_ . 'tablesorter-master/addons/pager/jquery.tablesorter.pager.js',
								_JS_DIR_ . 'printArea.js',
								_JS_DIR_ . 'jquery.Rut.js'
								
							);
		
		# Varios
		
		$titulo		= "Sistema Servicio T&eacute;cnico - Reifschneider S.A";
		$logo		= "<div class='titulo'>Sistema Servicio T&eacute;cnico - Reifschneider S.A</div>";
		
		$smarty->assign('titulo', $titulo);
		$smarty->assign('logo', $logo);
		$smarty->assign('css_files', $css_files);
		$smarty->assign('js_files', $js_files);
		
		
		$smarty->display('header_cliente.tpl');
	}
	
	
	public function displayFooter()
	{
		$smarty = new Front;
		
		$smarty->display('footer.tpl');	
		
	}
	
	
	
	public function isLoged()
	{
		extract($_SESSION);

		if((isset($userid)) and validar())
			return true;
		else
			return false;
			
	}
	
	
	public function logOut()
	{
		header("Location: ./include/logout.php");	
	}
	
	public function checkAccess()
	{
		if($_SERVER['REQUEST_URI'] != $_SERVER['PHP_SELF'])
			return true;
		else
			return false;	
	}
	
	
	public function displayContent($pagina)
	{
		
		$smarty = new Front;
		
		switch ($pagina)
		{
			case 'index'				:	
											$this->displayHeader();
											if(!$this->isLoged())
											{
												$smarty->caching = false;
												$smarty->display('index.tpl');						
												#$this->logOut();
											}
											else
											{
												$smarty->caching = false;
												$smarty->display('panel_gestion.tpl');						
											}
											$this->displayFooter();	
											
											break;
								
			case 'panel_gestion'		:	
											if($this->isLoged())
											{
												extract($_SESSION);
												
												$this->displayHeader();
												$smarty->caching = false;
												$smarty->assign('root_dir', _ROOT_DIR_);
												$smarty->assign('tipo_usuario', $tipoUser);
												$smarty->display('panel_gestion.tpl');						
												$this->displayFooter();
											}
											else
												$this->logOut();
												
											break;
											
			case 'gestion_usuarios'		:
											if($this->isLoged())
											{
												extract($_SESSION);
												
												include("Usuarios.php");
												
												$usuarios = new Usuarios;
												
												
												$this->displayHeader();
												$smarty->caching = false;
												$smarty->assign('root_dir', _ROOT_DIR_);
												$smarty->assign('tipo_usuario', $tipoUser);
												$smarty->assign('usuarios', $usuarios->listarUsuarios());
												$smarty->assign('cuantos_usuarios', $usuarios->cuantosUsuarios());
												$smarty->assign('tipos_usuario', $usuarios->tiposUsuario(0));
												$smarty->display('gestion_usuarios.tpl');						
												$this->displayFooter();
											}
											else
												$this->logOut();
												
											break;
											
			case 'gestion_contratos'	:
											if($this->isLoged())
											{
												
												extract($_SESSION);
												
												include("Contratos.php");
												include("Clientes.php");
												
												$contratos 	= new Contratos;
												$clientes 	= new Clientes;
												
												$id_usuario	= (($tipoUser == 3) or ($tipoUser == 4)) ? $userid : 0;
												
																																				
												$this->displayHeader();
												$smarty->caching = false;
												$smarty->assign('root_dir', _ROOT_DIR_);
												$smarty->assign('tipo_usuario', $tipoUser);
												$smarty->assign('contratos', $contratos->listarContratos($id_usuario));
												$smarty->assign('cuantos_contratos', $contratos->cuantosContratos($id_usuario));
												$smarty->assign('tipos_cliente', $clientes->cargaTipos(0));
												$smarty->assign('regiones', $clientes->cargaRegiones(0));
												$smarty->assign('tipo_contrato', $contratos->tiposContrato(0));
												$smarty->assign('familias', $contratos->familiaContrato(1));
												$smarty->assign('tecnico_asignado', $nombreUser);
												$smarty->assign('id_tecnico', $userid);
												$smarty->assign('respuesta_tipo', $contratos->listarRespuestasTipo(0));
												$smarty->assign('estados_ppto', $contratos->listarEstadoPresupuesto(0));
												
												#$smarty->assign('tope_diagnostico', $contratos->getWorkingDays($fecha_recepcion_f, $fecha_tope_d));
												$smarty->display('gestion_contratos.tpl');						
												$this->displayFooter();
											}
											else
												$this->logOut();
												
											break;
											
			case 'gestion_clientes'		:
											if($this->isLoged())
											{
												extract($_SESSION);
												
												include("Clientes.php");
												
												$clientes = new Clientes;
												
												
												$this->displayHeader();
												$smarty->caching = false;
												$smarty->assign('root_dir', _ROOT_DIR_);
												$smarty->assign('tipo_usuario', $tipoUser);
												$smarty->assign('clientes', $clientes->listarClientes());
												$smarty->assign('cuantos_clientes', $clientes->cuantosClientes());
												$smarty->assign('regiones', $clientes->cargaRegiones(0));
												$smarty->assign('tipos_cliente', $clientes->cargaTipos(0));
												$smarty->display('gestion_clientes.tpl');						
												$this->displayFooter();
											}
											else
												$this->logOut();
												
											break;
											
			case 'vb_cliente'			:
											extract($_REQUEST);
											
											$id_contrato = base64_decode($i);											
											
											include("Contratos.php");
												
											$contrato = new Contratos;
											
											$this->displayHeaderCliente();
											$smarty->caching = false;
											$smarty->assign('root_dir', _ROOT_DIR_);
											$smarty->assign('id_contrato', $id_contrato);
											$smarty->assign('info', $contrato->detalleContrato($id_contrato));
											$smarty->display('vb_cliente.tpl');						
											$this->displayFooter();
												
											break;
											
			case 'gestion_repuestos'	:
											extract($_REQUEST);
											extract($_SESSION);
											
											include("Repuestos.php");
												
											$repuestos = new Repuestos;
											
											$this->displayHeader();
											$smarty->caching = false;
											$smarty->assign('root_dir', _ROOT_DIR_);
											$smarty->assign('repuestos', $repuestos->listarRepuestos());
											$smarty->assign('cuantos_repuestos', $repuestos->cuantosRepuestos());
											$smarty->assign('tipo_usuario', $tipoUser);
											$smarty->display('gestion_repuestos.tpl');						
											$this->displayFooter();
												
											break;
											
											
			case 'carga_repuestos'	:
											extract($_REQUEST);
											
											include("Repuestos.php");
												
											$repuestos = new Repuestos;
											
											$this->displayHeader();
											$smarty->caching = false;
											$smarty->assign('root_dir', _ROOT_DIR_);
											$smarty->display('carga_repuestos.tpl');						
											$this->displayFooter();
												
											break;
			
								
			default					:  
										$this->displayHeader();
										$smarty->display('index.tpl');						
										$this->displayFooter();
			
		}
		
	}
	
}

?>