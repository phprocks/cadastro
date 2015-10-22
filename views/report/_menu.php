	<?php

    use yii\bootstrap\Nav;

            echo Nav::widget([
                'activateItems' => true,
                'encodeLabels' => false,
                'items' => [
                    [
                        'label'   => 'Visão Geral',
                        'url'     => ['/report/dashboard'],
                    ],
                    [
                        'label'   => 'Personalizado',
                        'url'     => ['/report/index'],
                    ],                      
                    [
                        'label'   => 'Agências x Situação',
                        'url'     => ['/report/by_location'],
                    ],
                    [
                        'label'   => 'Solicitações x Cadastrista', //grafico pizza
                        'url'     => ['/report/by_analyst'],
                    ],
                    // [
                    //     'label'   => 'Visao geral > Média mensal',
                    //     'url'     => ['/solicitation/by_analyst'],
                    // ],  
                    [
                        'label'   => 'Situação por Período',
                        'url'     => ['/report/by_status'],
                    ],     
                    [
                        'label'   => 'Tipo por Período',
                        'url'     => ['/report/by_type'],
                    ],                                                       
                ],
                'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
            ]);
	?>