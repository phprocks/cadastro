<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <!-- Inicio Form -->
    <div class="col-xs-6">
        <div class="files-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?php

    $t = Yii::$app->getRequest()->getQueryParam('id');

    ?>

    <?= Html::activeHiddenInput($model, 'solicitation_id', ['value' => $t]) ?>

    <?php //$form->field($model, 'checklist_name')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'checklist_name')->dropDownList([
            'DOCUMENTO_DE_IDENTIFICACAO' => 'DOCUMENTO DE IDENTIFICAÇÃO',
            'COMPROVANTE_DE_RELACIONAMENTO' => 'COMPROVANTE DE RELACIONAMENTO',
            'COMPROVANTE_DE_ENDERECO'  => 'COMPROVANTE DE ENDEREÇO',
            'DECLARACAO_DE_ENDERECO' => 'DECLARAÇÃO DE ENDEREÇO',
            'COMPROVANTE_DE_RENDA' => 'COMPROVANTE DE RENDA',
            'REGISTRO_DE_BENS_MOVEIS_IMOVEIS' => 'REGISTRO DE BENS MOVEIS/IMOVEIS',
            'CARTAO_CNPJ' => 'CARTÃO CNPJ',
            'INSCRICAO_ESTADUAL' => 'INSCRIÇÃO ESTADUAL',
            'CONTRATO_SOCIAL' => 'CONTRATO SOCIAL',
            'COMPROVANTE_DE_FATURAMENTO' => 'COMPROVANTE DE FATURAMENTO ',
            'INSCRICAO_DE_PRODUTOR_RURAL' => 'INSCRIÇÃO DE PRODUTOR RURAL',
            'FICHA_SANITARIA' => 'FICHA SANITARIA',
            'CONTRADO_DE_ARRENDAMENTO' => 'CONTRADO DE ARRENDAMENTO',
            'PROCURACAO' => 'PROCURAÇÃO',
            'ATA_ASSEMBLEIA' => 'ATA ASSEMBLEIA',
            'CONVECAO_ESTATUTO' => 'CONVEÇÃO ESTATUTO',
            'OUTROS' => 'OUTROS',
    ]); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o"></i> Enviar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    <!-- Final Form -->
    </div>
    <!-- Inicio Form -->
    <div class="col-xs-6">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Dicas & Informações</strong></div>
              <div class="panel-body">
                <ul>
                  <li>Utilize a o formato Preto & Branco ou Escala de Cinza, com 200 DPI para obter um arquivo de tamanho menor ao digitalizar</li></p>
                  <li>O arquivo enviado será renomeado de acordo com o nome selecionado</li>
                  
                </ul>
              </div>
            </div>
    <!-- Final Form -->
    </div>
</div>



