<?php
/**
 * Validador de Controles de Formulario
 *
 * Basado en realizar las validaciones del Plug-in "validadorJida.js" a nivel del Servidor
 * @author Julio Rodriguez <jirodriguez@sundecop.gob.ve>
 * Fecha : 28/10/2013
 * @version 1.7.1 05/04/2014
 */

class ValidadorJida {
    /**
     * @var array $validaciones Arreglo opcional con parametros de la validación
     */
    private $validaciones = array();
    /**
     * @var string $valorCampo Registra el valor del campo a validar
     */
    private $valorCampo;
    /**
     * @var string $mensajeError Guarda el String del mensaje de Error
     */
    private $mensajeError="";
    /**
     * @var array $validacionesDefault Valores por defecto para las validaciones;
     * @deprecated
     */
    private $validacionesDefault;
    /**
     * @var array $expresiones Arreglo con las expresiones disponibles para validar
     */
    private $expresiones;
    /**
     * @var boolean $error indica si existe un error en el campo 0 no 1 existe.
     */
    private $error;
    /**
     * @var array $campo Arreglo con todos los datos del campo
     */
    private $campo;
    
    private $mensajesDefecto=array();
    /**
     * Registro de opciones del Campo
     */
    private $opciones ="";
    /**
     * Arreglo asociativo con validaciones y mensajes de error
     * @var array dataValidaciones
     */
    private $dataValidaciones=array();
    
    /**
     * Constructor de la clase Validador Jida
     * @param string $campo Campo a validar
     * @param array $validaciones Arreglo con validaciones asignadas al campo
     * @opciones string $opciones [opcional] Las opciones asociadas al campo a validar
     */
    function __construct($campo, $validaciones,$opciones="") {
        $this -> campo = $campo;
                
        $this->getDataValidaciones();
        $this -> validaciones = array_merge($this -> validacionesDefault,$validaciones);
    }//fin funcion
    
    
    /**
     * Devuelve el arreglo con todas las validaciones existentes y los mensajes por defecto para cada
     * una de ellas
     * @method getDataValidaciones
     * @access private
     * @return array $dataValidaciones
     */
    private function getDataValidaciones(){
        $this -> validacionesDefault = 
            array(
                    'numerico' => false,
                    'obligatorio' => false,
                    'decimal' => false,
                    'caracteres' => false,
                    'alfanumerico'=>false,
                    'programa'=>false,
            );
        $this->dataValidaciones=
            array(
                    'numerico'      =>array("expresion" =>  "/^(?:\+|-)?\d+$/",
                                            "mensaje"   =>  "Debe ser numerico"),
                    'obligatorio'   =>array("expresion" =>  "",
                                            "mensaje"   =>  "Es Obligatorio"),
                    'decimal'       =>array("expresion" =>  "/^([0-9])*[.]?[0-9]*$/",
                                            "mensaje"   =>  "Debe ser decimal y los decimales deben estar separados por coma"),
                    'caracteres'    =>array("expresion" =>  "/^[A-ZñÑa-záéíóúÁÉÍÓÚ ]*$/",
                                            "mensaje"   =>  "solo puede contener caractares"),
                    'alfanumerico'  =>array("expresion" =>  "/^[\dA-ZñÑa-záéíóúÁÉÍÓÚ., ]*$/",
                                            "mensaje"   =>  "no puede contener caracteres especiales"),
                    'programa'      =>array("expresion" =>  "/^[\/\.A-Za-z_-\d]*$/",
                                            "mensaje"   =>  "Solo puede poseer caracteres alfanumericos,underscore o guion"),
                    'email'         =>array("expresion" =>  "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/",
                                            "mensaje"   =>  "El formato del email no es valido"),
                    'telefono'      =>array("expresion" =>  "/^2[0-9]{9,13}$/",
                                            "mensaje"   =>  "El formato del telefono debe ser 212 4222211"),
                    'celular'       =>array("expresion" =>  "/^(412|416|414|424|426)\d{7}$/",
                                            "mensaje"   =>  "El formato del celular debe ser 4212 4222211"),
                    'coordenada'    =>array("expresion" =>  "/^\-?[0-9]{2}\.[0-9]{3,15}/",
                                            "mensaje"   =>  "La coordenada debe tener el siguiente formato"),
                    'contrasenia'   =>array("expresion" =>  "",
                                            "mensaje"   =>  "Debe cumplir con las especificaciones establecidas."),
                    'internacional' =>array("expresion" =>  "/^[0-9]{9,18}$/",
                                            "mensaje"   =>  "El telefono internacional no es valido"),
                    'minuscula'     =>array("expresion" =>  "/[a-z]/",
                                            "mensaje"   =>  "El telefono internacional no es valido"),
                    'mayuscula'     =>array("expresion" =>  "/[A-Z]/",
                                            "mensaje"   =>  "El telefono internacional no es valido"),
                    'numero'        =>array("expresion" =>  "/[0-9]/",
                                            "mensaje"   =>  "El telefono internacional no es valido"),
                    'caracteresEsp' =>array("expresion" =>  "/(\||\!|\"|\#|\$|\%|\&|\/|\(|\)|\=|\'|\?|\<|\>|\,|\;|\.|\:|\-|\_|\*|\~|\^|\{|\}|\+)/",
                                            "mensaje"   =>  "El campo debe contener alg&uacute;n caracter especial"),
                    'twitter'       =>array("expresion" =>  "/^[A-Za-z0-9._-]*$/",
                                            "mensaje"   =>  "Formato de twitter incorrecto"),
                    "url"           =>array("expresion" =>  "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/",
                                            "mensaje"   =>  "El formato de la URL no es correcto"),
                    
                    "seguridadComillas"     =>array("expresion" =>  "(([A-Za-z0-9])*\'([A-Za-z0-9])*|\'([A-Za-z0-9])*|([A-Za-z0-9])*\')",
                                                    "mensaje"   =>  ""/*NO PUEDEN HABER DOS COMILLAS SIMPLES EN EL MISMO CAMPO '' */),
                    "seguridadComentario"   =>array("expresion" =>  "([A-Za-z0-9\|\!\"\#\$\%\&\(\)\=\?\<\>\,\;\.\:\-\_\~\^\{\}\+\*]|\/[A-Za-z0-9\|\!\"\#\$\%\&\/\(\)\=\?\<\>\,\;\.\:\-\_\~\^\{\}\+])*/?",
                                                    "mensaje"   =>  ""/*NO PUEDE HABER UN COMENTARIO EN EL CAMPO /* */),
                    "seguridadGuiones"      =>array("expresion" =>  "/^([A-Za-z0-9\._]|\-[A-Za-z0-9\._])*\-?$/",
                                                    "mensaje"   =>  ""/*NO PUEDEN HABER DOS GUIONES CONSECUTIVOS --*/),
                    "fecha"                 =>array("expresion" => "/^\d{2,4}[\-|\/]{1}\d{2}[\-|\/]{1}\d{2,4}$/",
                                                    "mensaje"   => 'El formato de fecha debe ser dd-mm-yyyy'),
                    "limiteCaracteres"      =>array("mensaje"=>"La cadena no puede superar el total de caracteres permitidos"),
                    "documentacion"         =>array("mensaje"=>"El campo debe tener el siguiente formato J-18935170",
                                                    "expresion"=>"/^([V|E|G|J|P|N]{1}\d{8,10})*$/",),
                    
                );
    }//fin funcion getDataValidaciones()
  
    

    /**
     * Verifica si una cadena tiene el formato requerido
     *
     * Valida si la cadena cumple con el formato requerido por medio
     * de una expresión regular.

     * @param String $validacion Nombre de la validación a aplicar.
     * @param array $datosValidacion Arreglo con inf. de la validacion
     * @return boolean True Si es correcto, fal
     */
    private function validarCadena($nombreValidacion, $datosValidacion) {
        
        if($nombreValidacion=="decimal" or $nombreValidacion=="numerico"){
            
            $this->valorCampo = str_replace(".","",$this->valorCampo);
            $this->valorCampo = str_replace(",",".",$this->valorCampo);
            
        }
        
        if($this -> dataValidaciones[$nombreValidacion]["expresion"]!=""){
            
        }else{
           throw new Exception("Se llama a una expresion $nombreValidacion, la cual se encuentra indefinida", 1);
            
        }
        if (preg_match($this -> dataValidaciones[$nombreValidacion]["expresion"], $this -> valorCampo)) {
            /**
             * En caso de que sea decimal o numerico se reemplaza el valor formateado por el requerido 
             * para el registro en base de datos
             */
                if(array_key_exists($this->campo['name'], $_POST)){
                    $_POST[$this->campo['name']] = $this->valorCampo;
                }
            return true;
        } else {
            
            $this->obtenerMensajeError($nombreValidacion,$datosValidacion);
            return false;
        }
    }
    /**
     * Obtiene el mensaje de error configurado para el campo
     * @obtener mensaje de error
     */
    private function obtenerMensajeError($validacion,$datos){
        
        if(isset($datos['Mensaje'])){
            $this->mensajeError = $datos['Mensaje'];
        }else{
            $this->mensajeError = "El campo ".$this->campo['label'] ." ".$this->dataValidaciones[$validacion]["mensaje"];
        }
    }
    /**
     * Valida un campo
     *
     * Funcion controladora que verifica las validacionesexit
     *  que debe tener un campo
     * @param string $campo Campo a validar
     */
    function validarCampo($campo) {

        $this->valorCampo =& $campo;
        
        //En caso de haber un error la variable bandera debe ser modificada a 1.
        $bandera = 0;
        $valorLleno = $this -> validarCampoLleno();
        
        //El valor es identico a true si el campo tiene algun valor
        if ($valorLleno !== true and $this -> validaciones['obligatorio'] != false) {
            
            $datosObl = $this -> validaciones['obligatorio'];
            $bandera = 1;
            $this -> mensajeError = $datosObl['mensaje'];
            
        } elseif ($valorLleno === true) {
            unset($this->validaciones['obligatorio']);
            
            foreach ($this->validaciones as $validacion => $detalle) {
                $CheckValor = false;
                $validacion = strtolower($validacion);
                
                if ($bandera == 0 and (is_array($detalle) or $detalle == true)) {
                   
                    switch ($validacion) {
                        case "obligatorio" :
                            $nada="";
                            break;
                        
                        case "telefono" :
                            $CheckValor = $this->validarTelefono($validacion,$detalle);
                            break;
                            
                        case "contrasenia" :
                            $CheckValor = $this->validarContrasenia($validacion,$detalle);
                            break;
                        case "fecha" :
                            $CheckValor = $this->validarFecha($validacion,$detalle);
                            break;
                        case "tiny":
                            $CheckValor = $this->validartiny($validacion,$detalle);
                            break;
                        case "limitecaracteres":
                            $CheckValor = $this->limiteCaracteres($validacion,$detalle);
                            break;
                        default :
                            $CheckValor = $this->validarCadena($validacion, $detalle);
                            break;
                    }

                    if ($CheckValor!==true) {
                        $bandera = 1;
                     
                    }
                }
            }//fin foreach
       
        }//fin elseif ($valorLleno === true)
        if ($bandera == 0) {
            return array('validacion'=>true,'campo'=>$this->valorCampo);
        } else {
            return array('validacion'=>$this->mensajeError,'campo'=>$this->valorCampo);    
            
        }

    }//fin validarCampo

    /**
     * Valida un campo obligatorio
     */
    private function validarCampoLleno(){
        
        $validacion = true;
        
        if(array_key_exists('obligatorio', $this->validaciones) and is_array($this->validaciones['obligatorio']) and array_key_exists('condicional',$this->validaciones['obligatorio'])){
            
            if($_POST[$this->validaciones['obligatorio']['condicional']]==$this->validaciones['obligatorio']['condicion']){
                $validacion = true;
            }else{
                $validacion=false;
            }
        }
        
        if($validacion===true){
            if($this->valorCampo != ""){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }

    }
    /**
     * Valida un campo del editor de texto TINY
     */
    private function validarTiny($validacion,$detalle){
        if(array_key_exists('obligatorio', $detalle)){
            return $this->validarCampoLleno();
        }else{
            return true;
        }
    }
    
    private function validarDocumentacion($validacion,$detalle){
        $valor =$this->valorCampo;
        if(array_key_exists('campo_codigo', $detalle)):
            $valor = $_POST[$this->campo['name']."-tipo-doc"].$this->valorCampo;
        endif;
        
        return $this->validarCadena('documentacion', $this->valorCampo);
    }
    private function validarTelefono($validacion,$detalle){
        
        
        $code =(array_key_exists("code",$detalle))?$detalle['code']:false;
        $ext =(array_key_exists("ext",$detalle))?$detalle['ext']:false;
        $detalle['tipo']=(array_key_exists("tipo",$detalle))?$detalle['tipo']:"telefono";
        $todalDigitos=($ext)?14:10;
        $valorCodigo = (isset($_POST[$this->campo['name']."-codigo"]))?$_POST[$this->campo['name']."-codigo"]:"";
        $valorExt = (isset($_POST[$this->campo['name']."-ext"]))?$_POST[$this->campo['name']."-ext"]:"";
        
        $valorTelefono = $valorCodigo.$this->valorCampo.$valorExt;
        
        $expTlf=$this->dataValidaciones['telefono']['expresion'];
        $expCel=$this->dataValidaciones['celular']['expresion'];
        $expInter=$this->dataValidaciones['internacional']['expresion'];
        $validacionTlf =(preg_match($expTlf,$valorTelefono))?1:0;
        $validacionCel =(preg_match($expCel,$valorTelefono))?1:0;
        $validacionInter = (preg_match($expInter,$valorTelefono))?1:0;
        
        if( array_key_exists('tipo',$detalle) and
                ($detalle['tipo']=='telefono' and $validacionTlf==1 or
                    $detalle['tipo']=='celular' and $validacionCel==1 or
                    $detalle['tipo']=='internacional' and $validacionInter==1 or
                    $detalle['tipo']=="multiple" and ($validacionCel==1 or $validacionTlf==1)) or
                     
                !array_key_exists('tipo',$detalle) and $validacionTlf==1){
                    
                    return true;
                }else{
                    $this->obtenerMensajeError($detalle['tipo'], $detalle);
                    return false;
                }
    }
    
    /**
     * Valida un campo de contraseña segura
     * @method validarContrasenia
     * @access private
     */
    private function validarContrasenia($validacion,$detalle){

        $contrasenia = $this->valorCampo;
        
        $expMin = $this->dataValidaciones['minuscula']['expresion'];
        $expMay = $this->dataValidaciones['mayuscula']['expresion'];
        $expNum = $this->dataValidaciones['numero']['expresion'];
        $expCaract = $this->expresiones['caracteresEsp'];
        
        $validacionMin =(preg_match($expMin,$contrasenia))?1:0;
        $validacionMay =(preg_match($expMay,$contrasenia))?1:0;
        $validacionNum =(preg_match($expNum,$contrasenia))?1:0;
        $validacionCaract =(preg_match($expCaract,$contrasenia))?1:0;
        
        if($validacionMin == 1 && $validacionMay == 1 && $validacionNum == 1 && $validacionCaract == 1 && strlen($contrasenia) >= 8){
            return true;
        }else{
            $this->obtenerMensajeError('contrasenia', $detalle);
            return false;
        }
    }
    
    /**
     * Valida un campo con formato fecha
     * @method validarFecha
     * @access private
     */
    private function validarFecha($validacion,$detalle){
        
        if($this->validarCadena('fecha', $this->valorCampo)){
            $this->valorCampo=FechaHora::fechaInvertida($this->valorCampo);
            
            return true;
        }else{
            $this->obtenerMensajeError('fecha', $detalle);
            return false;
        }
    }
   private function limiteCaracteres($validacion,$detalle){

        if(strlen($this->valorCampo)>($detalle['limite']+10)){
            $this->obtenerMensajeError($validacion, $detalle);
            return false;
        }else{
            return true;
        }
    }
}//fin Class ValidadorJida
