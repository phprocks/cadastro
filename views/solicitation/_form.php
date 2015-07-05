<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Typeperson;
use app\models\Typesolicitation;
use amnah\yii2\user\models\User;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitation-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-3">
        <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['role_id' => 2])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])  ?>
        <?= $form->field($model, 'typeperson_id')->dropDownList(ArrayHelper::map(Typeperson::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'-- Selecione --'])  ?>
        <?= $form->field($model, 'cpf_cnpj')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['999.999.999-99', '99.999.999/9999-99'],
        ]) ?>
        </div>
        <div class="col-sm-3">
        <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("fullname ASC")->all(), 'id', 'fullname'),['prompt'=>'-- Selecione --'])  ?>
        <?= $form->field($model, 'typesolicitation_id')->dropDownList(ArrayHelper::map(Typesolicitation::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'-- Selecione --'])  ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'notes')->textarea(['rows' => 7]) ?>
        </div>
        
    </div>

    <hr/>

    <div class="row">
        <div class="col-sm-4">
        <?php echo $form->field($model, 'scholarity')->dropDownList([
                'ANALFABETO' => 'ANALFABETO',
                'ATÉ 4º SÉRIE INCOMPLETA DO ENSINO FUNDAMENTAL' => 'ATÉ 4º SÉRIE INCOMPLETA DO ENSINO FUNDAMENTAL',
                '4º SÉRIE COMPLETA DO ENSINO FUNDAMENTAL' => '4º SÉRIE COMPLETA DO ENSINO FUNDAMENTAL',
                '5º Á 8º SÉRIE DO ENSINO FUNDAMENTAL' => '5º Á 8º SÉRIE DO ENSINO FUNDAMENTAL',
                'ENSINO FUNDAMENTAL COMPLETO (ANTIGO 1º GRAU)' => 'ENSINO FUNDAMENTAL COMPLETO (ANTIGO 1º GRAU)',
                'ENSINO MEDIO INCOMPLETO (ANTIGO 2º GRAU)' => 'ENSINO MEDIO INCOMPLETO (ANTIGO 2º GRAU)',
                'ENSINO MEDIO COMPLETO (ANTIGO 2º GRAU)' => 'ENSINO MEDIO COMPLETO (ANTIGO 2º GRAU)',
                'EDUCAÇÃO SUPERIOR INCOMPLETA' => 'EDUCAÇÃO SUPERIOR INCOMPLETA',
                'EDUCAÇÃO SUPERIOR COMPLETA' => 'EDUCAÇÃO SUPERIOR COMPLETA',
        ],['prompt'=>'-- Selecione --']); ?>
        </div>
        <div class="col-sm-4">
        <?php echo $form->field($model, 'occupation') ?>
        </div>        
        <div class="col-sm-3">
        <?= $form->field($model, 'spouse_cpf')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['999.999.999-99'],
        ]) ?>
        </div>     
    </div>

    <div class="row">  
        <div class="col-sm-4">
        <?php echo $form->field($model, 'job_firm') ?>
        <?php echo $form->field($model, 'job_role') ?>
        </div>
        <div class="col-sm-3">
        <?= $form->field($model, 'job_phone')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['(99)9999-9999'],
        ]) ?>
        <?= $form->field($model, 'job_admission_date')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['99/99/9999'],
        ]) ?>
        </div>
    </div>
    
    <hr/>

    <?= $form->field($model, 'reference')->textarea(['rows' => 4])->hint('<i class="fa fa-exclamation-triangle"></i> Favor informar 2 nomes com os respectivos telefones') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-share"></i> Próxima Etapa' : '<i class="fa fa-floppy-o"></i> Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
