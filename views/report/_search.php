<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use amnah\yii2\user\models\User;
use app\models\Location;
use app\models\Typeperson;
use app\models\Typesolicitation;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $model app\models\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?php
                echo '<label class="control-label">Período</label>';
                echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'start_date',
                    'attribute2' => 'end_date',
                    'language' => 'pt',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => 'até',
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['role_id' => 2])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'Todos'])  ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("fullname ASC")->all(), 'id', 'fullname'),['prompt'=>'Todos'])  ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'typeperson_id')->dropDownList(ArrayHelper::map(Typeperson::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'Todos'])  ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'typesolicitation_id')->dropDownList(ArrayHelper::map(Typesolicitation::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'Todos'])  ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Status::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'Todos'])  ?>
        </div>        
    </div>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'typeperson_id') ?>

    <?php // echo $form->field($model, 'typesolicitation_id') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'analyst_id') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'note_analyst') ?>

    <?php // echo $form->field($model, 'cpf_cnpj') ?>

    <?php // echo $form->field($model, 'scholarity') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'job_firm') ?>

    <?php // echo $form->field($model, 'job_role') ?>

    <?php // echo $form->field($model, 'job_phone') ?>

    <?php // echo $form->field($model, 'job_admission_date') ?>

    <?php // echo $form->field($model, 'spouse_cpf') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <div class="form-group">
        <?= Html::submitButton('Filtrar', ['class' => 'btn btn-success']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
