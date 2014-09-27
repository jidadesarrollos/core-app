<?PHP 
/**
 * Definición de la clase
 * 
 * @author Julio Rodriguez <jirc48@gmail.com>
 * @package
 * @category Controller
 * @version 0.1
 */

 
class MetodosController	 extends Controller{
    
    function __construct($id=""){
        
        $this->layout="jadmin.tpl.php";
        $this->url="/jadmin/metodos/";
    }
    
    /**
     * Funcion controladora de metodos de un objeto
     */
    function metodosObjeto(){
        
        
        if(isset($_GET['obj'])){
            $objeto = new Objeto($this->getEntero(Globals::obtGet('obj')));
            
            $this->tituloPagina="Objeto $objeto->objeto - Metodos";
            $nombreClase = $objeto->objeto."Controller";
            $clase = new ReflectionClass($nombreClase);
            $metodos = $clase->getMethods(ReflectionMethod::IS_PUBLIC);
            //Debug::mostrarArray($metodos,false);
            foreach ($metodos as $key => $value) {
                if($value->name!='__construct' and $value->class==$nombreClase){
                    $arrayMetodos[$key]=$value->name;
                }
                    
            }
            
            $claseMetodo = new Metodo();
            $claseMetodo->validarMetodosExistentes($arrayMetodos, $objeto->id_objeto);
            $this->data['vistaMetodos'] = MetodosController::vistaMetodos($objeto);
            
        }
        return $this->data;
    }
	
    
    function addDescripcion(){
        if(isset($_GET['metodo']) and $this->getEntero($_GET['metodo'])){
                
            if(isset($_POST['s-ajax'])){
                $this->layout='ajax.tpl.php';
            }
            
            $form = new Formulario('DescripcionMetodo',2,$_GET['metodo'],2);
            $metodo = new Metodo($_GET['metodo']);
            $form->action="$this->url".'add-descripcion/metodo/'.$metodo->id_metodo;
            $form->tituloFormulario="Agregar Descripci&oacute;n del metodo ".$metodo->nombre_metodo;
            if(isset($_POST['btnDescripcionMetodo'])){
                $validacion = $form->validarFormulario();
                if($validacion===TRUE){
                    $guardado = $metodo->salvar($_POST);
                    if($guardado['ejecutado']==1){
                        Vista::msj('metodos', 'suceso', "La descripci&oacute;n del Metodo <strong>$metodo->nombre_metodo</strong> ha sido registrada exitosamente");
                    }else{
                        Vista::msj('metodos', 'error', "No se ha podido registrar la descripci&oacute;n, por favor vuelva a intentarlo");
                    }
                }else{
                    Vista::msj('metodos', 'error', "No se ha podido registrar la descripci&oacute;n, vuelva a intentarlo luego");
                }
                redireccionar('/jadmin/objetos/metodos/obj/'.$metodo->id_objeto);
            }
            
            $this->data['form'] = $form->armarFormulario();
        }else{
            
            throw new Exception("Pagina no conseguida", 404);
        }
        
    }
	static function vistaMetodos(Objeto $obj){
        $query = "select id_metodo,nombre_metodo as \"Metodo\",descripcion as \"Descripci&oacute;n\" from s_metodos where id_objeto=$obj->id_objeto";
        $vista = new Vista($query,$GLOBALS['configPaginador'],'metodos');
        $vista->tituloVista="Metodos del objeto ".$obj->objeto;
        $vista->setParametrosVista(array('idDivVista'=>'metodosObjeto'));
        
        $vista->filaOpciones=array(1=>array('a'=>array(
                                                'atributos'=>array( 'class'=>'btn',
                                                                    'title'=>'Agregar Descripci&oacute;n',
                                                                    'data-link'=>"/jadmin/metodos/add-descripcion/metodo/{clave}",
                                                                    'data-jvista'=>'modal'
                                                                    ),
                                                'html'=>array('span'=>array('atributos'=>array('class' =>'fa fa-edit fa-lg'))))),
                                    );
        $vista->acciones=array( 'Asignar perfiles de acceso'=>array('href'=>'/jadmin/objetos/acceso-perfiles/',
                                                                'data-jvista'=>'seleccion',
                                                                'data-multiple'=>'true','data-jkey'=>'metodo'),
                                
                              );
                              
        $vista->setParametrosVista($GLOBALS['configVista']);
        return $vista->obtenerVista();
    }

    
    
	
	static function obtenerMetodos($clase){
		
	}
}


?>