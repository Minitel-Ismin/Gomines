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

$cakeDescription = 'Gomines';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?> - <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('jquery-ui.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('site.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('base.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link($cakeDescription, ['controller' => 'pages', 'action' => 'home'], ['class' => 'navbar-brand']) ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="active"><?= $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home']) ?></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php
		if ($authUser): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $authUser['nom'] ?> <?= $authUser['prenom'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Mon compte</a></li>
            <li><?= $this->Html->link('Se déconnecter', ['controller' => 'users', 'action' => "logout"]); ?></li>
          </ul>
        </li>
		<?php
		else:
		?>
        <li><?= $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login']) ?></li>
        <li><?= $this->Html->link("S'inscrire", ['controller' => 'users', 'action' => 'register']) ?></li>
		<?php
		endif;
		?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <?= $this->Flash->render() ?>
    <section class="clearfix container-liquid">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/jquery-ui.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/site.js"></script>
    <?= $this->fetch('footerscript') ?>
    </footer>
</body>
</html>
