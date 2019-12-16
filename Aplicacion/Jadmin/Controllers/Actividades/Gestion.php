<?php

namespace App\Jadmin\Controllers\Actividades;

use App\Modelos\Actividad;
use App\Modelos\CentroCosto;
use App\Modelos\EmpresaUsuario;
use App\Modelos\SubCentroCosto;
use App\Modelos\User;
use Jida\BD\DataModel;
use Jida\Manager\Estructura;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

trait Gestion {

    function gestion($id = "") {

        if ($this->_tipoUsuario == 2) {
            Mensajes::almacenar(Mensajes::error("No tiene permisos suficientes para ejecutar esta acción."));
            $this->redireccionar('/jadmin/actividades');
        }

        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([
                Estructura::$urlBase . '/htdocs/js/scripts.js'
            ]);
            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([
                Estructura::$urlBase . '/htdocs/js/scripts.js'
            ]);
            $this->layout('ajax');
        }

        $idUsuario = Sesion::$usuario->obtener('id_usuario');

        $usuario = new User($idUsuario);
        $cargo = $usuario->cargo();

        $modelo = new EmpresaUsuario();
        $nombresEmpresas = $modelo->obtArregloEmpresas($idUsuario);

        $empresas = $modelo->obtArreglo($idUsuario);

        if (strtolower($cargo->cargo) === 'coordinador' || strtolower($cargo->cargo) === 'director') {

            if (count($empresas) > 1) {

                $formulario = 'GestionActividadesCoordEmpresa';
                $form = new Render\Formulario($formulario, $id);
                $form->campo('id_empresa')->agregarOpciones($nombresEmpresas);

            }
            elseif (count($empresas) === 1) {

                $formulario = 'GestionActividadesCoord';
                $form = new Render\Formulario($formulario, $id);
            }
        }
        else {

            if (count($empresas) > 1) {

                $formulario = 'GestionActividadesEmpresa';
                $form = new Render\Formulario($formulario, $id);
                $form->campo('id_empresa')->agregarOpciones($nombresEmpresas);

            }
            elseif (count($empresas) === 1) {

                $formulario = 'GestionActividades';
                $form = new Render\Formulario($formulario, $id);
            }
        }

        $actividad = new Actividad();
        $actividadesUsuario = $actividad->actividadesUsuario($idUsuario);

        $centroCosto = new CentroCosto();
        $opciones = $centroCosto->obtArreglo($empresas);

        $form->campo('id_centro_costo')->agregarOpciones($opciones);

        $sOpciones = array_keys($opciones);

        $subCentroCosto = new SubCentroCosto();
        $subOpciones = $subCentroCosto->obtArreglo($sOpciones);

        $form->campo('id_subcentro_costo')->agregarOpciones($subOpciones);

        if (!empty($id)) {
            $form->action = $form->action . '/' . $id;
        }

        $form->boton('btnGuardar', 'Guardar y agregar')->attr('value', 'Guardar y agregar');
        $form->boton('principal')->attr('value', 'Guardar');

        if ($boton = $this->post('btnGestionActividades')) {

            $this->_procesarActividad($form, $id, $boton);

        }
        elseif ($boton = $this->post('btnGuardar')) {
            $this->_procesarActividad($form, $id, $boton);
        }

        $this->data([
            'msj'                => $this->msj,
            'form'               => $form->render(),
            'actividadesUsuario' => $actividadesUsuario
        ]);

    }

    private function _procesarActividad(Render\Formulario $form, $id, $boton) {

        $fecha_entrega = $this->post('fecha_entrega');

        if (!isset($fecha_entrega) or empty($fecha_entrega)) {
            $this->post('fecha_entrega', $this->post('fecha_inicio'));
        }

        if ($form->validar() and $this->post('horas') > 0) {

            $modelo = new Actividad($id);

            $post = $this->post();
            $horas = $post['horas'];

            !empty($id) ? DataModel::sp('sp_remover_horas', [$id]) : null;

            $post['horas'] = 0;

            if (empty($post["id_usuario"])) {
                $post["id_usuario"] = Sesion::$usuario->obtener('id_usuario');
            }

            $check_1 = $modelo->salvar($post);
            //$id_actividad = $modelo->id_actividad;
            $check_2 = DataModel::sp('sp_actualizar_horas', [$modelo->id_actividad, $horas]);

//            if (!empty($this->post('usuarios_participantes'))) {
//
//                $usuariosParticipantes = $this->post('usuarios_participantes');
//                $actividadUsuario = new ActividadConjunta();
//                $matriz = [];
//                for ($i = 0; $i < count($usuariosParticipantes); $i++) {
//
//                    $arreglo = [
//                        'id_actividad' => $id_actividad,
//                        'id_usuario'   => $usuariosParticipantes[$i]
//                    ];
//                    array_push($matriz, $arreglo);
//                }
//
//                $actividadUsuario->salvarTodo($matriz);
//            }

            if ($check_1 and $check_2) {
                $status = empty($id) ? 'registrada' : 'actualizada';
                $msj = "Actividad <strong>{$status}</strong> correctamente";
                Mensajes::almacenar(Mensajes::suceso($msj));

                if ($boton === 'Guardar') {

                    $this->redireccionar('/jadmin/actividades/');
                }
                else {

                    $this->redireccionar('/jadmin/actividades/gestion');
                }
            }
            else {
                $msj = 'Su actividad no pudo ser registrada correctamente';
                Mensajes::almacenar(Mensajes::error($msj));
            }

        }
        else {
            $form::msj('error', 'Los datos ingresados no son v&aacute;lidos');
        }
    }

}