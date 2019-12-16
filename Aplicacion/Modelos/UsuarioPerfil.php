<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class UsuarioPerfil extends Modelo {

    var $id_usuario_perfil;
    var $id_usuario;
    var $id_perfil;

    protected $tablaBD = 's_usuarios_perfiles';
    protected $pk      = 'id_usuario_perfil';

}
