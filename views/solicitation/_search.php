<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use amnah\yii2\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-3">
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['role_id' => 2])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --','onchange'=>'this.form.submit()'])  ?>
        </div>
    </div>
    <p class="small">Selecione o seu nome para exibir as suas solicitações</p>

    <!-- <div class="form-group">
        <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
