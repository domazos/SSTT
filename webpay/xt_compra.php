<?php
/*
*********************************************************************
* PRODUCTO	: SISTEMA DE PAGO TRANSBANK
* MODULO	: Pagina de Cierre
* VERSION	: 1.0
* FECHA		: 22/04/2004
* USUARIO	: CMENDEZ
* 
* Reifschneider S.A(c) 2004
* Todos los derechos reservados. Prohibida su reproduccion total
* o parcial sin la autorizacion escrita de Reifschneider S.A.
*
*********************************************************************
* DETALLES ADICIONALES
*********************************************************************
*
*********************************************************************
*/
$TBK_ORDEN_COMPRA = $_POST['TBK_ORDEN_COMPRA'];


#sendMail("jdomazos@reifschneider.cl", "Test", "Orden Compra:  " . $TBK_ORDEN_COMPRA, "Orden Compra:  " . $TBK_ORDEN_COMPRA);

if ($TBK_ORDEN_COMPRA > 9999999) { # Reifstore
    
    #sendMail("jdomazos@reifschneider.cl", "Reifstore", "Pasando compra " . $TBK_ORDEN_COMPRA, "Pasando compra " . $TBK_ORDEN_COMPRA);
    $secretKey4Sale = "30ae4ac59a38fa2d8c98cf36e1f6286b";

    $trs_respuesta 	= $_POST['TBK_RESPUESTA'];

    $post_data = array(
        'TBK_FECHA_TRANSACCION' => $_POST['TBK_FECHA_TRANSACCION'],
        'SECRET_KEY' => $secretKey4Sale,
        'TBK_HORA_TRANSACCION' => $_POST['TBK_HORA_TRANSACCION'],
        'TBK_CODIGO_AUTORIZACION' => $_POST['TBK_CODIGO_AUTORIZACION'],
        'TBK_FINAL_NUMERO_TARJETA' => $_POST['TBK_FINAL_NUMERO_TARJETA'],
        'TBK_ID_TRANSACCION' => $_POST['TBK_ID_TRANSACCION'],
        'TBK_TIPO_PAGO' => $_POST['TBK_TIPO_PAGO'],
        'TBK_NUMERO_CUOTAS' => $_POST['TBK_NUMERO_CUOTAS'],
        'TBK_TASA_INTERES_MAX' => $_POST['TBK_TASA_INTERES_MAX'],
        'TBK_ORDEN_COMPRA' => $_POST['TBK_ORDEN_COMPRA'],
        'TBK_RESPUESTA' => $_POST['TBK_RESPUESTA'],
        'TBK_MONTO' => $_POST['TBK_MONTO']);


    	#sendMail("jdomazos@reifschneider.cl", "Reifstore", "POST_DATA " . $TBK_ORDEN_COMPRA, "Contenido Arreglo:  " . $_POST['TBK_FECHA_TRANSACCION']. ", ". $secretKey4Sale.", ". $_POST['TBK_HORA_TRANSACCION'].", ".$_POST['TBK_CODIGO_AUTORIZACION'].", ".$_POST['TBK_FINAL_NUMERO_TARJETA'].", ".$_POST['TBK_ID_TRANSACCION'].", ".$_POST['TBK_TIPO_PAGO'].", ".$_POST['TBK_NUMERO_CUOTAS'].", ".$_POST['TBK_TASA_INTERES_MAX'].", ". $_POST['TBK_ORDEN_COMPRA'].", ".$_POST['TBK_RESPUESTA'].", ".$_POST['TBK_MONTO']);


    $result = null;

    /****************REVISA APROBACION DE TRANSACCION DE WEBPAY SI $trs_respuesta=0 ***********/
    $theValue = ($trs_respuesta == 0) ? "ACEPTADO" : "RECHAZADO";
    
	if ($theValue == "RECHAZADO") {
        # No aceptado por WebPay Test Mail
        #sendMail("jdomazos@reifschneider.cl", "Reifstore", "NO aceptado por webpay " . $TBK_ORDEN_COMPRA, "NO aceptado por webpay " . $TBK_ORDEN_COMPRA);
    }
    
	
    if ($theValue == "ACEPTADO") 
	{
       
		if ($TBK_ORDEN_COMPRA > 60000000)
		{
			# New Reifstore 2014
			
			#sendMail("jdomazos@reifschneider.cl", "Reifstore CM", "Entro IF CyberMonday " . $TBK_ORDEN_COMPRA, "NO Hago POST, copio lo de fuji " . $TBK_ORDEN_COMPRA);
			
			#################################################################################################################
			
			if (validar_mac()) 
			{
			
				#sendMail("jdomazos@reifschneider.cl", "Reifstore New", "Mac Validada " . $TBK_ORDEN_COMPRA, "Mac Validada " . $TBK_ORDEN_COMPRA);
				
				$result = post_request('http://200.72.16.53/modules/webpay/valida.php', $post_data);
				
				$theValue = $result['content'];
				
				if ($theValue == "RECHAZADO") 
				{
					#sendMail("jdomazos@reifschneider.cl", "Reifstore CM", "RECHAZADO " . $_POST['TBK_ORDEN_COMPRA'], "Montos no Coinciden " . $_POST['TBK_ORDEN_COMPRA']);
					echo "RECHAZADO";
				}

			} 
			else 
			{
				#sendMail("jdomazos@reifschneider.cl", "Reifstore CM", "RECHAZADO PARAMETROS VALIDA_MAC(): " . $TBK_ORDEN_COMPRA, "RECHAZADO YA QUE FALTAN PARAMETROS");
				$theValue = "RECHAZADO";
			}
	
			#################################################################################################################
			
		}
		else
		{
			#sendMail("jdomazos@reifschneider.cl", "Reifstore", "Entro ELSE Reifstore " . $TBK_ORDEN_COMPRA, "Hago POST a validation.php " . $TBK_ORDEN_COMPRA);
			
			if (validar_mac()) 
			{
			
				$result = post_request('http://200.72.16.53/tienda/modules/webpay/validation.php', $post_data);
		
				$theValue = $result['content'];
				#sendMail("jdomazos@reifschneider.cl", "Reifstore", "Pasando compra " . $_POST['TBK_ORDEN_COMPRA'], "Revisando montos ($theValue = ".$theValue.")" . $_POST['TBK_ORDEN_COMPRA']);
				
				if ($theValue == "RECHAZADO") 
				{
					#sendMail("jdomazos@reifschneider.cl", "Reifstore new", "RECHAZADO " . $_POST['TBK_ORDEN_COMPRA'], "Montos no Coinciden " . $_POST['TBK_ORDEN_COMPRA']);
					echo "RECHAZADO";
				}
			}
			else 
			{
				#sendMail("jdomazos@reifschneider.cl", "Reifstore", "RECHAZADO PARAMETROS VALIDA_MAC(): " . $TBK_ORDEN_COMPRA, "RECHAZADO validar_mac()");
				$theValue = "RECHAZADO";
			}
				
		}
    }
	
	if ($theValue == "ACEPTADO") 
	{
		#sendMail("jdomazos@reifschneider.cl", "Reifstore new", "Checking MAC " . $_POST['TBK_ORDEN_COMPRA'], "Checking MAC " . $_POST['TBK_ORDEN_COMPRA']);
		echo "ACEPTADO";
	}
	else 
	{
		echo "ACEPTADO"; # ojo pero no a pagado, lo enviara a la pagina de fracaso
	}
	
} 
else 
{
    if ($TBK_ORDEN_COMPRA > 1000000) 
	{ 
		# Reifstore Joomla (Ya no se utiliza)
        #sendMail("jdomazos@reifschneider.cl", "Reifstore Old", "Pasando compra " . $TBK_ORDEN_COMPRA, "Pasando compra " . $TBK_ORDEN_COMPRA);
        include("reifstore_webpay_tx_compra.php");
    } 
	else
    { 
		# Fuji
        #sendMail("jdomazos@reifschneider.cl", "Fuji", "Pasando compra " . $TBK_ORDEN_COMPRA, "Pasando compra " . $TBK_ORDEN_COMPRA);

        if (validar_mac()) 
		{
			
	    	#sendMail("jdomazos@reifschneider.cl", "Fuji", "Mac Validada " . $TBK_ORDEN_COMPRA, "Mac Validada " . $TBK_ORDEN_COMPRA);
			
            $mktime 	= mktime();
            $datetime 	= date("Y-m-d H:i:s", $mktime);

            
            $codigo_compra 			= trim($TBK_ORDEN_COMPRA);
            $codigo_autorizacion 	= trim($TBK_CODIGO_AUTORIZACION);
            $num_cuotas 			= trim($TBK_NUMERO_CUOTAS);
            $tipo_pago 				= trim($TBK_TIPO_PAGO);
            $codigo_verificacion 	= trim($TBK_FINAL_NUMERO_TARJETA);
            $TBK_MONTO 				= substr($TBK_MONTO, 0, -2);
			
            //limpiamos c�digo de verificaci�n
            $resto = substr($codigo_verificacion, -1);
            
			if (ord($resto) == "20")
                $codigo_verificacion = substr($codigo_verificacion, 0, -1);


            if ($tipo_pago == "VC") {
                $tipo_pago = "Cuotas";
            } elseif ($tipo_pago == "VN") {
                $tipo_pago = "Contado";
            } elseif ($tipo_pago == "SI") {
                $tipo_pago = "Cuotas";
            }
			
			#sendMail("jdomazos@reifschneider.cl", "Fuji", "Parametros " . $TBK_ORDEN_COMPRA, "codigo_compra: " . $codigo_compra."\n codigo_autorizacion: ".$codigo_autorizacion."\nnum_cuotas: ".$num_cuotas."\ntipo_pago: ".$tipo_pago."\ncodigo_verificacion: ".$codigo_verificacion."\n TBK_MONTO: ".$TBK_MONTO);
		
		
			
            if ($codigo_compra != "" && $codigo_autorizacion != "") 
			{
				
				#sendMail("jdomazos@reifschneider.cl", "Fuji", "If " . $TBK_ORDEN_COMPRA, "hay codigo_compra y hay codigo_verificacion");
				
				
				$conexion_fuji 	= mysql_pconnect("192.168.100.9", "webfuji", "");
				$sel_fuji 		= mysql_select_db("fujifilm", $conexion_fuji);
				
                $query_fuji 	= mysql_query("select codigo_autorizacion from transbank_autorizacion where codigo_compra='$codigo_compra'", $conexion_fuji);
				#sendMail("jdomazos@reifschneider.cl", "Fuji", "CONEXION FUJIFILM " . $TBK_ORDEN_COMPRA, "Error Mysql cod_autorizacion: ".mysql_error());
                
				$cursor 		= mysql_num_rows($query_fuji);

                if ($cursor > 0) 
				{
					# RECHAZADO YA QUE TIENE CODIGO DE AUTORIZACION PREVIA
                    echo "RECHAZADO";
					#sendMail("jdomazos@reifschneider.cl", "Fuji", "Rechazado " . $TBK_ORDEN_COMPRA, "RECHAZADO YA QUE TIENE CODIGO DE AUTORIZACION PREVIA");
                } 
				else 
				{
               
					$conexion_reifo = mysql_pconnect("192.168.100.9", "webreifo", "");
					$sel_reifo 		= mysql_select_db("reifschneider", $conexion_reifo);
                    $query_reifo 	= mysql_query("SELECT total FROM compras WHERE id_orden='$codigo_compra' ", $conexion_reifo);
                    
					
					#sendMail("jdomazos@reifschneider.cl", "Fuji", "CONEXION REIFO " . $TBK_ORDEN_COMPRA, "Error Mysql cursor: ".mysql_error());
                    
					$rows = mysql_num_rows($query_reifo);
					
                    if ($rows > 0) 
					{
						$result_reifo = mysql_fetch_array($query_reifo);
                        $total_compra = $result_reifo["total"];
                    } 
					else 
					{
                        $total_compra = 0;
                    }
					
					#sendMail("jdomazos@reifschneider.cl", "Fuji", "total compra " . $TBK_ORDEN_COMPRA, "total_compra: ".$total_compra);
					
                    if (intval($total_compra) != intval($TBK_MONTO)) 
					{
						# RECHAZADO YA QUE LOS MONTOS DE LA COMPRA NO COINCIDEN
                        echo "RECHAZADO";
						#sendMail("jdomazos@reifschneider.cl", "Fuji", "RECHAZADO 160 " . $TBK_ORDEN_COMPRA, "RECHAZADO YA QUE LOS MONTOS DE LA COMPRA NO COINCIDEN");
                    } 
					else 
					{
                        $sql = "INSERT INTO transbank_autorizacion (codigo_compra,codigo_autorizacion,fecha,tipo_pago,num_cuotas,codigo_verificacion)";
                        $sql .= " VALUES ('$codigo_compra', '$codigo_autorizacion', now(), '$tipo_pago', '$num_cuotas', '$codigo_verificacion')";
                        
						$query_fuji_2 = mysql_query($sql, $conexion_fuji);
						
						#sendMail("jdomazos@reifschneider.cl", "Fuji", "INSERT TRANSBANK_AUTORIZACION " . $TBK_ORDEN_COMPRA, "Error: ".mysql_error());
                        echo "ACEPTADO";
						#sendMail("jdomazos@reifschneider.cl", "Fuji", "ACEPTADO " . $TBK_ORDEN_COMPRA, "ACEPTADO");
                        
                    }
                }

            } 
			else 
			{
				# RECHAZADO YA QUE FALTAN PARAMETROS
                echo "RECHAZADO";
				#sendMail("jdomazos@reifschneider.cl", "Fuji", "RECHAZADO PARAMETROS VALIDA_MAC(): " . $TBK_ORDEN_COMPRA, "RECHAZADO YA QUE FALTAN PARAMETROS");
            }


        }

    }
}


# fin if que desvio 0 < fujifilm <1000000 < restore  intervalos de logicas para cada tienda

if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data, $file_append = false)
    {
        $fp = fopen($filename, (!$file_append ? 'w+' : 'a+'));
        if (!$fp) {
            trigger_error('file_put_contents cannot write in file.', E_USER_ERROR);
            return;
        }
        fputs($fp, $data);
        fclose($fp);
    }
}

function validar_mac()
{ // Esta funcion chequea la mac y parametros
    $cgi_bin = "/usr/local/apache2/cgi-bin";
    $log = "$cgi_bin/log/log${_POST['TBK_ID_TRANSACCION']}.txt";
    $fp = fopen($log, "w");
    reset($_POST);
    while (list($key, $val) = each($_POST)) {
        fwrite($fp, "$key=$val&");
    }
    fclose($fp);
    //$parametro = "$cgi_bin/log/log${_POST['TBK_ID_TRANSACCION']}.txt";
    //$comando =   "$cgi_bin/tbk_check_mac.cgi $parametro";
    $comando = "$cgi_bin/tbk_check_mac.cgi $log";
    exec($comando, $resultado, $retornoint);
    if ($resultado[0] == 'CORRECTO') {
        return true;
    } else {
        return false;
    }
}

function sendMail($para, $empresa, $titulo, $mensaje)
{
    $titulo = "[WebPay] - [" . $empresa . "] - " . $titulo;
    $cabeceras = 'From: informatica@reifschneider.cl' . "\r\n" .
                 'Reply-To: no-reply@reifschneider.cl' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
    @mail($para, $titulo, $mensaje, $cabeceras);
}

function post_request($url, $data, $referer='') {

    // Convert the data array into URL Parameters like a=b&foo=bar etc.
    $data = http_build_query($data);

    // parse the given URL
    $url = parse_url($url);

    if ($url['scheme'] != 'http') {
        die('Error: Only HTTP request are supported !');
    }

    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];

    // open a socket connection on port 80 - timeout: 30 sec
    $fp = fsockopen($host, 80, $errno, $errstr, 30);

    if ($fp){

        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");

        if ($referer != '')
            fputs($fp, "Referer: $referer\r\n");

        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);

        $result = '';
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
    }
    else {
        return array(
            'status' => 'err',
            'error' => "$errstr ($errno)"
        );
    }

    // close the socket connection:
    fclose($fp);

    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);

    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';

    // return as structured array:
    return array(
        'status' => 'ok',
        'header' => $header,
        'content' => $content
    );
}

function http_build_query( $formdata, $numeric_prefix = null, $key = null ) {
   $res = array();
   foreach ((array)$formdata as $k=>$v) {
       $tmp_key = urlencode(is_int($k) ? $numeric_prefix.$k : $k);
       if ($key) {
           $tmp_key = $key.'['.$tmp_key.']';
       }
       if ( is_array($v) || is_object($v) ) {
           $res[] = http_build_query($v, null, $tmp_key);
       } else {
           $res[] = $tmp_key."=".urlencode($v);
       }
   }
   return implode("&", $res);
}

?>
