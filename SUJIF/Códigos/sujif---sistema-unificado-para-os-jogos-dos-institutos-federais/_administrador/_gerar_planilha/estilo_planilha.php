<?php
  $excel->setActiveSheetIndex(0)
        //---------------------------------------------------------------------
        ->setCellValue('A1', "COMPETIÇÃO")
        ->setCellValue('A2', "ID")
        ->setCellValue('B2', "NOME_COMPETIÇÃO")
        ->setCellValue('C2', "CAMPUS")
        ->setCellValue('D2', "DATA DE ABERTURA")
        ->setCellValue('E2', "DATA DE ENCERRAMENTO")
        ->setCellValue('F2', "LIMITE DE ATLETAS POR CAMPUS")
        ->setCellValue('G2', "LIMITE DE ATLETAS POR MODALIDADE")
        ->setCellValue('H2', "LIMITE DE CAMPUS")
        ->setCellValue('I2', "DESCRIÇÃO")
        //---------------------------------------------------------------------
        ->setCellValue('L1', "CAMPUS")
        ->setCellValue('L2', "ID")
        ->setCellValue('M2', "NOME_CAMPUS")
        ->setCellValue('N2', "SIGLA")
        ->setCellValue('O2', "UF")
        //---------------------------------------------------------------------
        ->setCellValue('R1', "ADMINISTRADOR")
        ->setCellValue('R2', "ID")
        ->setCellValue('S2', "NOME_ADMINISTRADOR")
        ->setCellValue('T2', "CPF")
        ->setCellValue('U2', "E-MAIL")
        ->setCellValue('V2', "STATUS")
        ->setCellValue('W2', "COMPETIÇÃO_ID")
        //---------------------------------------------------------------------
        ->setCellValue('Z1', "MODALIDADE")
        ->setCellValue('Z2',"ID")
        ->setCellValue('AA2',"NOME_MODALIDADE")
        ->setCellValue('AB2',"DESCRIÇÃO")
        ->setCellValue('AC2',"COMPETIÇÃO_ID")
        //---------------------------------------------------------------------
        ->setCellValue('AF1', "PROVA")
        ->setCellValue('AF2',"ID")
        ->setCellValue('AG2',"NOME_PROVA")
        ->setCellValue('AH2',"TIPO")
        ->setCellValue('AI2',"QTDE. MAX. DE ATLETAS")
        ->setCellValue('AJ2',"DESCRIÇÃO")
        ->setCellValue('AK2',"MODALIDADE_ID")
        //---------------------------------------------------------------------
        ->setCellValue('AN1',"PROFESSOR")
        ->setCellValue('AN2',"ID")
        ->setCellValue('AO2',"NOME_PROFESSOR")
        ->setCellValue('AP2',"CPF")
        ->setCellValue('AQ2',"RG")
        ->setCellValue('AR2',"TELEFONE")
        ->setCellValue('AS2',"E-MAIL")
        ->setCellValue('AT2',"NÚMERO DO SUAP")
        ->setCellValue('AU2',"STATUS")
        ->setCellValue('AV2',"CAMPUS_ID")
        ->setCellValue('AW2',"COMPETIÇÃO_ID")
        //---------------------------------------------------------------------
        ->setCellValue('AZ1',"ATLETA")
        ->setCellValue('AZ2',"ID")
        ->setCellValue('BA2',"NOME_ATLETA")
        ->setCellValue('BB2',"DATA DE NASCIMENTO")
        ->setCellValue('BC2',"SEXO")
        ->setCellValue('BD2',"CPF")
        ->setCellValue('BE2',"RG")
        ->setCellValue('BF2',"PROFESSOR_ID");
  //---------------------------------------------------------------------------
  $excel->getActiveSheet()->mergeCells('A1:I1');
  $excel->getActiveSheet()->mergeCells('L1:O1');
  $excel->getActiveSheet()->mergeCells('R1:W1');
  $excel->getActiveSheet()->mergeCells('Z1:AC1');
  $excel->getActiveSheet()->mergeCells('AF1:AK1');
  $excel->getActiveSheet()->mergeCells('AN1:AW1');
  $excel->getActiveSheet()->mergeCells('AZ1:BF1');
  //---------------------------------------------------------------------------
  $excel->getActiveSheet()->getStyle('A1:BF1')->getAlignment()->setHorizontal('center');
  $excel->getActiveSheet()->getStyle('A2:BF2')->getAlignment()->setHorizontal('center');
  //---------------------------------------------------------------------------
  $excel->getActiveSheet()->getStyle('A1:BF1')->applyFromArray(
    array(
      'font'=>array(
        'size'=> 14
      )
    )
  );
  //---------------------------------------------------------------------------
  $excel->getActiveSheet()->getStyle('A1:BF1')->applyFromArray(
    array(
      'font'=>array(
        'bold'=> true
      ),
      'borders'=>array(
        'allborders'=>array(
          'style'=> PHPExcel_Style_Border::BORDER_THIN
        )
      )
    )
  );
  //---------------------------------------------------------------------------
  $excel->getActiveSheet()->getStyle('A2:BF2')->applyFromArray(
    array(
      'font'=>array(
        'bold'=> true
      )
    )
  );
  //---------------------------------------------------------------------------
?>
