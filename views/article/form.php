<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin([
    'id'=>'add-form',
    'options'=>['class'=>'form-horizontal'],
]) ?>
<?= $form->field($model,'name')->label('文章名') ?>
<?= $form->field($model,'title')->label('标题') ?>
<?= $form->field($model,'content')->label('正文') ?>
<?= $form->field($model,'click')->label('点击') ?>
<div class="form-group">
    <div class="col-log-offset-1 col-lg-11">
        <?= Html::submitButton('Login',['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
