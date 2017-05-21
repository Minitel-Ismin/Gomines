<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Liste des tickets') ?></h2>
            <br>
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                    	<th>ID</th>
                        <th>Demandeur</th>
                        <td>Theme</td>
                        <td>Question</td>
                        <td>Mail</td>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                    	<td><?= $ticket->id ?></td>
                        <td><?= $ticket->asker ?></td>
                        <?php if($ticket->ticket_theme != Null):?>
                        	<td><?= $ticket->ticket_theme->name ?></td>
                        <?php else:?>
                        	<td><?= $ticket->theme ?></td>
                        <?php endif;?>
                        <td><?= $ticket->question ?></td>
                        <td><?= $ticket->email ?></td>
                        
                        <td>
                        	<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $ticket->id], ["class" => "btn btn-default" ,'confirm' => __('êtes vous sûr? # {0}?', $ticket->id)]) ?>
                           
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>