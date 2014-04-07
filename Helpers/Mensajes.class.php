<?PHP 
/**
 * Helper para manejo de mensajes dentro de la aplicación
 * 
 * Las variables de session para mensajes dentro del jida-framework son:
 * <ul>
 * <li><b>__msjForm</b> Para mensajes en la clase formulario</li>
 * <li><b>__msj </b> Para mensajes en la clase vista y donde se desee.</li>
 * existentes 
 * @package framework
 * @category helper
 * @author  Julio Rodriguez 
 * @version 0.1 12/01/2014
 */
class Mensajes {
	
	
    
	function __construct(){
		
	}//final constructor
	/**
     * Define un arreglo con los valores css para los mensajes
     * 
     * Las clases css a aplicar deben estar definidas en las constantes
     * usadas.
     */
	static function obtenerEstiloMensaje($clave){
	    try{
	        
	    $estilo=array();
        // if(defined(cssMsjError) and defined(cssMsjAlerta) 
        // and defined(cssMsjSucess) and defined(cssMsjInformacion)){
            $estilo['error']=cssMsjError;
            $estilo['alerta']=cssMsjAlerta;
            $estilo['suceso']=cssMsjSuccess;
            $estilo['informacion']=cssMsjInformacion;    
        // }else{
            // $excepcion = "No se encuentran definidas las constantes css para los mensajes, verifique
            // el archivo de configuración";
            // throw new Exception($excepcion, 1);
        // }
        
        return $estilo[$clave];
        }catch(Exception $e){
            controlExcepcion($e->getMessage(),$e->getCode());
        }
	}
	
	static function mensajeError($mensaje){
	   $css = self::obtenerEstiloMensaje('error');
       $mensaje = "
                    <DIV class=\"$css\">
                    <button type=\"button\" class=\"close pull-right\" aria-hidden=\"true\">&times;</button>
                        $mensaje
                    </DIV>";
        return $mensaje;
        
	}
    
    static function mensajeAlerta($mensaje){
       $css = self::obtenerEstiloMensaje('alerta');
       $mensaje = "
                    <DIV class=\"$css\">
                    <button type=\"button\" class=\"close pull-right\" aria-hidden=\"true\">&times;</button>
                        $mensaje
                    </DIV>";
        return $mensaje;
        
    }
    
    static function mensajeSuceso($mensaje){
       $css = self::obtenerEstiloMensaje('suceso');
       $mensaje = "
                    <DIV class=\"$css\">
                        <button type=\"button\" class=\"close pull-right\" aria-hidden=\"true\">&times;</button>
                        $mensaje
                    </DIV>";
        return $mensaje;
      
    }
    
    static function mensajeInformativo($mensaje){
       $css = self::obtenerEstiloMensaje('informacion');
       $mensaje = "
                    <DIV class=\"$css\">
                        <button type=\"button\" class=\"close pull-right\" aria-hidden=\"true\">&times;</button>
                        $mensaje
                    </DIV>";
        return $mensaje;
        
    }
    /**
     * Imprime un mensaje si existe
     */
    static function imprimirMensaje($msj=""){
        if(empty($msj)){
            if(isset($_SESSION['__msj'])){
                $msj = $_SESSION['__msj']; 
            }else{
                $msj="";
            }
        }
        
        echo $msj;
    }
    /**
     * Imprime el mensaje guardado en la variable de sesion "__msj"
     * 
     */
    static function imprimirMsjSesion($msj="__msj"){
       if(isset($_SESSION[$msj])){ 
            echo $_SESSION[$msj];
            Session::destroy($msj);
        }
    }
    
    static function msjExcepcion($msj,$ruta){
        $_SESSION['__excepcion'] = $msj;
        echo $_SESSION['__excepcion'];
  //      redireccionar($ruta);
    }
} // END

?>