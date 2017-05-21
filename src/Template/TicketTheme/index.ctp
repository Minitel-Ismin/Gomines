<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Thème des tickets') ?></h2>
            <?= $this->Html->link(__("Ajouter un thème"), ['action' => 'add'], ["class" => "btn btn-default", "style"=>"margin-bottom:50px;"]) ?>
            <br>
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ticketThemes as $ticketTheme): ?>
                    <tr>
                        <td><?= $ticketTheme->name ?></td>
                        
                        
                        <td>
                        	<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $ticketTheme->id], ["class" => "btn btn-default" ,'confirm' => __('êtes vous sûr? # {0}?', $ticketTheme->id)]) ?>
                           
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>