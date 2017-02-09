<?php
    //Carregamento automatico de classes
    spl_autoload_register( function( $Class ){
        $dirs = ['controllers', 'models', 'helpers'];
        $fileExists = false;

        foreach($dirs as $eDirs):
            if(is_dir("_app/{$eDirs}") && file_exists("_app/{$eDirs}/{$Class}.class.php"))
            {
                include "_app/{$eDirs}/{$Class}.class.php";
                $fileExists = true;
            }
        endforeach;


        if(!$fileExists):
            die("A classe {$Class}, não foi carregada !");
        endif;

    });