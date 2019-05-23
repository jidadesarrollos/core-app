<?PHP

/**
 * Clase Controladora del administrador del Framework
 *
 *
 */

namespace Jadmin\Controllers;

use Jida\Medios\Debug;

class Jadmin extends JControl {

    public function index() {

        Debug::imprimir(["si"], true);
    }

}
