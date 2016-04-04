<?php
namespace App\Controller;

class PacmanController extends AppController
{
    public function index(){
        if($this->referer() != "http://localhost/Gomines/sylvester/Jeux")
            $this->redirect($this->referer());
    }
}
?>