<?php

class Welcome extends FV_Controller{
    
    function main(){
        
        $this->load->model('Welcome_model');
        
        $data = array('user_name' => "Vinod Selvin");
        
        $this->load->template('Welcome-page', $data);
    }
}
