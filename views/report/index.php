<?php

use yii\helpers\Html;
use yii\grid\GridView;
use amnah\yii2\user\models\User;
use yii\helpers\ArrayHelper;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="row">
<h2>Personalizado</h2>
        <hr/>
    <div class="col-xs-6 col-md-3">
        <?php  echo $this->render('_menu'); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-9">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class'=>'table table-condensed'],
        'emptyText'    => '</br><p class="text-danger">Nenhuma solicitação encontrada!</p>',   
        'summary' => "<p class=\"text-primary \">Quantidade de solicitações encontradas: <span class=\"badge\">{totalCount}</span></p><hr/>",        
        'columns' => [
            [
             'attribute' => 'id',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 5%;text-align:left'],
            ],
            [
             'attribute' => 'created',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 4%;text-align:center'],
             'format' => ['date', 'php:d/m/Y'],
            ],
            [
             'attribute' => 'user_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->user->username;
                    },
             'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
             'contentOptions'=>['style'=>'width: 14%;text-align:center'],
            ],
            [
             'attribute' => 'status_id',
             'format' => 'raw',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return '<span style="color:'.$model->status->color.'"><i class="fa fa-circle"></i> '.$model->status->name.'</span>';
                    },
             'filter' => ArrayHelper::map(Status::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
             'contentOptions'=>['style'=>'width: 14%;text-align:left'],
            ],
            [
                'attribute' => 'analyst_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->analyst ? $model->analyst->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],            
        ],
    ]); ?>
    </div>

</div>
