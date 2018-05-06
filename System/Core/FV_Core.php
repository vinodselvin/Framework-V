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
}
