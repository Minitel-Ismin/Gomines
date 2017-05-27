<?= $this->Html->css('jquery.dataTables') ?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#Table').DataTable({
	    	"language": {
                "url": "/js/french.json"
            }
	    });
	});
</script>