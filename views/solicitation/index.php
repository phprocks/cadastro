<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Typeperson;
use app\models\Status;
use app\models\Typesolicitation;
use amnah\yii2\user\models\User;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acompanhar Solicitações';
?>
<div class="solicitation-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <hr/>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-danger">Nenhuma solicitação encontrada!</p>',   
        'summary' => "<p class=\"text-primary \">Você possui {totalCount} solicitações</p>",     
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_id == 98)
                {
                    return ['class' => 'text-muted'];
                }
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
             'attribute' => 'id',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 6%;text-align:left'],
            ],
            [
             'attribute' => 'created',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 7%;text-align:center'],
             'format' => ['date', 'php:d/m/Y'],
             //'filter' => DatePicker::widget(['language' => 'pt', 'dateFormat' => 'yyyy-MM-dd']),
             //'format' => 'html',
            ],
            [
             'attribute' => 'location_id',
             'format' => 'raw',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->location->nickname;
                    },
             'filter' => ArrayHelper::map(Location::find()->orderBy('nickname')->asArray()->all(), 'id', 'nickname'),
             'contentOptions'=>['style'=>'width: 7%;text-align:left'],
            ],
            [
             'attribute' => 'cpf_cnpj',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 15%;text-align:left'],
            ],
            // [
            //  'attribute' => 'typeperson_id',
            //  'format' => 'raw',
            //  'enableSorting' => true,
            //  'value' => function ($model) {                      
            //         return $model->typeperson->name;
            //         },
            //  'filter' => ArrayHelper::map(Typeperson::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
            //  'contentOptions'=>['style'=>'width: 20%;text-align:left'],
            // ],
            [
             'attribute' => 'typeperson_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->typeperson->name;
                    },
             'filter' => ArrayHelper::map(Typeperson::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
             'contentOptions'=>['style'=>'width: 12%;text-align:left'],
            ],
            [
             'attribute' => 'typesolicitation_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->typesolicitation->name;
                    },
             'filter' => ArrayHelper::map(Typesolicitation::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
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
             'filter' => ArrayHelper::map(Status::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
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
            [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions'=>['style'=>'width: 10%;text-align:right'],
            'template' => '{view} {update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" ></span>', $url, [
                                    'title' => 'Visualizar',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return $model->status_id < 98 ? Html::a('<span class="glyphicon glyphicon-pencil" ></span>', $url, [
                                    'title' => 'Alterar',
                        ]): Html::a('<span class="glyphicon glyphicon-ban-circle" ></span>', "#", [
                                    'title' => 'Alteração não permitida!',
                        ]);
                    },
                    'upload' => function ($url, $model) {
                            return $model->status_id <> 98 ?  Html::a('<span class="glyphicon glyphicon-upload" ></span>', $url, [
                                        'title' => 'Anexar Arquivo',
                                        //'class'=>'btn btn-primary btn-xs',                                
                        ]) : '';
                    },
                ],

            ],
        ],
    ]); ?>

</div>
