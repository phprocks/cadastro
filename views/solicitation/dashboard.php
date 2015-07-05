<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Typeperson;
use app\models\Status;
use app\models\Typesolicitation;
use amnah\yii2\user\models\User;
?>
<div class="row">
<h2>Visão Geral</h2>
    	<hr/>
    <div class="col-xs-6 col-md-3">

        <?php  echo $this->render('_menu'); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-9">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class'=>'table table-bordered table-condensed'],
        'emptyText'    => '</br><p class="text-danger">Nenhuma solicitação encontrada!</p>',   
        'summary' => "<p class=\"text-primary \"><span class=\"badge\">{totalCount}</span> solicitações</p>",     
        'columns' => [
            [
             'attribute' => 'id',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 5%;text-align:left'],
            ],
            [
             'attribute' => 'created',
             'label' => 'Data',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 5%;text-align:center'],
             'format' => ['date', 'php:d/m/Y'],
            ],
            [
             'attribute' => 'location_id',
             'format' => 'raw',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->location->nickname;
                    },
             'contentOptions'=>['style'=>'width: 5%;text-align:left'],
            ],
            [
             'attribute' => 'typeperson_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->typeperson->name;
                    },
             'contentOptions'=>['style'=>'width: 15%;text-align:left'],
            ],
            [
             'attribute' => 'typesolicitation_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->typesolicitation->name;
                    },
             'contentOptions'=>['style'=>'width: 15%;text-align:left'],
            ],
            [
             'attribute' => 'status_id',
             'format' => 'raw',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    //return $model->status->name;
                    return '<span style="color:'.$model->status->color.'"><i class="fa fa-circle"></i> '.$model->status->name.'</span>';
                    },
             'contentOptions'=>['style'=>'width: 15%;text-align:left'],
            ],
            [
                'attribute' => 'analyst_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->analyst ? $model->analyst->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'contentOptions'=>['style'=>'width: 15%;text-align:left'],
            ],
        ],
    ]); ?>
    </div>

</div>