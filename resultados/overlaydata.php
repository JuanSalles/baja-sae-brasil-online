<?php

use Baja\Model\Input;
use Baja\Model\InputQuery;
use Baja\Model\ProvaQuery;
use Baja\Model\EventoQuery;
use Baja\Model\ResultadoQuery;

$vars = [];
$i = InputQuery::create()->filterByEventoId($_REQUEST['evt'])->filterByProvaId('END')
    ->leftJoinEquipe()->withColumn('Equipe.Escola')->withColumn('Equipe.EquipeId')->withColumn('Equipe.Equipe')->withColumn('Equipe.EquipeCurto')->withColumn('Equipe.Estado')->withColumn('Equipe.Cidade')->withColumn('Equipe.EscolaCurto')->find();


foreach ($i as $input) {
  $dados  = (array)$input->getDados();
  array_push($vars, ["equipe_id"=>$input->getEquipeId(), "equipe"=>$input->getEquipeEquipeCurto(), "escola"=>$input->getEquipeEscolaCurto(), "lap_count"=>$dados["VOLTAS"], "best_lap"=>$dados["BEST"], "last_pass"=>$dados["LAST"], "estado"=>$input->getEquipeEstado(), "cidade"=>$input->getEquipeCidade()]);
}


function sorter_pos($a, $b) {
  if ($a["lap_count"] == $b["lap_count"]) {
    if ($a["last_pass"] == $b["last_pass"]) {
      return 0;
    }
    return ($a["last_pass"] < $b["last_pass"]) ? -1 : 1;
  }
  return ($a["lap_count"] < $b["lap_count"]) ? 1 : -1;
}

function sorter_team($a, $b) {
  if ($a["equipe_id"] == $b["equipe_id"]) {
    return 0;
  }
  return ($a["equipe_id"] < $b["equipe_id"]) ? -1 : 1;
}

if ($_REQUEST['order'] == 'pos') {
  usort($vars, 'sorter_pos');
} else {
  usort($vars, 'sorter_team');
}

echo(json_encode($vars));
