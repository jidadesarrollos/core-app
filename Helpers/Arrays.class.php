<?PHP 

/**
 * Clase Helper de Arreglos
 *
 * @package Framework
 * @subpackage Helpers
 * @author  Julio Rodriguez <jirc48@gmail.com>
 */
class Arrays {
	
	

    /**
     * Recorre un arreglo multidimensional buscando las columnas solicitadas y devuelve
     * un nuevo arreglo solo con esos valores
     * @method getColummnasArray
     * @param array $array Arreglo a recorrer
     * @param array $columnas Arreglo con columnas deseadas
     * @return array $data Arreglo creado solo con los valores solicitados
     */
    static function getColumnasArray($array,$columnas){
        $datos=array();
        foreach ($array as $key => $columna) {
            
        }
        
    }
    
    static function recorrerArray(){}
    
    /**
     * Recorre un array recursivo buscando los valores solicitados
     * 
     * Recorre un arreglo de forma recursiva buscando todos los valores que coincidan
     * con una clave dada y retorna un nuevo arreglo ordenado con las posiciones relacionadas
     * a la clave
     * @param array $arr Arreglo a recorrer
     * @param string $busqueda Nombre o valor a buscar
     * @param string $filtro Campo de filtro en estructura del arreglo
     */
    static function obtenerHijosArray($arr,$busqueda,$filtro){
        $nuevoArreglo = array();
        
        foreach ($arr as $key => $value) {
                if($value[$filtro]==$busqueda){
                    $nuevoArreglo[]=$value;   
                }
                    
        }//fin foreach
        if(is_array($nuevoArreglo)){
            
            //echo "SI<hr>";
        }
        
        if(count($nuevoArreglo)>0){
            //echo "SI again<hr>";
            return $nuevoArreglo;
        }else{
            return false;
        }
        
    }
    /**
     * Devuelve un arreglo con los valores extraidos de un arreglo multidimensional
     * @method obtenerKey
     * @param string $key Clave a buscar en los arreglos u objetos de cada posición del arregloa  buscar
     * @param array $array Arreglo multidimensional a filtrar
     */
    static function obtenerKey($clave,$array){
        $arrayResult = array();
        foreach ($array as $key => $fila) {
            if(is_array($fila)){
                if(array_key_exists($clave, $fila)){
                     
                      $arrayResult[]=$fila[$key];
                }
            }elseif(is_object($fila)){
                if(property_exists($fila, $clave) and !empty($fila->$clave)){
                    $arrayResult[]=$fila->$clave;
                }
            }
                    
        }
        if(count($array)>0){
            return $arrayResult;
        }else{
            return false;
        }
    }
    
    /**
     * Agrega una columna a todos los valores de una matriz
     * @method addColumn
     * @param array $arr Arreglo a modificar
     * @param mixed $valores Arreglo o string de valores a insertar
     * @param boolean $usoKeyValores Si es TRUE se usaran las claves del vector como claves en las nuevas columnas de la matriz
     */
    function addColumna($matriz,$valores,$usoKeyValores=FALSE){
        
        if(is_array($valores)){
            foreach($matriz as $key =>&$vector){
                if(is_string($vector)){
                 $vector = array($vector);   
                }
                foreach($valores as $clave =>$valor){        
                    if($usoKeyValores==TRUE){
                        $vector[$clave]=$valor;
                    }else{
                        $vector[]=$valor;
                    }
                }
            }
        }else{
            foreach($matriz as $key =>&$vector){
                if(is_string($vector)){
                    $vector = array($vector,$valores);   
                }else{
                    $vector[]=$valores;    
                }
            }
        }
            
        
        return $matriz;
    }
    
} // END


?>