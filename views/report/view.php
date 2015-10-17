<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Report */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'updated',
            'user_id',
            'status_id',
            'typeperson_id',
            'typesolicitation_id',
            'location_id',
            'analyst_id',
            'notes:ntext',
            'note_analyst:ntext',
            'cpf_cnpj',
            'scholarity',
            'occupation',
            'job_firm',
            'job_role',
            'job_phone',
            'job_admission_date',
            'spouse_cpf',
            'reference:ntext',
            'ip',
        ],
    ]) ?>

</div>
