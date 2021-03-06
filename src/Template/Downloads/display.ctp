<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$title = "Accueil";

$this->Html->script('soundmanager2.js', array('block' => 'footerscript'));
$this->Html->script('titiVoitGrominet.js', array('block' => 'footerscript'));

?>
                
                <div class="bg"></div>
                <div class="container">
                    <div class="row cat-container">
                        <div class="g-img">
                            <?=$this->Html->image('grominet.png'); ?>
                        </div>
                        <div class="titi-img">
                            <?=$this->Html->image('titi.png'); ?>
                        </div>
                        
						<?php
							for($k=0; $k < $numberOfCat; $k++){ 
								$category = $categories[$k];
								$url = ['controller' => 'Downloads', 'action' => 'files2', $category->name];
								$html = '<div class="col-lg-'.($bootstrapCol).' cat-tools text-center" style="background-color: #'.$category->color.'">'.$category->name.'<br>'.$this->Html->image($category->icon).'</div>';
								echo $this->Html->link($html, $url, array('escape' => false));
									
							}                             
						              
						?>
                    
                    </div>
                

<?php
                        

// ADDs CONSTANT NODES
if(empty($subcat)):
        $htmlVPN = '<div class="col-lg-4 col-md-4 col-sm-4 cat-tools text-center" style="background-color: #4558A2">VPN<br>'.$this->Html->image("/img/vpn.png").'</div>';
        $htmlUpload = '<div class="col-lg-4 col-md-4 col-sm-4 cat-tools text-center" style="background-color: #A2584E">Upload<br>'.$this->Html->image("/img/upload.png").'</div>';
        $htmlAdmin = '<div class="col-lg-4 col-md-4 col-sm-4 cat-tools text-center" style="background-color: #75A685">Administration<br>'.$this->Html->image("/img/g.png").'</div>';
?>
                <div class="row tools-container">
                    <?= $this->Html->link($htmlVPN,['controller' => 'Vpn'], ['escape' => false]); ?>
                    <?= $this->Html->link($htmlUpload,['controller' => 'Upload'], ['escape' => false]); ?>
                    <?= $this->Html->link($htmlAdmin,['controller' => 'Admin', 'action' => 'dashboard'], ['escape' => false]); ?>
                </div>
    
<?php
endif;
?>
                </div>