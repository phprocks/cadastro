<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Typeperson;
use app\models\Status;
use app\models\Typesolicitation;
use amnah\yii2\user\models\User;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações';
?>
<div class="tasks-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php //echo $this->render('_search', ['model' => $searchModel]); 

    echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Outras opções de filtro',
            'content' => $this->render('_search', ['model' => $searchModel]),
            // open its content by default
            //'contentOptions' => ['class' => 'in']
        ],
    ]
]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-danger">Nenhuma solicitação encontrada!</p>',     
        'summary' => "<p class=\"text-primary \">Existem {totalCount} solicitações no sistema </p>",     
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_id == 98)
                {
                    return ['class' => 'text-muted'];
                }
            },
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
             //'filter' => DatePicker::widget(['language' => 'pt', 'dateFormat' => 'yyyy-MM-dd']),
             //'format' => 'html',
            ],
            [
             'attribute' => 'location_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->location->nickname;
                    },
             'filter' => ArrayHelper::map(Location::find()->orderBy('nickname')->asArray()->all(), 'id', 'nickname'),
             'contentOptions'=>['style'=>'width: 4%;text-align:left'],
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
             'attribute' => 'cpf_cnpj',
             'contentOptions'=>['style'=>'width: 4%;text-align:right'],
            ],              
            [
             'attribute' => 'typeperson_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->typeperson->name;
                    },
             'filter' => ArrayHelper::map(Typeperson::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
             'contentOptions'=>['style'=>'width: 15%;text-align:left'],
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
            // 'location_id',
            // 'cpf_cnpj',
            // 'notes:ntext',
            // 'note_analyst:ntext',
            // 'file_cpf',
            // 'file_cartao_assinatura',
            // 'file_comprovante_residencia',
            // 'file_outro_endereco',
            // 'file_imposto_renda',
            // 'file_comp_estado_civil',

            [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions'=>['style'=>'width: 6%;text-align:right'],
            'template' => '{view} {update}',
            //              'buttons' => [
            //      'upload' => function ($url, $model) {
            //             return $model->cpf_cnpj <> 0 ? Html::a('<span class="glyphicon glyphicon-folder-open" ></span>', $url, [
            //                         'title' => 'Anexos',
            //                         //'class'=>'btn btn-primary btn-xs',                                
            //             ]) : '';
            //     },
            //     ],

            ],
        ],
    ]); ?>

</div>
