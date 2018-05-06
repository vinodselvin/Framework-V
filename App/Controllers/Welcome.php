<?php

class Welcome extends FV_Controller{
    
    function main(){
        
//        $this->load->controller('Hello');
        $this->load->model('Welcome_model');
        
//        print_r($this->Hello->main());    
        print_r($this->Welcome_model->test());
        
    }
}
