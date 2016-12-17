<p>Vous avez demandé un nouveau mot de passe</p>
<p>Si vous n'êtes pas à l'origine de cette demande , ne pas tenir compte de ce mail</p>
<?= $user->email ?>
<?= $this->Html->link(
    'Reinitialiser mon mot de passe',
 	['controller' => 'Users', 'action' => 'resetPasswordToken', $user->reset_password_token]
) ?>
