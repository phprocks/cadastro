	<?php

    use yii\bootstrap\Nav;

            echo Nav::widget([
                'activateItems' => true,
                'encodeLabels' => false,
                'items' => [
                    [
                        'label'   => 'Visão Geral',
                        'url'     => ['/solicitation/dashboard'],
                    ],
                    [
                        'label'   => 'Agências x Situação',
                        'url'     => ['/solicitation/by_location'],
                    ],
                    [
                        'label'   => 'Solicitações x Cadastrista', //grafico pizza
                        'url'     => ['/solicitation/by_analyst'],
                    ],
                    // [
                    //     'label'   => 'Visao geral > Média mensal',
                    //     'url'     => ['/solicitation/by_analyst'],
                    // ],  
                    [
                        'label'   => 'Situação x Equipe',
                        'url'     => ['/solicitation/by_status'],
                    ],                                      
                ],
                'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
            ]);
	?>