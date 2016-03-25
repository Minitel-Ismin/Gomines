<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <li class="list-group-item list-header" style="font-size: 20px"><?= __('Actions') ?></li>
                <li class="list-group-item"><?= $this->Html->link('Télécharger la configuration', ['action' => 'dlConfig']) ?> </li>
                <li class='list-group-item'><?= $this->Html->link(__('Retour'), ['controller' => 'pages', 'action' => 'index']) ?> </li>
            </ul>
        </div>

        <div class="col-lg-9">
                <h3>Votre compte VPN</h3>
                <?php
                if(!empty($user['vpn_compte'])):
                    if($user['vpn_compte']['actif'] == 0):
                    ?>
                    <p>Votre compte n'a pas encore été validé</p>
                    <?php
                    else:
                    ?>
                    <p>Votre compte est actif</p>
                    <p>Vous avez consommé : <?= $user['vpn_compte']['bp'] ?> depuis le 08/12/2015.</p>
                    <p>Vous avez consommé : <?= $user['vpn_compte']['bp_day'] ?> aujourd'hui</p>
                    <p>Vous avez un quota d'un giga octet de données par jour, il est remis à zéro à minuit</p>
                    <?php
                    endif;
                else:
                ?>
                <p>Vous n'avez pas de compte VPN</p>
                <?= $this->Html->link("Demander un compte VPN", ['action' => 'request']); ?>
                <?php
                endif;
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Le VPN
                    </div>
                    <div class="panel-body">
                        <p>Le VPN est accessible pour 1€/an.</p>
                        <p>Les identifiants fournis sont personnels et utilisés pour authentifier l'accès au VPN ainsi que les activités des utilisateurs.</p>
                        <p>La bande passante allouée à un utilisateur est limitée à 10mbits/s (environ 1.25mo/s).</p>
                        <p>La bande passante consommée par un utilisateur ne dois pas excéder 1Go par jour. Ainsi nous vous conseillons de ne pas utiliser le VPN pour vos téléchargements et autres mises à jour.</p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Instructions - En vidéo ! (On remerciera GA pour son tuto :) )
                    </div>
                    <div class="panel-body">
                        <a href="tuto.mp4">Vous pouvez télécharger la vidéo ici !</a>
                        <div class="embed-responsive embed-responsive-16by9">
                            <video controls class="embed-responsive-item">
                                <source src="tuto.mp4" type="video/mp4">
                                <source src="tuto.ogv" type="video/ogg">
                            </video>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Instructions
                    </div>
                    <div class="panel-body">
                        <p>Installer le logiciel <a href="https://openvpn.net/index.php/open-source/downloads.html">OpenVPN</a></p>
                        <p>Télécharger le fichier de configuration disponible sur cette page (<?= $this->Html->link('Télécharger la configuration', ['action' => 'dlConfig']) ?>)</p>
                        <p>Placer le fichier de configuration dans le dossier d'OpenVPN ( C:\Program Files (x86)\OpenVPN\config\ )</p>
                        <p>Lancer l'interface d'OpenVPN <strong>en administrateur</strong> (Clic droit sur OpenVPN dans le menu démarrer puis Exécuter en tant qu'Administrateur)</p>
                        <p>Clic droit sur l'icone dans la barre des tâches puis Connecter</p>
                    </div>
                </div>
        </div>
    </div>
</div>