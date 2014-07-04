<?PHP 
/**
 * Layout por defecto para modulo jadmin del framework
 * @author Julio Rodriguez
 */


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>
            <?PHP echo $dataArray['title'];?>
        </title>
        <meta name="description" content=""  charset="utf-8">
        <meta name="author" content="jirc">
                 

        <script src="/htdocs/js/jq2.0.3.js"></script>
        <script src="/htdocs/js/jqui1.10.3.js"></script>
        <script src="/htdocs/js/bootstrap.min.js"></script>
        <script src="/htdocs/js/objetoAjax.js"></script>
        <script src="/htdocs/js/validadorJida.js"></script>
        <script src="/htdocs/js/jidaPlugs.js"></script>
        <script src="/htdocs/js/jidaControlCampos.js"></script>
        <script src="/htdocs/js/funcionesGenerales.js"></script>
        <script src="/htdocs/js/bootstrap.min.js"></script>
        <script src="/htdocs/js/ajaxupload.js"></script>    

        <link href="/htdocs/css/bootstrap.css" rel="stylesheet">
        <link href="/htdocs/css/f-a.css" rel="stylesheet">
        <link href="/htdocs/css/estiloDefault.css" rel="stylesheet">
        <link href="/htdocs/css/jida.css" rel="stylesheet">
        <link href="/htdocs/css/jida-common.css" rel="stylesheet">
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>

    <body>
     <div  class="jida-container">
         <div class="container-fluid">
             <div class="row">
                <nav id="nav-top" class="navbar bg-jida navbar-fixed-top">    
                    <a class="navbar-brand pull-right" href="#">Jida-Framework Desarrollo</a>
                </nav>
            </div>
            <aside class="col-md-2 aside">
                    <?PHP 
                    $menuControl  = new MenuHTML('principal');
                    $menuControl->configuracion['ul'][0]="nav nav-aside";
                    $menuControl->configuracion['ul'][1]="";
                    
                     echo $menuControl->showMenu();
                    ?>
                
            </aside>
                <div class="col-md-offset-2 col-lg-10 col-md-10 contenido-principal">
                    <!-- <div class="row"> -->
            
                     <?=$contenido?>
        
                    <!-- </div> -->
                    <!--Cierre col-lg-9 del contenido-->
                </div><!--Cierre col-lg-9 del contenido-->                    
                <div class="separador-footer">
                    
                </div>
            </div><!--Cierre div full-container-->
        </div>                
        <?PHP
        
        if(entorno_app =='dev'){
          #  echo debug();
        }
        ?>    
        <footer class="footer container-fluid">
            <p>
                &copy; Copyright  by jirc Prueba
            </p>
        </footer>
        

    </body>
</html>
