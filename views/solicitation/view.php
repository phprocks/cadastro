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
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */

$this->title = "Solicitação #".$model->id;
?>
<div class="solicitation-view">

    <h2><span><i class="fa fa-newspaper-o"></i> <?= Html::encode($this->title) ?></span>
    <div class="pull-right">

    <?php
    if ($model->status_id !== 98){
        echo Html::a('<i class="fa fa-pencil-square-o"></i> Alterar Informações', ['update', 'id' => $model->id], ['class' => 'btn btn-success']);
        } else {
            echo "<h4 class=\"text-danger\"><em>Não é permitido alterações quando a solicitação está CANCELADA ou CONCLUÍDA</em></h4>";
        }
    ?>

    </div>
    </h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [ 
              'label' => 'Solicitado em',
              'format' => 'raw',
              'value' => $model->updated <> '' ? date("d/m/Y",  strtotime($model->created))." <em>(Última alteração em ".date("d/m/Y",  strtotime($model->updated)).")</em>"."<span class=\"text-muted pull-right\"><i class=\"fa fa-desktop\"></i> ".$model->ip."</span>" : date("d/m/Y",  strtotime($model->created))."<span class=\"text-muted pull-right\"><i class=\"fa fa-desktop\"></i> ".$model->ip."</span>",
            ],
            [ 
              'label' => 'Solicitado por',
              'format' => 'raw',
              'value' => $model->user->username." <em>(".$model->location->fullname.")</em>",
            ],
            [ 
              'label' => 'Situação',
              'format' => 'raw',
              'value' => '<span style="color:'.$model->status->color.'"><i class="fa fa-circle"></i> '.$model->status->name.'</span>',
            ],     
            [ 
              'label' => 'Concluído em',
              'format' => 'raw',
              'value' => date("d/m/Y",  strtotime($model->closed)),
              'visible' => $model->closed <> null ? true : false,
            ],                  
            [ 
              'label' => 'Tipo',
              'format' => 'raw',
              'value' => $model->typeperson->name." / ".$model->typesolicitation->name,
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
    <a name="checklist"></a>
    <h2><i class="fa fa-list-alt"></i> Arquivos</span>
    <div class="pull-right">

    <?php 
    if ($model->status_id !== 98){
        echo Html::a('<i class="fa fa-cloud-upload"></i> Enviar Arquivos', ['/files/create', 'id' => $model->id], ['class' => 'btn btn-success']) ;
    }
    ?>

    </div>
    </h2>

    <?php if ($flash = Yii::$app->session->getFlash("file-success")): ?>

        <div class="alert alert-success">
            <p class="text-center"><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <div class="row">
        <!-- Inicio Checklist -->
        <div class="col-xs-5">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Use o checklist abaixo para se orientar</strong></div>
              <div class="panel-body">
                <?php            
                if($model->typeperson_id !== 99){
                    echo $this->render('_pf', [
                    'model' => $model,
                    ]);
                } else {
                    echo $this->render('_pj', [
                    'model' => $model,
                    ]);
                }
                ?>
              </div>
            </div>
        <!-- Fim Gridview -->
        </div>

        <!-- Inicio Gridview -->
        <div class="col-xs-7">
        <?php
    $dataProvider = new SqlDataProvider([
        'sql' => "SELECT id, solicitation_id, attachment  FROM tb_files WHERE solicitation_id = ".$model->id." ORDER BY attachment ASC",
        'totalCount' => 200,
        'sort' =>false,
        'key'  => 'id',
        'pagination' => [
            'pageSize' => 200,
        ],
    ]);
    ?>
    <?php Pjax::begin(['id' => 'pjax-container']) ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'emptyText'    => '</br><p class="text-danger">Nenhum arquivo anexado!</p>',
    'summary'      =>  '',
    'showHeader'   => false,
    'columns' => [
            [
               'attribute'=>'attachment',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data["attachment"],Yii::getAlias('@open')."/".$data["solicitation_id"]."/".$data["attachment"], ['target' => '_blank']);
                },
                'contentOptions'=>['style'=>'width: 70%;text-align:left'],
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions'=>['style'=>'width: 10%;text-align:center'],
            'controller' => 'files',
            'template' => '{delete}',
            'buttons' => [
                        'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                            'title' => 'Excluir Anexo',
                            'aria-label' => 'Excluir',
                            'onclick' => "
                                if (confirm('Comfirma exclusão do anexo?')) {
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#pjax-container'});
                                    });
                                }
                                return false;
                            ",
                        ]);
                    },


            ],
        ],
    ],
    ]); ?>
    <?php Pjax::end() ?>
        <!-- Fim Gridview -->
        </div>
    </div>    

</div>
