<?php

namespace Core;

/**
 * router
 *
 * php version 7.0
 */
class Router
{

    /**
     * associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];

    /**
     * parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * add a route to the routing table
     *
     * @param string $route  the route url
     * @param array  $params parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        // convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '<\1>[a-z-]+', $route);

        // convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '<\1>\2', $route);

        // add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * get all the routes from the routing table
     *
     * @return array
     */
    public function getroutes()
    {
        return $this->routes;
    }

    /**
     * match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url the route url
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * get the currently matched parameters
     *
     * @return array
     */
    public function getparams()
    {
        return $this->params;
    }

    /**
     * dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url the route url
     *
     * @return void
     */
    public function dispatch($url)
    {
        $url = $this->removequerystringvariables($url);
        
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->converttostudlycaps($controller);
            $controller = $this->getnamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->converttocamelcase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();

                } else {
                    throw new \exception("method $action (in controller $controller) not found");
                }
            } else {
                throw new \exception("controller class $controller not found");
            }
        } else {
            throw new \exception('no route matched.', 404);
        }
    }

    /**
     * convert the string with hyphens to studlycaps,
     * e.g. post-authors => postauthors
     *
     * @param string $string the string to convert
     *
     * @return string
     */
    protected function converttostudlycaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * convert the string with hyphens to camelcase,
     * e.g. add-new => addnew
     *
     * @param string $string the string to convert
     *
     * @return string
     */
    protected function converttocamelcase($string)
    {
        return lcfirst($this->converttostudlycaps($string));
    }

    /**
     * remove the query string variables from the url (if any). as the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. for
     * example:
     *
     *   url                           $_server['query_string']  route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * a url of the format localhost/?page (one variable name, no value) won't
     * work however. (nb. the .htaccess file converts the first ? to a & when
     * it's passed through to the $_server variable).
     *
     * @param string $url the full url
     *
     * @return string the url with the query string variables removed
     */
    protected function removequerystringvariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * get the namespace for the controller class. the namespace defined in the
     * route parameters is added if present.
     *
     * @return string the request url
     */
    protected function getnamespace()
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}
