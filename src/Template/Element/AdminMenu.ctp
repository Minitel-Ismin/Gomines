<nav class="col-lg-3 col-md-4 column" id="actions-sidebar">
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
    </ul>
</nav>