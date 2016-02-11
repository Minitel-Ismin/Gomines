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


if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$title = "Accueil";
?>
			<div id="mainContent">
				<div class="whole">
					<div class="type films">
						<p>Films</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Films1"><img src="/img/darth.png" alt="Movies"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type bluray">
						<p>BluRays</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Bluray"><img src="/img/film19.png" alt="BluRays"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type series">
						<p>Series</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Series"><img src="/img/film50.png" alt="Series"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type pr0n">
						<p>NSFW</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/NSFW"><img src="/img/xxx.png" alt="NSFW"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type manga">
						<p>Manga</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Mangas"><img src="/img/japan15.png" alt="Manga"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type soft">
						<p>Soft</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Logiciels"><img src="/img/github.png" alt="Soft"></a>
						</div>
					</div>
				</div>

				<div class="whole">
					<div class="type jeux">
						<p>Jeux</p>
					</div>
					<div class="plan">
						<div class="header">
							<a href="/Jeux"><img src="/img/alien8.png" alt="Jeux"></a>
						</div>
					</div>
				</div>
				<div class="whole">
					<div class="type cours">
						<p>Cours</p>
					</div>
					<div class="plan">
						<div class="header">
							<?=$this->Html->link($this->Html->image("/img/annales.png"), ['cours'], array('escape' => false)); ?>
						</div>
					</div>
				</div>
				<div class="whole">
					<div class="type services">
						<p>Services</p>
					</div>
					<div class="plan">
						<div class="header">
							<?=$this->Html->link($this->Html->image("/img/services.png"), ['services'], array('escape' => false)); ?>
						</div>
					</div>
				</div>
			</div>
