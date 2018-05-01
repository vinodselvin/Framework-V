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
    
        $request_uri_segments = explode("/",$request_uri);

        if($request_uri_segments[2] != "index.php"){
            $request_uri_segments[2] = "index.php";
        }
        
        //Unsetted for reason
        unset($request_uri_segments[0]);
        unset($request_uri_segments[1]);
        unset($request_uri_segments[2]);
        
        $this->request['uri_segments'] = $request_uri_segments;
        $this->request['request_headers'] = getallheaders();
        
        $this->setController();
        
        return;
    }
    
    function setController(){
        
        foreach ($this->defined_routers as $key => $eroute){
            
            if ($this->checkUrlMatchesWithRouter(explode("/",$key))) {
                
                $url = explode("/", $eroute['url']);
                
                $this->request['controller'] = $url[0];
                $this->request['method'] = $url[1];
                
                $class_path = "App/Controllers/". $this->request['controller'].".php";
                
                if(file_exists($class_path)){
                    $this->request['class_path'] = $class_path;
                    return;
                }
            }
        }
        
        $this->request['class_path'] = false;
    }
    
    function checkUrlMatchesWithRouter($url){
        
        if(strpos(implode("/",$this->request['uri_segments']), implode("/", $url)) !== false){
            return true;
        }
        
        return false;
    }
    
}