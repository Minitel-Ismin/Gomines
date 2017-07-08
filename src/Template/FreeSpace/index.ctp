<script type="text/javascript">
  $(document).ready(function(){
    $("li.disque-li").each(function(){
      utilisation = $(this).children().children().data("value");
      
      if(utilisation <= 20){
        $(this).children().children().addClass(" progress-bar-success");
      }else if(utilisation <= 40){
        $(this).children().children().addClass(" progress-bar-info");
      }else if(utilisation <= 60){

      }else if(utilisation <= 80){
        $(this).children().children().addClass(" progress-bar-warning");
      }else{
        $(this).children().children().addClass(" progress-bar-danger");
      }
    });
  });
  
</script>
<div class="container-fluid">
  <div class="row">
    <?= $this->element('AdminMenu'); ?>
    <div class="col-lg-9" style="margin-bottom: 150px">
      <ul class="disque-space" style="list-style-type: none;">
        <?php foreach($Disques as $key=>$loadSpace): ?>
          <li class="disque-li">
            <div class="progress" style="height: 30px;">
              <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $loadSpace ?>"
              aria-valuemin="0" aria-valuemax="100" data-value="<?php echo $loadSpace ?>" style="width:<?php echo $loadSpace ?>%">
                <?php echo $key; ?>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
  