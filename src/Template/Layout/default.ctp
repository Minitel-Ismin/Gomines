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
    <?= $this->Html->charset()?>
    <meta name="viewport"
	content="width=device-width, initial-scale=1.0">
<title>
        <?= $cakeDescription ?> - <?= $this->fetch('title')?>
    </title>
    <?= $this->Html->meta('icon')?>
    
    
    <?= $this->Html->css('jquery-ui.css')?>
    <?php //$this->Html->css('style.css') ?>
    <?php //$this->Html->css('site.css') ?>
    <?php //$this->Html->css('cake.css') ?>
    <?= $this->Html->css('bootstrap.min.css')?>
    <?= $this->Html->css('modal_form.css')?>
    <?php // this->Html->css('base.css') ?>
    <?= $this->Html->css('thomas.css')?>
    <?= $this->Html->css('font-awesome.min.css')?>
    <?= $this->Html->css('font.css')?>
    
    
	<?= $this->Html->script("jquery-3.2.1.min.js")?>
    
    <?= $this->fetch('meta')?>
    <?= $this->fetch('css')?>
    <?= $this->fetch('script')?>
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//<?= $_SERVER['SERVER_ADDR'] ?>/analytics/";
        _paq.push(['setTrackerUrl', u+'st.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'st.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
<noscript>
	<p>
		<img src="//<?= $_SERVER['SERVER_ADDR'] ?>/analytics/st.php?idsite=1"
			style="border: 0;" alt="" />
	</p>
</noscript>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					aria-expanded="false">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
      			<?= $this->Html->link($cakeDescription, ['controller' => 'Downloads', 'action' => 'display'], ['class' => 'navbar-brand'])?>
    		</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<!--<li class="active"><?= $this->Html->link('Accueil', ['controller' => 'Downloads', 'action' => 'display']) ?></li>-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
	  				
					<li><?= $this->Html->link('News', ['controller' => 'news', 'action' => "display"]); ?></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Liens utiles<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="http://minitel.emse.fr/wiki/Accueil">Wiki minitel</a></li>
							<li><a href="https://services-numeriques.emse.fr/">Wiki dsi école</a></li>
							<li><a href="https://myismin.emse.fr">MyIsmin</a></li>
						</ul>
					</li>
					<li><a href="#" data-toggle="modal" data-target="#myModal">Faire
							une demande</a></li>
					<?php if ($authUser) : ?>
			        	<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false"><?= $authUser['nom'] ?> <?= $authUser['prenom'] ?> <span
							class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Mon compte</a></li>
							<li><?= $this->Html->link('Se déconnecter', ['controller' => 'users', 'action' => "logout"]); ?></li>
						</ul></li>
		
		 			<?php else : ?>
        				<li><?= $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login']) ?></li>
						<li><?= $this->Html->link("S'inscrire", ['controller' => 'users', 'action' => 'register']) ?></li>
		
					<?php endif; ?>
		
      			</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
    <?= $this->Flash->render()?>
    <section class="container-liquid" style="margin-top: 70px">
        <?= $this->fetch('content')?>
    </section>
	<footer class="text-center">
		<?= $this->Html->script("jquery-3.2.1.min.js")?>
		<?= $this->Html->script("jquery-ui.js")?>
		<?= $this->Html->script("bootstrap.min.js")?>
		<?= $this->Html->script("alert.js")?>
		<?= $this->Html->script("site.js")?>
		<?php //$this->Html->script("search.js") ?>
        <?= $this->fetch('footerscript')?>
        Proud to be Gomines version <?php system("git log --pretty=format:%h -n 1"); ?> !
    </footer>
</body>
<?php if(isset($ticketThemes)):?>
<!-- Modal -->
<?= $this->element('modal_form', ['ticketThemes'=>$ticketThemes]); ?>
<?php endif;?>

</html>