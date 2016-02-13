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
?>
			<div id="mainContent">
<?php
foreach($conf as $name => $item):
	if(isset($item['hidden']) && $item['hidden'])
		continue;
	if(isset($item['cat']) && $item['cat'] != $subcat)
		continue;
	if(isset($item['color']))
		$color = $item['color'];
	else
		$color = false;
	if(isset($item['link']))
		$url = $item['link'];
	elseif(isset($item['subcat']))
		$url = ['controller' => 'Downloads', 'action' => 'display', $name];
	else
		$url = ['controller' => 'Downloads', 'action' => 'files', $name];
?>
				<div class="whole">
					<div class="type" <?= ($color) ? "style='background-color: #$color;'" : ""?>>
						<p><?= $name ?></p>
					</div>
					<div class="plan">
						<div class="header">
							<?=$this->Html->link($this->Html->image("/img/{$item['icon']}"), $url, array('escape' => false)); ?>
						</div>
					</div>
				</div>
<?php
endforeach;

// ADDs CONSTANT NODES
?>
				<div class="whole">
					<div class="type vpn">
						<p>VPN</p>
					</div>
					<div class="plan">
						<div class="header">
							<?= $this->Html->link($this->Html->image("/img/vpn.png"),['controller' => 'Vpn'], ['escape' => false]); ?>
						</div>
					</div>
				</div>
				<div class="whole">
					<div class="type upload">
						<p>Upload</p>
					</div>
					<div class="plan">
						<div class="header">
							<?= $this->Html->link($this->Html->image("/img/upload.png"),['controller' => 'Upload'], ['escape' => false]); ?>
						</div>
					</div>
				</div>
				<div class="whole">
					<div class="type admin">
						<p>Administration</p>
					</div>
					<div class="plan">
						<div class="header">
							<?= $this->Html->link($this->Html->image("/img/g.png"),['controller' => 'users'], ['escape' => false]); ?>
						</div>
					</div>
				</div>
			</div>