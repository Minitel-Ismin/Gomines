<div class="bg"></div>
<div class="container files-container">

    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <?= $this->Html->link("Pacman", ["controller" => "Pacman"], ['style' => 'display:none', 'id' => 'pacmanLink']); ?>
                <span class="input-group-addon addon-size-fixed">Rechercher</span>
                <input type="text" class="form-control" aria-label="..." id="searchInput">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="searchBtn">Lancer la recherche !</button>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 path">
            <?php
            $folders = explode("/", $vpath);
            if($folders[count($folders)-1] == ""){
                array_pop($folders);
            }

            $path = "";
            $path = explode($folders[0], $vpath)[0];
            $path .= $folders[0];

            echo '<ol class="breadcrumb">';

            echo '<li>'.$this->Html->link("..", ["action" => "files", $path, "../"]).'</li>';

            foreach($folders as $foldersName){
                $path = explode($foldersName, $vpath)[0];
                $path .= $foldersName;
                if($foldersName == $folders[count($folders)-1])
                    echo '<li class="active">'.$foldersName.'</li>';
                else
                    echo '<li>'.$this->Html->link($foldersName, ["action" => "files", $path]).'</li>';
            }

            echo '</ol>';
            ?>
        </div>
    </div>

	<div class="row">
		<?php if($readme): ?>
		<div class="col-lg-8">
			<?php endif; ?>
			<ul>
                <li class="files">
                    <span class="glyphicon glyphicon-folder-open"></span>
                    <?= $this->Html->link("Dossier Parent", ["action" => "files", $vpath, "../"], ["class" => "parent-folder"]); ?>
                </li>
                <?php
                foreach($files[0] as $d):
                    ?>
                <li class="files">
                    <span class="glyphicon glyphicon-folder-open"></span>
                    <?= $this->Html->link($d, ["action" => "files", $vpath, $d], ["class" => "folder"]); ?>
                </li>
                <?php
                endforeach;
                foreach($files[1] as $f):
                    ?>
                <li class="files">
                    <span class="glyphicon glyphicon-file"></span>
                    <?= $this->Html->link($f, ["action" => "files", urlencode($vpath), $f]); ?>
                </li>
                <?php
                endforeach;
                ?>
			</ul>
		<?php if($readme): ?>
		</div>
		<code class="col-lg-4">
			<?= nl2br($readme) ?>
		</code>
		<?php endif; ?>
	</div>
</div>
