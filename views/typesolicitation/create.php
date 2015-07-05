<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Typesolicitation */

$this->title = 'Create Typesolicitation';
$this->params['breadcrumbs'][] = ['label' => 'Typesolicitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typesolicitation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
