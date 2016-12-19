<p>Vous avez demandé un nouveau mot de passe</p>
<p>Si vous n'êtes pas à l'origine de cette demande , ne pas tenir compte de ce mail</p>
<?= $user->email ?><br>
<a href="http://gomines.rez/users/reset-password-token/<?= $user->reset_password_token ?>">Réinitialiser le mot de passe</a>
