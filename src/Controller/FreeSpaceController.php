<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FreeSpace Controller
 *
 * @property \App\Model\Table\FreeSpaceTable $FreeSpace
 *
 * @method \App\Model\Entity\FreeSpace[] paginate($object = null, array $settings = [])
 */
class FreeSpaceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $Disques["Films2"] = system("df -k | grep sdf2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["Series2"] = system("df -k | grep sdd2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["Jeux"] = system("df -k | grep sdh2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["Films1"] = system("df -k | grep sda2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["Series1"] = system("df -k | grep sdg2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["Blurays"] = system("df -k | grep sdb2 | awk '{ print $5 }' | cut -c 1-2");
        $Disques["NewDisk"] = system("df -k | grep sde1 | awk '{ print $5 }' | cut -c 1-2");
    
        
        $this->set(compact('Disques'));
    }

}
