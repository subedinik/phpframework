<?php
namespace Core;

/*Error and exception handler */

class Error{
  /* Error handler. Convert all errors o Exception by throwing error exception*/
  /*
* @param int $level Erorr level
* @param string $message Error message
*@param string $file Filename the error was raised in
@param int $line Line number in the Filename

*@return void

  */
  public static function errorHandler($level, $message, $file, $line)
{
  if (error_reporting() !== 0){  //To keep the @operator working
    throw new \ErrorException($message,0,$level,$file,$line);

  }
}

/*Exception handler
@param exception $exception The exception

@return void
*/

public static function exceptionHandler($exception)
{
//Code is 404 not found or 500 (general error)
$code = $exception->getCode();
if($code != 404){
  if($code !=500)
    {
      $code = 403;
    }
}
http_response_code($code);


  if(\App\Config::SHOW_ERRORS){
  echo "<h1>Fatal error</h1>";
           echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
           echo "<b><p>Message: '" . $exception->getMessage() . "'</p></b>";
           echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
           echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
}
else{

  //Logging errors
  $log = dirname(__DIR__).'/logs/'.date('Y-m-d').'.txt';
  ini_set('error_log',$log);

  $message = "Uncaught exception:'".get_class($exception)."'";
  $message .= "with message'".$exception->getMessage()."'";
  $message .= "\nStack trace: ".$exception->getTraceAsString();
  $message .="\nThrown in '".$exception->getFile()."' on Line".$exception->getLine();

  error_log($message);
  // echo "<h1>An error occurred</h1>";
  // echo $code;

  View::renderTemplate("$code.html");
}
}



}
 ?>
