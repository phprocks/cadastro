<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use amnah\yii2\user\models\User;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Files;
use app\models\FilesSearch;
use yii\data\SqlDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = "Solicitação #".$model->id;
?>
<div class="tasks-view">

    <h2><i class="fa fa-newspaper-o"></i> <?= Html::encode($this->title) ?>
      <div class="pull-right">
        <?= Html::a('<i class="fa fa-pencil-square-o"></i> Alterar Situação', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </div>
    </h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [ 
              'label' => 'Solicitado em',
              'format' => 'raw',
              'value' => $model->updated <> '' ? date("d/m/Y",  strtotime($model->created))." <em>(Alterado em ".date("d/m/Y",  strtotime($model->updated)).")</em>"."<span class=\"text-muted pull-right\"><i class=\"fa fa-desktop\"></i> ".$model->ip."</span>" : date("d/m/Y",  strtotime($model->created))."<span class=\"text-muted pull-right\"><i class=\"fa fa-desktop\"></i> ".$model->ip."</span>",
            ],
            [ 
              'label' => 'Solicitado por',
              'format' => 'raw',
              'value' => $model->user->username." <em>(".$model->location->fullname.")</em>",
            ],
            [ 
              'label' => 'Tipo',
              'format' => 'raw',
              'value' => $model->typeperson->name." / ".$model->typesolicitation->name,
            ],
            [ 
              'label' => 'Situação',
              'format' => 'raw',
              'value' => '<span style="color:'.$model->status->color.'"><i class="fa fa-circle"></i> '.$model->status->name.'</span>',
            ],
            //'user.username',
            //'typeperson.name',
            //'typesolicitation.name',
            'cpf_cnpj',
            'notes:ntext',
            'note_analyst:ntext',
        ],
    ]) ?>

    <?php 
    if($model->typeperson_id != 99){
      // show the widget
      echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'scholarity',
            'occupation',
            'job_firm',
            'job_role',
            'job_phone',
            'job_admission_date',
            'spouse_cpf',
            'reference',
        ],
    ]); 
    }
    ?>

    <h2><i class="fa fa-list-alt"></i> Arquivos</span></h2>

    <?php
    $dataProvider = new SqlDataProvider([
        'sql' => "SELECT id, solicitation_id, attachment  FROM tb_files WHERE solicitation_id = ".$model->id." ORDER BY id DESC",
        'totalCount' => 200,
        'sort' =>false,
        'key'  => 'id',
        'pagination' => [
            'pageSize' => 200,
        ],
    ]);
    ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'emptyText'    => '</br><p class="text-danger">Nenhum arquivo anexado!</p>',
    'summary'      =>  '',
    'showHeader'   => false,
    'columns' => [
            //'id',
            //'solicitation_id',
            //'attachment',
            [
               'attribute'=>'attachment',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data["attachment"],Yii::getAlias('@open')."/".$data["solicitation_id"]."/".$data["attachment"], ['target' => '_blank']);
                },
                'contentOptions'=>['style'=>'width: 70%;text-align:left'],
            ],
            // [
            // 'class' => 'yii\grid\ActionColumn',
            // 'contentOptions'=>['style'=>'width: 30%;text-align:left'],
            // 'controller' => 'files',
            // 'template' => '{delete}',
            // 'buttons' => [
            //     'delete' => function ($url, $model) {
            //         return Html::a('<span class="fa fa-trash-o"></span>', $url, [
            //                     'title' => 'Excluir',       
            //                     'data-confirm' => Yii::t('yii', 'Deseja realmente excluir este Anexo?'),
            //                     'data-method' => 'post',
            //                     'data-pjax' => '0',                         
            //         ]);
            //     }, 

            // ],
            // ],
    ],
    ]); ?>

</div>
