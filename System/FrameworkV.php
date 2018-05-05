<?php

include("System/Router.php");

Class FrameworkV{
    
    private $FrameworkV = false;

    public function __construct(){
        
        $this->_initialize();
    }
    
    public function _initialize(){
        
        $this->FrameworkV = $this->getRouter();
        
        $this->loadClass();
    }
    
    public function getRouter(){
        
        $router = new Router();
        
        return $router->getRouterDetails();
    }
    
    public function loadClass(){
        
        $class_path = $this->FrameworkV->request['class_path'];
        
        if(!empty($class_path)){
            
            include($class_path);
            
            $controller = $this->FrameworkV->request['controller'];
            $method = $this->FrameworkV->request['method'];
            $request_method = $this->FrameworkV->request['request_method'];
            $method_allowed = $this->FrameworkV->request['request_method_allowed'];
            $class = new $controller();
            
            if(method_exists($class, $method)){
                if(in_array($request_method, $method_allowed)){
                    call_user_func_array(array($class, $method), array()); exit;
                }
                else{
                    include("Errors/show-request.php");
                }
            }
            else{
                include("Errors/show404.php");
            }
        }
        else{
            include("Errors/show404.php");
        }
    }
    
}