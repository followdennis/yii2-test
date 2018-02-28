<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin([
    'id'=>'add-form',
    'options'=>['class'=>'form-horizontal'],
]) ?>
<?= $form->field($model,'name') ?>
<?= $form->field($model,'title') ?>
<?= $form->field($model,'content') ?>
<?= $form->field($model,'click') ?>
<div class="form-group">
    <div class="col-log-offset-1 col-lg-11">
        <?= Html::submitButton('Login',['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
