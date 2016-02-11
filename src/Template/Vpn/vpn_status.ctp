<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Retour'), ['controller' => 'vpn', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3>Statut VPN</h3>
<table>
<tr>
<th>Common Name</th>
<th>Real Address</th>
<th>Virtual Address</th>
<th>Bytes Received</th>
<th>Bytes Sent</th>
<th>Connected Since</th>
<th>Last Ref</th>
</tr>
<?php
foreach($listeCo as $co):
?>
<tr>
<td><?= $co['cn']; ?></td>
<td><?= $co['real_addr']; ?></td>
<td><?= $co['virt_addr']; ?></td>
<td><?= $co['b_rx']; ?></td>
<td><?= $co['b_tx']; ?></td>
<td><?= $co['conn_since']; ?></td>
<td><?= $co['last_ref']; ?></td>
</tr>
<?php
endforeach;
?>
</table>
</div>
