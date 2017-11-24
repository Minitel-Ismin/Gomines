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
        $Disques["Jeux"] = str_replace("%","",system("df -k | grep sdb2 | awk '{ print $5 }' | cut -c 1-3")); 
        $Disques["Films1"] = str_replace("%","",system("df -k | grep sda2 | awk '{ print $5 }' | cut -c 1-3")); 
        $Disques["Series1"] = str_replace("%","",system("df -k | grep sdg2 | awk '{ print $5 }' | cut -c 1-3")); 
        $Disques["Blurays"] = str_replace("%","",system("df -k | grep sdb2 | awk '{ print $5 }' | cut -c 1-3")); 
        $Disques["NewDisk"] = str_replace("%","",system("df -k | grep sde1 | awk '{ print $5 }' | cut -c 1-3"));
        $Disques["Iron1"] = str_replace("%","",system("df -k | grep sdf1 | awk '{ print $5 }' | cut -c 1-3"));
        
        $this->set(compact('Disques'));
    }

}
