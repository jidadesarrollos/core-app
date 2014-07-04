<?PHP 
/**
 * Helper para manejo de excepciones
 *
 * @package framework
 * @caregory Helper
 * @author  Julio Rodriguez <jirc48@gmail.com>
 */
class Excepcion {
    
    
    /**
     * 
     */
    static function controlExcepcion(Exception $e,$type=1){
        
        
            if($e instanceof Exception){
                if(defined('entorno_app')){
                    switch (entorno_app) {
                        case 'dev':
                            
                            $msj = '<h3>Error Capturado!</h3><hr>';
                            $msj.="<strong>Mensaje : </strong>".$e->getMessage()."<br>";
                            $msj.="<strong>L&iacute;nea : </strong>".$e->getLine()."<br>";
                            $msj.="<strong>Archivo : </strong>".$e->getFile()."<br>";
                            $msj.="<strong>C&oacute;digo : </strong>".$e->getCode()."<br>";
                            $msj.="<hr/><div style=\"font-size:10px\">Traza</br>";
                            #$msj.="<strong>Traza : </strong>".implode(",",$e->getTrace())."<br>";
                            foreach($e->getTrace() as $key =>$traza){
                                $msj.="<strong>Archivo</strong> ". $traza['file']."<br>";
                                $msj.="<strong>Linea</strong> ".$traza['line']."<br>";
                                $msj.="<strong>Funcion</strong> ".$traza['function']."<br>";
#                                $msj.="<strong>Tipo</strong>".$traza['type']."<br>";
                                #$msj.="<hr>";
                            }
                            $msj.="</div>";
                            
                            
                            // Arrays::mostrarArray($e->getTrace());
                            // echo Mensajes::mensajeError($msj);exit;
                            if($type==1){
                          
                                Mensajes::msjExcepcion(Mensajes::mensajeError($msj),'/excepcion/'); 
                            }elseif($type==2){
                               if(!isset($_SESSION['__msjExcepcion']) or Session::get('__msjExcepcion')!=$e->getMessage()){
                                   
                                    $mensaje = Mensajes::mensajeError($msj);
                                    echo $mensaje;   
                                    Session::set('__msjExcepcion',$e->getMessage());
                               } 
                                 
                                
                            }
                            
                                                 
                            break;
                        case 'prod':
                            self::sendExecpcionMail($e);
                            redireccionar('/excepcion/error500');                            
                            break;
                        
                        default:
                            
                            break;
                    }
                }else{
                    throw new Exception("No se encuentra definido el entorno de la aplicación", 10);
                    
                }
            }else{
                throw new Exception("Ha ocurrido un error grave.", 1);
                
            }
       
        
    }//final constructor
    
    static function controlExcepcionUser(Exception $e){
        $msj.="<h3>Ha ocurrido un error!</h3><hr>";
        $msj.=$e->getMessage();
        return Mensajes::mensajeError($msj);
    }
    
    /**
     * Envia un error capturado via mail
     * @method sendExecpcionMail
     */
    static function sendExecpcionMail(Exception $e){
         $msj = '<h3>Error Capturado!</h3><hr>';
            $msj.="<strong>Mensaje : </strong>".$e->getMessage()."<br>";
            $msj.="<strong>L&iacute;nea : </strong>".$e->getLine()."<br>";
            $msj.="<strong>Archivo : </strong>".$e->getFile()."<br>";
            $msj.="<strong>C&oacute;digo : </strong>".$e->getCode()."<br>";
            $msj.="<hr/><div style=\"font-size:10px\">Traza</br>";
            #$msj.="<strong>Traza : </strong>".implode(",",$e->getTrace())."<br>";
            foreach($e->getTrace() as $key =>$traza){
                $msj.="<strong>Archivo</strong> ". $traza['file']."<br>";
                $msj.="<strong>Linea</strong> ".$traza['line']."<br>";
                $msj.="<strong>Funcion</strong> ".$traza['function']."<br>";
                #$msj.="<hr>";
            }
            $msj.="</div>";
        error_log($msj,1,MAIL_ERROR_APP);
    }
    
} // END

?>