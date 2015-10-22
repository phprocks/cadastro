<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use app\models\Status;

//use app\models\Solicitation;

?>
<div class="row">
<h2>Quantidade de Solicitações Concluídas por Cadastrista</h2>
    	<hr/>
    <div class="col-xs-6 col-md-3">
        <?php  echo $this->render('_menu'); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-9">
	    <div class="panel panel-default">
	    	<div class="panel-heading clearfix">
			<div class="col-xs-2 pull-right">		
				<?php
                $array = [
                    ['id' => '01', 'name' => 'Janeiro'],
                    ['id' => '02', 'name' => 'Fevereiro'],
                    ['id' => '03', 'name' => 'Março'],
                    ['id' => '04', 'name' => 'Abril'],
                    ['id' => '05', 'name' => 'Maio'],
                    ['id' => '06', 'name' => 'Junho'],
                    ['id' => '07', 'name' => 'Julho'],
                    ['id' => '08', 'name' => 'Agosto'],
                    ['id' => '09', 'name' => 'Setembro'],
                    ['id' => '10', 'name' => 'Outubro'],
                    ['id' => '11', 'name' => 'Novembro'],
                    ['id' => '12', 'name' => 'Dezembro'],
                ];
                //$result = ArrayHelper::map($array, 'id', 'name');
                $this->registerJs('var submit = function (val){if (val > 0) {
                    window.location.href = "' . Url::to(['/report/by_analyst']) . '&mounth=" + val;
                }
                }', View::POS_HEAD);
               echo Html::activeDropDownList($model, 'mounth', ArrayHelper::map($array, 'id', 'name'),['onchange'=>'submit(this.value);','class'=>'form-control']);
                ?>
            </div>
	    	</div>
	  		<div class="panel-body">
			<?php
 //var_dump($dataProvider->getModels('quantidade'));
 //var_dump($dataProvider->getKeys('quantidade'));
			    ?>
				<?= GridView::widget([
				    'dataProvider' => $dataProvider,
				    'tableOptions' => ['class'=>'table table-striped'],
				    'emptyText'    => '</br><p class="text-danger">Nenhum resultado encontrado!</p>',
				    'summary'      =>  '',
				    'showFooter'   => true,
				    'showHeader'   => true,
				    'columns' => [
				            [
				               'attribute'=>'username',
				               'label'=>'Usuário',
				               'format' => 'raw',
				               'value'=>function ($data) {
				                    return $data["username"];
				                },
				                'contentOptions'=>['style'=>'width: 50%;text-align:left'],
				                'footer' => 'Total',
				                'footerOptions' => ['style'=>'text-align:left;font-weight: bold'],
				            ],
				            [
				               'attribute'=>'quantidade',
				               'label'=>'Concluídas',
				               'format' => 'raw',
				               'value'=>function ($data) {
				                    return $data["quantidade"];
				                },
				                'contentOptions'=>['style'=>'width: 50%;text-align:left'],
				                'footer' => $totalCount,
				                'footerOptions' => ['style'=>'text-align:left;font-weight: bold'],
				            ],		
				    ],
				    ]); ?>
				    </div>
				    </div>
				    <p class="text-muted">* A partir de Novembro 2015, este relatório considera a data em que a solicitação foi concluído</p>	
    </div>

</div>