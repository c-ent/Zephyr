<?php
namespace Services;
session_start();

class Router
{
    protected $routes = [];
    protected $middleware = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action, $middleware = null)
    {
        $this->addRoute($route, $controller, $action, "GET");
        if ($middleware) {
            $this->middleware[$route] = $middleware;
        }
    }

    public function delete($route, $controller, $action, $middleware = null)
    {
        $this->addRoute($route, $controller, $action, "DELETE");
        if ($middleware) {
            $this->middleware[$route] = $middleware;
        }
    }

    public function post($route, $controller, $action, $middleware = null)
    {
        $this->addRoute($route, $controller, $action, "POST");
        if ($middleware) {
            $this->middleware[$route] = $middleware;
        }
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        // Check if the route exists for the requested method
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $controller = $route['controller'];
            $action = $route['action'];

            if (isset($this->middleware[$uri])) {
                $middleware = $this->middleware[$uri];
                if (!$this->applyMiddleware($middleware)) {
                    header("Location: /login"); // Redirect to login if not authenticated
                    exit;
                }
            }

            $controller = new $controller();
            $controller->$action();
        } else {
            // Check if the route exists for other methods
            $availableMethods = array_keys($this->routes);
            $availableRoutes = [];
            foreach ($availableMethods as $methodType) {
                if (isset($this->routes[$methodType][$uri])) {
                    $availableRoutes[] = $methodType;
                }
            }

            if (!empty($availableRoutes)) {
                // If the route exists but with different methods
                header("HTTP/1.1 405 Method Not Allowed");
                echo "Method Not Allowed. Available methods: " . implode(", ", $availableRoutes);
            } else {
                // Route does not exist
                header("HTTP/1.1 404 Not Found");
                echo "No route found for URI: $uri";
            }
            exit;
        }
    }

    
    private function applyMiddleware($middleware)
    {
        $middlewareList = explode('|', $middleware);
    
        foreach ($middlewareList as $m) {
            if ($m === 'auth') {
                error_log('Session user_id: ' . ($_SESSION['user_id'] ?? 'Not set'));
                
                //CSRF TOKEN CHECKER
                // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //     $csrfToken = $_POST['csrf_token'] ?? '';
                //     if ($csrfToken !== ($_SESSION['csrf_token'] ?? '')) {
                //         die('Invalid CSRF token');
                //     }
                // }

                if (!isset($_SESSION['user_id'])) {
                    return false;
                }
            }

        }
    
        return true;
    }

    public function dd(...$vars)
    {
        foreach ($vars as $var) {
            var_dump($var);
        }
        die();
    }
}
