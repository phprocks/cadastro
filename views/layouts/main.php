<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Cadastro</title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl;?>/images/favicon.ico">
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Apoio Cadastro',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => '<i class="fa fa-upload"></i> Solicitar Cadastro', 'url' => ['/solicitation/create'], 'visible'=> Yii::$app->user->isGuest,],
                    ['label' => '<i class="fa fa-file-pdf-o"></i> Acompanhar Solicitações', 'url' => ['/solicitation/index'], 'visible'=> Yii::$app->user->isGuest,],
                    ['label' => '<i class="fa fa-line-chart"></i> Relatórios', 'url' => ['/solicitation/dashboard']],
                    //['label' => '<i class="fa fa-life-ring"></i> Ajuda', 'url' => ['/site/index']],                    
                    Yii::$app->user->isGuest ?
                    ['label' => '<i class="fa fa-user"></i> Cadastristas', 'url' => ['/tasks/index']] : 
                    ['label' => '<i class="fa fa-user"></i> Cadastristas ('. Yii::$app->user->displayName.')',
                    'items' => 
                        [
                            ['label' => '<i class="fa fa-briefcase"></i> Solicitações', 'url' => ['/tasks/index']],
                            //['label' => '<i class="fa fa-briefcase"></i> '.Yii::t('app', 'Profile'), 'url' => ['/user/profile']],
                            //'<li class="divider"></li>',
                            ['label' => '<i class="fa fa-unlock"></i> Sair',
                                'url' => ['/user/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ],
                        ],
                    ],
                    //['label' => 'About', 'url' => ['/site/about']],
                    // Yii::$app->user->isGuest ?
                    //     ['label' => '<i class="fa fa-lock"></i> Administrador', 'url' => ['/user/login']] :
                    //     ['label' => '<i class="fa fa-logout"></i> Sair (' . Yii::$app->user->identity->username . ')',
                    //         'url' => ['/user/logout'],
                    //         'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container" align="center">Apoio Cadastro - Versão 1.1 - &copy; Sicoob Crediriodoce - Tecnologia da Informação - <?= date('Y') ?> - <?php echo Html::a('Administração do sistema', ['/site/administration']);?></p></div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
