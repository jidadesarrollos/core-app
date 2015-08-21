<?php
/**
 * Archivo de Arranque de la aplicación
 * 
 * Ejecuta las configuraciones requeridas para que una 
 * aplicación arranque correctamente.
 * 
 * 
 * @author Julio Rodriguez <jirc48@gmail.com>
 * @package Framework
 * @category bootstrap 
 */


/**
 * Incluir archivo de configuración de Base de datos
 */

include_once 'Helpers/FuncionesBasicas.php';
set_time_limit(180);
/**
 * Directorio del directorio de aplicación.
 */
define ('app_dir', ROOT. 'Aplicacion'.DS);

/**
 * Directorio del directorio del framework
 */
define ('framework_dir', ROOT . 'Framework' . DS);
define ('DIR_FRAMEWORK',ROOT.'Framework'. DS );
define ('DIR_APP', ROOT . 'Aplicacion'. DS );

define ('libs_dir', ROOT . 'libs' . DS);

/**
 * Directorio publico de HTDOCS completo
 * 
 * Usada para manejo interno en busqueda de archivos.
 */
define ('HTDOCS_DIR',ROOT.'htdocs/');

define('htdocs_dir',HTDOCS_DIR);
/**
 * @constante dev Deterimina si el sistema se entorno de desarrollo
 */
define('dev','dev');
/**
 * @constante prod Constante definida para determinar el sistema en entorno de producción
 */
define('prod','prod');
 
if(function_exists('ini_set')){
	/**
	 * Inclusión de directorios de aplicación, framework y libs dentro del path
	 */
	ini_set('include_path',app_dir . PS . framework_dir .PS . libs_dir . PS . get_include_path());
}else{
	echo "<h5>No existe la funci&oacute;n</h5>";
}

if(!defined('TEST_PLATFORM')){
	define('TEST_PLATFORM',false);
}
if(TEST_PLATFORM==TRUE){
	
	TestPlataforma();
}

#=======================================================================
#=======================================================================
#=======================================================================
/**
 * Se incluye el archivo de configuración por defecto
 */
include_once 'Settings/jidaConfiguracion.php';
/**
 * Incluir archivo de configuración general del framework
 */

include_once 'Config/BDConfig.php';
include_once 'Config/initConfig.php';
include_once 'Config/appConfig.php';
include_once 'Settings/jConstantes.php';
#=======================================================================
#=======================================================================
#=======================================================================
/**
 * Manejo de Errores
 * 
 */
if(ENTORNO_APP == 'dev'){
	/* True */
    ini_set("display_errors", 1);
    ini_set("track_errors", 1);
    ini_set("html_errors", 1);
    error_reporting(E_ALL);
}else{
    /* False */
    ini_set("display_errors", 0);
    ini_set("track_errors", 0);
    ini_set("html_errors", 0);
    error_reporting(0);	
}


include_once 'Core/Autoload.class.php';
#Carga de clases automaticamente
Autoload::init();
Session::iniciarSession();
?>