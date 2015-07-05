<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
$this->title = 'Administração do Sistema';
?>
<div class="site-about">

<div class="row">
	<div class="col-md-5">
	<h2><i class="fa fa-wrench"></i> <?= Html::encode($this->title) ?></h2>
	<hr/>
	<?php
            echo Nav::widget([
                'activateItems' => true,
                'encodeLabels' => false,
                'items' => [
                    [
                        'label'   => '<strong><i class="fa fa-circle"></i> Usuários</strong>',
                        'url'     => ['/user/admin'],
                    ],
                    [
                        'label'   => '<strong><i class="fa fa-circle"></i> Local</strong>',
                        'url'     => ['/location/index'],
                    ],
                    [
                        'label'   => '<strong><i class="fa fa-circle"></i> Tipo Pessoa</strong>',
                        'url'     => ['/typeperson/index'],
                    ],
                    [
                        'label'   => '<strong><i class="fa fa-circle"></i> Tipo Solicitação</strong>',
                        'url'     => ['/typesolicitation/index'],
                    ],
                    [
                        'label'   => '<strong><i class="fa fa-circle"></i> Situação</strong>',
                        'url'     => ['/status/index'],
                    ],
                ],
                'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
            ]);
	?>
	<h2><i class="fa fa-pie-chart"></i> Informações</h2>
	<hr/>
<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name . ' - Infomações do Sistema';

?>
<?php
function getDirectorySize($path)
{
  $totalsize = 0;
  $totalcount = 0;
  $dircount = 0;
  if ($handle = opendir ($path))
  {
    while (false !== ($file = readdir($handle)))
    {
      $nextpath = $path . '/' . $file;
      if ($file != '.' && $file != '..' && !is_link ($nextpath))
      {
        if (is_dir ($nextpath))
        {
          $dircount++;
          $result = getDirectorySize($nextpath);
          $totalsize += $result['size'];
          $totalcount += $result['count'];
          $dircount += $result['dircount'];
        }
        elseif (is_file ($nextpath))
        {
          $totalsize += filesize ($nextpath);
          $totalcount++;
        }
      }
    }
  }
  closedir ($handle);
  $total['size'] = $totalsize;
  $total['count'] = $totalcount;
  $total['dircount'] = $dircount;
  return $total;
}

function sizeFormat($size)
{
    if($size<1024)
    {
        return $size." bytes";
    }
    else if($size<(1024*1024))
    {
        $size1=round($size/1024,1);
        return $size1." KB";
    }
    else if($size<(1024*1024*1024))
    {
        $size1=round($size/(1024*1024),1);
        return $size1." MB";
    }
    else
    {
        $size1=round($size/(1024*1024*1024),1);
        return $size1." GB";
    }

}

function sizeFormat1($size)
{
        return $size;
}

$path="../../Anexos_Apoio_Cadastro/";
$ar=getDirectorySize($path);

//echo "<h4>Details for the path : $path</h4>";
//echo "Tamanho Total : ".sizeFormat($ar['size'])."<br>";
//echo "No. de bobinas : ".$ar['count']."<br>";
//echo "No. of directories : ".$ar['dircount']."<br>";

$percent = (sizeFormat1($ar['size']) * 100 ) / 681392000 ;

?>

    <?php
   // echo "<strong>Tamanho Total da pasta:</strong> ".sizeFormat($ar['size'])."<br>";
   // echo "<strong>Espaço máx. recomendado:</strong> 500MB<br>";
    

    $espaço = sizeFormat($ar['size']);
    $valor  = ($espaço * 100)/500;

    if ($valor < 70) {
        $cor = "progress-bar progress-bar-info";
    } elseif ($valor >= 70 && $valor < 90) {
        $cor = "progress-bar progress-bar-warning";
    } elseif ($valor >= 90) {
        $cor = "progress-bar progress-bar-danger";
    }

    ?>
    </p>

    <ul class="list-group">
      <li class="list-group-item">Quantidade de arquivos armazenados: <span class="badge"><?php echo $ar['count']; ?></span></li>
      <li class="list-group-item">Tamanho Total da pasta: <span class="badge"><?php echo sizeFormat($ar['size']); ?></span></li>
      <li class="list-group-item">Espaço máx. recomendado: <span class="badge">500 MB</span></li>
    </ul>
    Percentual de espaço ocupado: 
    <div class="progress">
      <div class="<?php echo $cor; ?>" role="progressbar" aria-valuenow="<?php echo $valor; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $valor; ?>%;">
        <?php echo $valor."%"; ?>
      </div>
    </div>





	</div>
	<div class="col-md-7">
	<h2><i class="fa fa-align-justify"></i> Changelog</h2>
	<hr/>
[x] Gravar IP (Inclusão ou alteração)</p>
[x] Alterar checklist com nomes (Lista enviada por E-mail)</p>
[ ] Incluir opções de filtro para TASKS/INDEX (incluir checkbox para CONCLUÍDO E CANCELADO)</p>
[x] Alterar caminho da pasta UPLOAD para mesmo nível do www</p>
[x] Relatórios e gráficos</p>
[x] Criar área de Administração do sistema</p>
[x] Upload livre para usuario baseado em uma lista pre definida</p>
[ ] Limpar pasta upload periodicamente</p>
[x] Incluir STATUS Cancelado (Solicitante nao podera alterar informações)</p>
[x] Campo adicional - <code>Escolaridade</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Profissão</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Empresa onde trabalha</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Cargo ocupado</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Telefone do trabalho</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Data de Admissão</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>CPF Conjuge</code> (Obrigatorio exceto PJ)</p>
[x] Campo adicional - <code>Referencia</code> (Obrigatorio)</p>
	</div>
</div>

    


</div>
