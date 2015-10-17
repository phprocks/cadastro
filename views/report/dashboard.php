<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\web\View;
?>
<div class="row">
<h2>Visão Geral</h2>
    	<hr/>
    <div class="col-xs-6 col-md-3">

        <?php  echo $this->render('_menu'); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-9">
<!--         <div class="row">
        <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge">14</span>
                    Cras justo odio
                  </li>
                </ul>
        </div></div> -->
                
    <div class="panel panel-default">
            <div class="panel-heading clearfix">
            <div class="col-xs-2 pull-right">       
                <?php
                $array = [
                    ['id' => '2014', 'name' => '2014'],
                    ['id' => '2015', 'name' => '2015'],
                    ['id' => '2016', 'name' => '2016'],
                ];
                //$result = ArrayHelper::map($array, 'id', 'name');
                $this->registerJs('var submit = function (val){if (val > 0) {
                    window.location.href = "' . Url::to(['/report/dashboard']) . '&year=" + val;
                }
                }', View::POS_HEAD);
               echo Html::activeDropDownList($model, 'year', ArrayHelper::map($array, 'id', 'name'),['onchange'=>'submit(this.value);','class'=>'form-control']);
                ?>
            </div>
            </div>
        <div class="panel-body">
                <?php
                echo Highcharts::widget([

                    'options' => [
                        'credits' => ['enabled' => false],
                        'title' => [
                            'text' => '',
                        ],
                        'colors'=> ['#177c83','#27cdd9'],
                        'xAxis' => [
                            //'categories' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Nov', 'Dez'],
                            'categories' => $m,
                        ],
                        'yAxis' => [
                            'min' => 0,
                            'title' => '',
                        ],                        
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'Solicitações',
                                'data' => $quantity,
                            ],
                            // [
                            //     'type' => 'spline',
                            //     'name' => 'Evolução',
                            //     'data' => $quantity,
                            //     'marker' => [
                            //         'lineWidth' => 2,
                            //         'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
                            //         'fillColor' => 'white',
                            //     ],
                            // ],                           
                        ],
                    ]
                ]);
                ?>
                </div>
                </div>
            </div>

    </div>

</div>