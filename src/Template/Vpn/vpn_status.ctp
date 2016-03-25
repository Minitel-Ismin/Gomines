<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-8">
            <div class="text-center">
                <h2>Statut VPN</h2>
            </div>
            <table class="table table-striped">
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
    </div>
</div>
