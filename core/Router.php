<?php

class Router {
    private $routes;

    public function __construct() {
        // Путь к роутерам.
        $routesPath =  './core/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI() {
        // Получаем строку запроса
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        //Получаем строку запроса
       $uri = $this->getURI();
      //Проверить наличие такого запроса в роутах
       foreach ($this->routes as $uriPattern => $path) {
            // Сравниваем $uriPattern и $uri
           if (preg_match("~^$uriPattern$~", $uri)) {
            //Получаем внутренний путь из внешнего солгасно правилу
            $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
            // Делим строку на две части
            $segments = explode('/', $internalRoute);
            //Получаем имя контроллера удаляя первый сегмент из $segments
            $controllerName = array_shift($segments).'Controller';
            $controllerName = ucfirst($controllerName);

            $actionName = 'action'.ucfirst(array_shift($segments));

            $parameters = $segments;
            //Подключаем файл контроллера
            $controllerFile = './core/controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                include_once($controllerFile);
            }
            $controllerObject = new $controllerName;
            $result = call_user_func_array(array($controllerObject, $actionName),$parameters);
            if ($result != null) {
               break;
            } 
        }
       } 
    }
}
