<?php

require "App/Configurations/Constants.php";


class FV_Core{
    
    public $load = false;
    protected $main = false;
    
    public function __construct(){
        
        $this->load = $this;
        
        $this->main = $this->getConfig();
    }
    
    public function initiateClass($class_path, $class){
        
        if(file_exists($class_path)){
            include($class_path);
            $this->$class = new $class();
        }
        else{
            echo $class_path.", Not Found";
        }
        
    }
    
    public function controller($class){
        
        $this->initiateClass($this->main['APP_CONTROLLER_DIR'] . $class . ".php", $class);
        
    }
    
    public function model($class){
        
        $this->initiateClass($this->main['APP_MODELS_DIR'] . $class . ".php", $class);
        
    }
    
    public function plugin($class){
        
        $this->initiateClass($this->main['APP_PLUGINS_DIR'] . $class . ".php", $class);
        
    }
    
    protected function getConfig(){
        
        $path = "App/Configurations/Main.php";
        
        if(file_exists($path)){
            include "App/Configurations/Main.php";
        }
        else{
            echo "Configuration Error";exit;
        }
        
        return $MAIN;
    }
    
    public function template($view_path, $data = false, $store_to_variable = false){
        
        if(!empty($view_path)){

            $file_path = $this->main['APP_VIEWS_DIR'] . $view_path . '.php';
            
            if(file_exists($file_path)){
                
                if(!empty($data)){
                    
                    $data = (array) $data;
                    
                    extract($data);
                }
                
                if($store_to_variable){
                    return $this->loadToVariable($file_path, $data);
                }
                else{
                    require($file_path);
                }
            }
        }
    }
    
    protected function loadToVariable($file_path, $data){
        
        ob_start();
        
        extract($data);
        
        require($file_path);
        
        return ob_get_clean();
    }
}
