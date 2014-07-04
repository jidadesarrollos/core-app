<!DOCTYPE html>
<html lang="en">
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
        <link href="/htdocs/css/estiloDefault.css" rel="stylesheet">
        <link href="/htdocs/css/jida-common.css" rel="stylesheet">
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>

    <body class="full-container">
         <div class="container">
            <div class="col-lg-3">
                
                <nav id="menu" class="">
                
                    <?PHP 
                    $menuControl  = new MenusController();
                    $config['ul']=array(0=>'uno',1=>"dos");
                    $config['li']=array(0=>'uno',1=>"dos");
                     echo $menuControl->showMenu('principal',$config);
                    ?>
                </nav>
            </div>
            <div class="col-lg-9">
                <div class="row">
            
                