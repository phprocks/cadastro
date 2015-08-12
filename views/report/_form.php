<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'typeperson_id')->textInput() ?>

    <?= $form->field($model, 'typesolicitation_id')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'analyst_id')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_analyst')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cpf_cnpj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scholarity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_firm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_admission_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spouse_cpf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
