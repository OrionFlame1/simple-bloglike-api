<?php
    class Router {
        private $request;

        private $params;

        private $routes;

        private $postfields;

        private $db;

        private $model;

        public function __construct($db) {
            $request = $_SERVER['REQUEST_URI'];
            $request = substr($request, 1);
            $request = substr($request, strpos($request, '/') + 1);
            $request = parse_url($request);

            $this->request = $request['path'];
            $this->db = $db;
            $this->params = null;

            if (!empty($request['query'])) {
                parse_str($request['query'], $params);
                $this->params = $params;
            }

            $postfields = file_get_contents("php://input");
            $postfields = (array) json_decode($postfields);
            $this->postfields = $postfields;
        }

        public function setModel($model) {
            $this->model = $model;
        }

        public function getRoutes() {
            return $this->routes;
        }

        public function getParams() {
            return $this->params;
        }

        public function addRoute($endpoint, $route, $is_function = false, $params = []) {
            if(empty($endpoint) || empty($route)) {
                throw new Exception('Endpoint or route not provided');
            }

            if(is_array($endpoint) && count($endpoint) > 1) {
                foreach($endpoint as $e) {
                    $this->routes[$e] = ['route' => $route, 'is_function' => $is_function
                    ];
                }
            } else {
                $this->routes[$endpoint] = [
                        'route' => $route, 
                        'is_function' => $is_function
                ];
            }
        }        

        public function executeRoute() {
            $route = $this->routes[$this->request];
            $params = [];
            if($this->params != null) {
                $params = array_merge($params, $this->params);
            }
            if($this->postfields != null) {
                $params = array_merge($params, $this->postfields);
            }
            if($route['is_function']) {
                if(method_exists($this->model, $route['route'])) {
                    if(isset($this->model)) {
                        return call_user_func([$this->model, $route['route']], $this->db, $params);
                    }
                    return call_user_func($route['route'], $this->db, $params);
                } else {
                    throw new Exception('Route as function does not exists: ' . $route['route']);
                }
            } else {
                require __DIR__ . $route['route'];
            }
            return;
        }
    }
?>