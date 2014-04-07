<?PHP 
/**
 * Controlador de Session de la aplicación
 *
 * @package framework
 * @category core
 * @author  Julio Rodriguez <jirc48@gmail.com>
 * @version 0.1.0 02/01/2014
 */
class Session {
	
	/**
	 * 
	 */
	var $something;
	
	/**
	 * 
	 */
	function __construct(){
		
	}//final constructor
	/**
     * Inicia una nueva sesión.
     * @method iniciarSession
     * @access public
     */
	
	static function iniciarSession(){
	    session_start();
        Session::set('__idSession', self::getIdSession());
	}
    /**
     * Retorna el id de la sessión
     */
    static function getIdSession(){
        return session_id();
    }
    /**
     * Elimina una variable de sesón o la session completa
     * 
     * Si es pasado un key se elimina una variable especifica,
     * caso contrario se elimina la session completa
     * @var $key clave o arreglo de claves de variable de session que se desea eliminar
     * @method cerrarSession
     * @access public
     */
    
    static function destroy($key=false){
        if($key){
            if(is_array($key)){
                foreach ($key as $clave) {
                    if(isset($_SESSION[$clave])){
                        unset($_SESSION[$clave]);
                    }
                }
            }else{
                if(isset($_SESSION[$key])){
                   unset($_SESSION[$key]);
                }
            }
        }else{
            session_destroy();
            session_unset();
        }
    }
    
    /**
     * Registra el inicio de una sesion loggeada
     * cambiando el id de la sesion.
	 * @method SessionLogin
	 * @access static public
     */
    static function sessionLogin(){
        Session::destroy('acl');
        Session::set('isLoggin',TRUE);
        session_regenerate_id();
        Session::set('__idSession', self::getIdSession());
    }
    
    /**
     * Modifica o crea una variable existente
     * @method set
     * @access public
     * @var string $clave key de la variable de sesion
     * @var string $param2 Valor de la variable a crear o modificar
     * @var string $param3 Si es pasado, el parametro dos será tomado como una segunda clave de la variable de sessión
     * y este será el valor de la variable.
     */
    static function set($clave,$param2,$param3=""){
        if(!empty($param3)){
            
            $_SESSION[$clave][$param2]=$param3;
            
        }else
        if(!empty($clave)){
            $_SESSION[$clave] = $param2;
        }
    }
    /**
     * Genera una nueva variable de sesión
     * @method get
     * @access public
     * @param string clave key de la variable de session a obtener
     */
	static function get($clave,$clave2="") {
        
        if(!empty($clave2) and isset ( $_SESSION [$clave][$clave2] )){
            return $_SESSION [$clave][$clave2];
        }else 
        if (isset ( $_SESSION [$clave] )) {
            return $_SESSION [$clave];
        }else{
            return false;
        }
    }
    
    
    /**
     * Verifica si el usuario actual tiene sesión iniciada
     * en el sistema
     * 
     * @return boolean true
     */
    static function checkLogg(){
        
    }
    
    /**
     * Verifica si el usuario actual pertenece al $perfil
     * requerido o uno superior
     * 
     * @param int $perfil Id del perfil requerido
     * @return boolean $acceso  
     */
    static function checkAcceso($perfil){
        
    }
    /**
     * Verifica que el usuario actual tenga exactamente el mimso perfil
     * que el perfil requerido
     */
    static function checkAccesoUnico(){
        
    }
} // END

?>