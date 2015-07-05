<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Bem-vindo';
?>
<div class="site-about">
    <h2><?= Html::encode($this->title) ?></h2>
    <hr/>
    <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Para o correto funcionamento do sistema, utilize os navegadores <strong>FIREFOX</strong>, <strong>GOOGLE CHROME</strong> ou versões recentes do <strong>INTERNET EXPLORER</strong></div>
    <p>
    A ferramenta <em>APOIO CADASTRO</em> tem como objetivo auxiliar o processo de cadastro, organizando as solicitações e arquivos enviados para que a confecção do cadastro seja feita de forma adequada.
    </p>
    <p>Assim como é feito atualmente na ferrameta <em>ANALISE</em>, o sistema é divido em 2 perfis de acesso diferentes:</p>
    
    </br>
    
    <div class="media">
  		<div class="media-left">
    		<img class="media-object" src="/cadastro/web/images/user-solicitation.png" alt="Solicitante">
  		</div>
  		<div class="media-body">
    		<h4 class="media-heading">Solicitante</h4>
    		<p>Para uma maior agilidade na utilização do sistema, o solicitante não precisa fornecer nenhuma autenticação</p>
    		Basta apenas utilizar a opção <?= Html::a('Solicitar Cadastro', ['/solicitation/create'], ['class'=>'btn btn-success btn-xs']) ?> e selecionar seu usuário na lista para enviar uma nova solicitação, e logo em seguida anexar os arquivos no formulário.</p> 
    		<p>
    		Caso deseje acompanhar ou alterar uma solicitação, utilize a opção <?= Html::a('Acompanhar Solicitações', ['/solicitation/index'], ['class'=>'btn btn-success btn-xs']) ?> e então selecione o seu usuário e o número da solicitação.
    </p>
  		</div>
	</div>
	</br>
    <div class="media">
		<div class="media-left">
		<img class="media-object" src="/cadastro/web/images/user-analyst.png" alt="Cadastristas">
		</div>
		<div class="media-body">
		<h4 class="media-heading">Cadastristas</h4>
		Os cadastristas deverão entrar com usuário e senha que lhes foi concedido e clicar em Solicitações para visualizar a lista de solicitações de cadastro.
  		</div>
	</div>
</div>