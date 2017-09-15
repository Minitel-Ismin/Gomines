<nav class="col-lg-3" id="actions-sidebar">
    <div class="bugs-img">
        <?=$this->Html->image('bugsBunny.png'); ?>
    </div>
    <ul class="admin-menu affix">
        <li class="admin-menu-header"><?= __('Administration') ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('Utilisateurs',['controller' => 'users', 'action' => 'index']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('État VPN', ['controller' => 'vpn', 'action' => 'vpn-status']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link('Admin VPN', ['controller' => 'vpn', 'action' => 'vpn-users']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link('Upload',['controller' => 'FileManager', 'action' => 'files']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('Outils',['controller' => 'Admin','action' => 'tools']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link(__('Dashboard Admin'), ['controller' => 'Admin', 'action' => 'dashboard']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link(__('Retour à l\'accueil'), ['controller' => 'Downloads', 'action' => 'display']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('Film admin'), ['controller' => 'Film', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('DL Category'), ['controller' => 'DLCategory', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('Contenu'), ['controller' => 'Contents', 'action' => 'index']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link(__('Utilisation des disques'), ['controller' => 'FreeSpace', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('Tickets'), ['controller' => 'Ticket', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('Theme tickets'), ['controller' => 'TicketTheme', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('News'), ['controller' => 'News', 'action' => 'index']) ?> </li>
    	<li class="admin-menu-item"><?= $this->Html->link(__('Vpn-Comptes'), ['controller' => 'VpnComptes', 'action' => 'index']) ?> </li>
        
    </ul>
</nav>