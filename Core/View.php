<?php
namespace Core;

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
class View
{
 
    public
    static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = "../App/Views/$view"; //relative to Core directory

        if (is_readable($file))
        {
            require $file;
        }
        else
        {
            // echo "$file not found";
            throw new \Exception("$file not found");
        }
    }

    public
    static function renderTemplate($template, $args = [])
    {

        static $twig = null;

        if ($twig === null)
        {
            $loader = new \Twig_Loader_FileSystem('../App/Views');
            $twig = new \Twig_Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }
        // echo $template;
        // echo $_SERVER['REQUEST_URI'].'.html';
        echo $twig->render($template, $args);
    }
    
}
?>
