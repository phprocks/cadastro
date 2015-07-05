<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

?>
<div class="row">
<h2>Quantidade de Solicitações por Agência x Situação</h2>
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
                    window.location.href = "' . Url::to(['/solicitation/by_location']) . '&mounth=" + val;
                }
                }', View::POS_HEAD);
               echo Html::activeDropDownList($model, 'mounth', ArrayHelper::map($array, 'id', 'name'),['onchange'=>'submit(this.value);','class'=>'form-control']);
                ?>
            </div>
	    	</div>
	  		<div class="panel-body">
			<?php
            echo Highcharts::widget([

                'options' => [
                    'credits' => ['enabled' => false],
                    'chart' => [
                    	'type' => 'bar',
                    ],
                    'title' => [
                        'text' => '',
                    ],
                    'colors'=> ['#282828','#1045A0','#A81212','#DB5700','#777777','#095B11'],
                    'xAxis' => [
                        'categories' => $locations,
                    ],
                    'yAxis' => [
                    	'min' => 0,
                        'title' => 'hhh',
                    ],
                    'legend' => [
            			'reversed' => true
        			],
        			'plotOptions' => [
        				'series' => [
        					'stacking' => 'normal',
        				]
        			],
                    'series' => [
                        [
                            'name' => 'Aguardando',
                            'data' => $qt1,
                        ],
                        [
                            'name' => 'Em andamento',
                            'data' => $qt2,
                        ],                        
                        [
                            'name' => 'Pendência',
                            'data' => $qt3,
                        ],   
                        [
                            'name' => 'Alterado',
                            'data' => $qt4,
                        ], 
                        [
                            'name' => 'Cancelado',
                            'data' => $qt98,
                        ], 
                        [
                            'name' => 'Concluído',
                            'data' => $qt99,
                        ],                                                                                              
                    ],
                ]
            ]);
			?>
            <?php if (count($locations) > 0): ?>
            <table class="table table-bordered table-condensed text-center">
                <tr><td></td>
                    <?php
                    $x = 0;
                    foreach($locations as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }
                        echo '<td><strong>'.$v.'</strong></td>';
                        $x++;
                    }
                    ?>
                </tr>
                <tr style="color:#282828"><td>Aguardando</td>
                    <?php
                    $x = 0;
                    foreach($qt1 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }
                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>
                <tr style="color:#1045A0"><td>Em andamento</td>
                    <?php
                    $x = 0;
                    foreach($qt2 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }

                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>  
                <tr style="color:#A81212"><td>Pendência</td>
                    <?php
                    $x = 0;
                    foreach($qt3 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }

                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>  
                <tr style="color:#DB5700"><td>Alterado</td>
                    <?php
                    $x = 0;
                    foreach($qt4 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }

                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>   
                <tr style="color:#777777"><td>Cancelado</td>
                    <?php
                    $x = 0;
                    foreach($qt98 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }

                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>   
                <tr style="color:#095B11"><td>Concluído</td>
                    <?php
                    $x = 0;
                    foreach($qt99 as $v){
                        if ($x % 1 == 0 && $x != 0){
                            //echo '</tr><tr>';
                        }

                        echo '<td>'.$v.'</td>';
                        $x++;
                    }
                    ?>
                </tr>          
            </table><?php endif; ?> 
			</div>
		</div>
    </div>

</div>