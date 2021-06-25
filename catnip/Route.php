<?PHP
namespace Catnip{
  class Route{

    private static $routes = Array();
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;
    private static $noRights = null;
  
    public static function add($expression, $function, $method = 'get', $middleware = []){
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => $method,
        'middleware' => $middleware
      ));
    }
  
    public static function get($expression, $function, $middleware = [])
    {
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => "get",
        'middleware' => $middleware
      ));
    }
  
    public static function put($expression, $function, $middleware = [])
    {
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => "put",
        'middleware' => $middleware
      ));
    }
  
    public static function post($expression, $function, $middleware = [])
    {
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => "post",
        'middleware' => $middleware
      ));
    }
  
    public static function patch($expression, $function, $middleware = [])
    {
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => "patch",
        'middleware' => $middleware
      ));
    }
  
    public static function delete($expression, $function, $middleware = [])
    {
      array_push(self::$routes,Array(
        'expression' => $expression,
        'function' => $function,
        'method' => "delete",
        'middleware' => $middleware
      ));
    }
  
    public static function pathNotFound($function){
      self::$pathNotFound = $function;
    }
  
    public static function methodNotAllowed($function){
      self::$methodNotAllowed = $function;
    }
  
    public static function noRights($function){
      self::$noRights = $function;
    }
  
    public static function redirect($url = '')
    {
      echo '<script>window.location.replace("'.REMOTE_ROOT.'/'.$url.'");</script>';
    }
  
    public static function run($basepath = '/'){
      $parsed_url = parse_url($_SERVER['REQUEST_URI']);
  
      if(isset($parsed_url['path'])){
        $path = $parsed_url['path'];
      }else{
        $path = '/';
      }
  
      $method = $_SERVER['REQUEST_METHOD'];
  
      $path_match_found = false;
  
      $route_match_found = false;
  
      foreach(self::$routes as $route){
        if($basepath!=''&&$basepath!='/'){
          $route['expression'] = '('.$basepath.')'.$route['expression'];
        }
  
        $route['expression'] = '^'.$route['expression'];
        $route['expression'] = $route['expression'].'$';
  
        if(preg_match('#'.$route['expression'].'#',$path,$matches)){
  
          $path_match_found = true;
  
          if(strtolower($method) == strtolower($route['method'])){
            array_shift($matches);
            if($basepath!=''&&$basepath!='/'){
              array_shift($matches);
            }
  
            //Check for middleware
            foreach ($route['middleware'] as $middleware) {
                //Find the Middleware in the App\Middleware\Handler.php file
                if(isset(\App\Middleware\Handler::$middleware[$middleware]))
                {
                  if(call_user_func_array(\App\Middleware\Handler::$middleware[$middleware], []) === FALSE)
                  {
                    call_user_func_array(self::$noRights, Array($path,$method));
                  }
                }
            }
  
            call_user_func_array($route['function'], $matches);
            $route_match_found = true;
            break;
          }
        }
      }
  
      if(!$route_match_found){
        if($path_match_found){
          header("HTTP/1.0 405 Method Not Allowed");
          ErrorHandler::MethodNotAllowed();
          if(self::$methodNotAllowed){
            call_user_func_array(self::$methodNotAllowed, Array($path,$method));
          }
        }else{
          header("HTTP/1.0 404 Not Found");
          ErrorHandler::NotFound();
          if(self::$pathNotFound){
            call_user_func_array(self::$pathNotFound, Array($path));
          }
        }
      } 
    } 
  }
}
?>