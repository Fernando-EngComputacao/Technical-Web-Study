<?php
//---------------------------------------------------------------------
  include 'phpexcel/Classes/PHPExcel.php';//Muda esse include
	include '../../conexao.php';
  //---------------------------------------------------------------------
  $excel = new PHPExcel();

  $sql = "select * from competicao where id = (select max(id) from competicao);";

  $resultado= mysqli_query($conexao, $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
	        ->setCellValue('A'.$i, $linha["id"])
	        ->setCellValue('B'.$i, $linha["nome"])
	        ->setCellValue('C'.$i, $linha["campus"])
	        ->setCellValue('D'.$i, $linha["data_abertura"])
	        ->setCellValue('E'.$i, $linha["data_encerramento"])
	        ->setCellValue('F'.$i, $linha["lim_atleta_campus"])
	        ->setCellValue('G'.$i, $linha["lim_modalidade_atleta"])
	        ->setCellValue('H'.$i, $linha["lim_campus"])
	        ->setCellValue('I'.$i, $linha["descricao"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from campus;";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
	        ->setCellValue('L'.$i, $linha["id"])
	        ->setCellValue('M'.$i, $linha["nome"])
	        ->setCellValue('N'.$i, $linha["sigla"])
	        ->setCellValue('O'.$i, $linha["uf"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from administrador where competicao_id = (select max(id) from competicao);";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
	        ->setCellValue('R'.$i, $linha["id"])
	        ->setCellValue('S'.$i, $linha["nome"])
	        ->setCellValue('T'.$i, $linha["cpf"])
	        ->setCellValue('U'.$i, $linha["email"])
	        ->setCellValue('V'.$i, $linha["status"])
	        ->setCellValue('W'.$i, $linha["competicao_id"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from modalidade where modalidade.competicao_id = (select max(id) from competicao);";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
	        ->setCellValue('Z'.$i, $linha["id"])
	        ->setCellValue('AA'.$i, $linha["nome"])
	        ->setCellValue('AB'.$i, $linha["descricao"])
	        ->setCellValue('AC'.$i, $linha["competicao_id"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from prova where modalidade_id = (select max(id) from competicao);";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
	        ->setCellValue('AF'.$i, $linha["id"])
	        ->setCellValue('AG'.$i, $linha["nome"])
	        ->setCellValue('AH'.$i, $linha["tipo"])
	        ->setCellValue('AI'.$i, $linha["qtd_max_atleta"])
	        ->setCellValue('AJ'.$i, $linha["descricao"])
	        ->setCellValue('AK'.$i, $linha["modalidade_id"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from professor where competicao_id = (select max(id) from competicao);";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
          ->setCellValue('AN'.$i, $linha["id"])
          ->setCellValue('AO'.$i, $linha["nome"])
          ->setCellValue('AP'.$i, $linha["cpf"])
          ->setCellValue('AQ'.$i, $linha["rg"])
          ->setCellValue('AR'.$i, $linha["telefone"])
          ->setCellValue('AS'.$i, $linha["email"])
          ->setCellValue('AT'.$i, $linha["num_suap"])
          ->setCellValue('AU'.$i, $linha["status"])
          ->setCellValue('AV'.$i, $linha["campus_id"])
          ->setCellValue('AW'.$i, $linha["competicao_id"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  $sql = "select * from atleta where atleta.professor_id in (select professor.id from professor where professor.competicao_id = (select max(id) from competicao));";

  $resultado= mysqli_query($conexao , $sql);
  $i = 3;

  while($linha = mysqli_fetch_array($resultado)){
    $excel->setActiveSheetIndex(0)
          ->setCellValue('AZ'.$i, $linha["id"])
          ->setCellValue('BA'.$i, $linha["nome"])
          ->setCellValue('BB'.$i, $linha["data_nascimento"])
          ->setCellValue('BC'.$i, $linha["sexo"])
          ->setCellValue('BD'.$i, $linha["cpf"])
          ->setCellValue('BE'.$i, $linha["rg"])
          ->setCellValue('BF'.$i, $linha["professor_id"]);

    $i ++;
  }
  //---------------------------------------------------------------------
  include 'estilo_planilha.php';
  //---------------------------------------------------------------------
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="Dados.xlsx"');
  header('Cache-Control: max-age=0');
  //---------------------------------------------------------------------
  $file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
  $file->save('php://output');
  //---------------------------------------------------------------------
?>
