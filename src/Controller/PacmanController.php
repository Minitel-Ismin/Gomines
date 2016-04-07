<?php
namespace App\Controller;
use Cake\Routing\Router;

class PacmanController extends AppController
{
    public function index(){
        if(strstr($this->referer(),Router::url(array('controller'=>'Downloads','action'=>'files', 'Jeux'))) == FALSE)
            $this->redirect($this->referer());
    }
}
?>
