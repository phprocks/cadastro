<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'typeperson_id') ?>

    <?php // echo $form->field($model, 'typesolicitation_id') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <div class="row">
        <div class="col-sm-3">
            <?php echo $form->field($model, 'cpf_cnpj') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'note_analyst') ?>

    <?php // echo $form->field($model, 'file_cpf') ?>

    <?php // echo $form->field($model, 'file_cartao_assinatura') ?>

    <?php // echo $form->field($model, 'file_comprovante_residencia') ?>

    <?php // echo $form->field($model, 'file_outro_endereco') ?>

    <?php // echo $form->field($model, 'file_imposto_renda') ?>

    <?php // echo $form->field($model, 'file_comp_estado_civil') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search"></i> Localizar', ['class' => 'btn btn-success']) ?>
        <?php // echo Html::resetButton('Limpar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
