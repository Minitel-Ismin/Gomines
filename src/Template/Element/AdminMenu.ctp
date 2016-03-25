<nav class="col-lg-3 col-md-4 column" id="actions-sidebar">
    <ul class="admin-menu affix">
        <li class="admin-menu-header"><?= __('Administration') ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('Utilisateurs',['controller' => 'users', 'action' => 'index']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('VPN',  ['action' => 'manageVPN']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link('Upload',['action' => 'manageDownloads']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link('Outils',['action' => 'tools']) ?></li>
        <li class="admin-menu-item"><?= $this->Html->link(__('Dashboard Admin'), ['controller' => 'Admin', 'action' => 'dashboard']) ?> </li>
        <li class="admin-menu-item"><?= $this->Html->link(__('Retour à l\'accueil'), ['controller' => 'Downloads', 'action' => 'display']) ?> </li>
    </ul>
</nav>