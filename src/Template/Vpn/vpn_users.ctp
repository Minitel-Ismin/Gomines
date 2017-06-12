<?= $this->Html->css('jquery.dataTables')?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
jQuery.fn.dataTable.ext.type.order['file-size-pre'] = function ( data ) {
    var matches = data.match( /^(\d+(?:\.\d+)?)\s*([a-z]+)/i );
    var multipliers = {
        b:  1,
        bytes: 1,
        kb: 1000,
        kib: 1024,
        mb: 1000000,
        mib: 1048576,
        gb: 1000000000,
        gib: 1073741824,
        tb: 1000000000000,
        tib: 1099511627776,
        pb: 1000000000000000,
        pib: 1125899906842624
    };
 
    if (matches) {
        var multiplier = multipliers[matches[2].toLowerCase()];
        return parseFloat( matches[1] ) * multiplier;
    } else {
        return -1;
    };
};
	$(document).ready(function(){
		var table = $('#Table').DataTable({
	    	"language": {
                "url": "/js/french.json"
            },
            columnDefs: [
                         { type: 'file-size', targets: 2 },
                         { type: 'file-size', targets:3 },
                       ]
	    });
	});


</script>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-8">
                <h3 class="text-center">Utilisateurs VPN</h3>
                <table class="table table-striped" id="Table">
                	<thead>
	                <tr>
		                <th>Prénom</th>
		                <th>Nom</th>
		                <th>BP Totale</th>
		                <th>BP Journée</th>
		                <th>Action</th>
	                </tr>
	                </thead>
	                <?php foreach($user as $u): ?>
	                    <tr>
	                        <td><?= $u['user']['prenom'] ?></td>
	                        <td><?= $u['user']['nom'] ?></td>
	                        <td><?= $u['bp'] ?></td>
	                        <td><?= $u['bp_day'] ?></td>
	                        
	                        <td>
	                            <div class="btn-group">
	                            <?= $this->Html->link("Reset",['controller' => 'vpn', 'action' => 'vpnResetBW', $u['user']['id']], ["class" => "btn btn-default"]) ?>
	                            </div>
	                        </td>
	                    </tr>
	                <?php endforeach; ?>
                </table>
        </div>
    </div>
</div>