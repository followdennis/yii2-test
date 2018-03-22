<?php

use yii\widgets\Block;
use yii\widgets\ContentDecorator;

?>
<?php ContentDecorator::begin(['viewFile'=>'@app/backend/views/layouts/main.php'])?>

<?php Block::begin(['id' =>'content']);?>
<div class="main_column">
    <?= $content ?>
</div>
<?php Block::end();?>

<?php Block::begin(['id' =>'footer']);?>
<?= $this->render('..\common\footer')?>
<?php Block::end();?>

<?php ContentDecorator::end();?>