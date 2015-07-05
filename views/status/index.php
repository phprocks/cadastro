<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Situações';

?>
<div class="status-index">

    <h2>Situações</h2>
    <hr/>
    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            'color',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
