<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use amnah\yii2\user\models\User;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_cpf')->fileInput() ?>

    <?= $form->field($model, 'file_cartao_assinatura')->fileInput() ?>

    <?= $form->field($model, 'file_comprovante_residencia')->fileInput() ?>

    <?= $form->field($model, 'file_outro_endereco')->fileInput() ?>

    <?= $form->field($model, 'file_outro_endereco')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Próxima Etapa' : 'Gravar Alteração', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
