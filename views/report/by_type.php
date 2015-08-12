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
<h2>Quantidade x Tipo de Solicitação</h2>
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
                    window.location.href = "' . Url::to(['/report/by_type']) . '&mounth=" + val;
                }
                }', View::POS_HEAD);
               echo Html::activeDropDownList($model, 'mounth', ArrayHelper::map($array, 'id', 'name'),['onchange'=>'submit(this.value);','class'=>'form-control']);
                ?>
            </div>
	    	</div>
		  		<div class="panel-body">
		  		<?php if ($Cadastro[0] > 0) : ?>
		  		<div class="row">
					  <div class="col-md-6">
					  	<table class="table table-striped">
					  	<tr>
			  				<td></td>
			  				<td><strong>Quantidade</strong></td>
			  			</tr>
			  			<tr>
			  				<td>Cadastro</td>
			  				<td><?php echo $Cadastro[0];?></td>
			  			</tr>
			  			<tr>
			  				<td>Correcao</td>
			  				<td><?php echo $Correcao[0];?></td>
			  			</tr>
			  			<tr>
			  				<td>Renovacao</td>
			  				<td><?php echo $Renovacao[0];?></td>
			  			</tr>			  			
			  			<tr>
			  				<td>Regularizacao</td>
			  				<td><?php echo $Regularizacao[0];?></td>
			  			</tr>			  					  			
			  			</table>
					  </div>
				  <div class="col-md-6">
				  <?php
		  		//var_dump($concluido);
		  		echo Highcharts::widget([
                'options' => [
                    'plotOptions ' => 'pie',
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 300,
                    ],
                    'title' => ['text' => ''],
                    'colors'=> ['#177c83','#27cdd9','#1fa4ae','#52d7e0','#7ee1e8','#a9ebf0'],
                    'tooltip'=> ['pointFormat'=> 'Percentual: <b>{point.percentage:.1f}%</b>'],
                    'plotOptions'=> [
                        'pie'=> [
                          'allowPointSelect'=> true,
                          'cursor'=> 'pointer',
                          'dataLabels'=> [
                          'enabled'=> true,
                          ],
                        'showInLegend'=> [
                          'enabled'=> true,
                          ]
                        ]
                    ],
                    'series'=> [[
                        'type'=> 'pie',
                        'name'=> 'Valor',
                        'data'=> [
                            ['Cadastro', $Cadastro[0]],
                            ['Correcao', $Correcao[0]],
                            ['Renovacao', $Renovacao[0]],
                            ['Regularizacao', $Regularizacao[0]],
                        ]
                    ]]
                ]
                ]);
		  		?>
		  		</div>
				</div><?php endif; ?>
		  		
		  		
			    </div>
		    </div>	
    </div>

</div>