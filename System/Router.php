<?php

Class Router extends FrameworkV{
    
    public $defined_routers;
    public $server;
    public $request;
    
    public function __construct(){    
        $this->server = $_SERVER;    
    }
    
    public function getRouterDetails(){
        
        include('App/Configurations/Router.php');
        
        //All router details
        foreach ($ROUTER as $key => $value){
            $this->defined_routers[$key]['url'] = $value[0];
            $this->defined_routers[$key]['method'] = $value[1];
        }
        
        $this->setRequestDetails();
        
        return $this;
    }
    
    function setRequestDetails(){
        
        $request_uri = $this->server['REQUEST_URI'];
        
        $request_url = explode("?", $request_uri);
        
        $request_uri_segments = explode("/", trim($request_url[0], '/'));
        
        unset($request_uri_segments[0]);
        
        if(isset($request_uri_segments[1]) && $request_uri_segments[1] == 'index.php'){
            unset($request_uri_segments[1]);
        }
        
        $this->request['uri_segments'] = $request_uri_segments;
        $this->request['request_headers'] = $this->getallheaders();
        
        $this->setController();
        
        return;
    }

    
    function getallheaders() {
	    
	$headers = [];
	
	foreach ($_SERVER as $name => $value) {
        	if (substr($name, 0, 5) == 'HTTP_') {
            		$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        	}
	}

    	return $headers;
    }
    
    function setController(){
        
        foreach ($this->defined_routers as $key => $eroute){
            
            $isRouterPresent = $this->checkUrlMatchesWithRouter(explode("/",$key));
            
            if($isRouterPresent == "yes") {
                $this->setMethod($eroute);
                return true;
            }
            else if($isRouterPresent == "default"){
                $this->setMethod($this->defined_routers['default_route']);
                return true;
            }
        }
        
        $this->request['class_path'] = false;
    }
    
    function checkUrlMatchesWithRouter($url){
        
        if(empty($this->request['uri_segments'])){
            return "default";
        }
        else if(implode("/",$this->request['uri_segments']) == implode("/", $url)){
            return "yes";
        }
        
        return "no";
    }
    
    function setMethod($route){
        
        $url = explode("/", $route['url']);

        $this->request['controller'] = $url[0];
        $this->request['method'] = $url[1];
        $this->request['request_method_allowed'] = $route['method'];
        $this->request['request_method'] = strtolower($this->server['REQUEST_METHOD']);
        
        $class_path = "App/Controllers/". $this->request['controller'].".php";

        if(file_exists($class_path)){
            $this->request['class_path'] = $class_path;
            return;
        }
    }
    
}
