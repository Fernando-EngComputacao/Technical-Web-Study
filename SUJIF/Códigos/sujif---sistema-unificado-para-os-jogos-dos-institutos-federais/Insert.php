<?php
  include "conexao.php";

  $sql = "insert into competicao values(null, 'Atletismo', 'Instituto Federal Goiano - Campus Ceres', '2018-01-01', '2019-01-01', 10, 10, 10, 'O atletismo será dividido nas seguintes modalidades: cross-country e marcha atlética. Essas modalidade teram as seguintes provas: Corrida e Marcha de 20 km');";
  mysqli_query($conexao, $sql);

  $sql = "insert into campus value(null,'Instituto Federal Goiano - Campus IPAMERI','CAMPIPAMERI','GO');";
  mysqli_query($conexao, $sql);

  $sql = "insert into campus value(null,'Instituto Federal Goiano - Campus Ceres','CAMPCERES','GO');";
  mysqli_query($conexao, $sql);

  $sql = "insert into administrador values(null, 'Admin_Master', '000.000.000-00', 'adminmaster@gmail.com', sha1('admin000'), 0, 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into administrador values(null, 'Alexandre', '111.111.111-11', 'alexandre@gmail.com', sha1('admin111'), 1, 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into modalidade values(null, 'Marcha Atlética', 'As provas de marcha atlética são competições de longa distância na qual o competidor tem que estar sempre com pelo menos um pé no chão.', 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into modalidade values(null, 'Cross-Country', 'São ealizadas em terrenos de terra ou grama', 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into prova values(null, 'Marcha de 20 km', 0, 10, 'Disputada por homens e mulheres, tendo uma distância de 20 quilômetros. Os atletas precisam manter contato permanente com o chão e a perna de apoio deve permanecer reta até que a perna que se levanta e perde contato com o solo para dar o passo, a ultrapasse', 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into prova values(null, 'Corrida', 1, 20, 'As corridas começam com cada equipe na sua própria box ao longo da linha de partida. Ao disparo da pistola, os corredores têm umas poucas centenas de metros para se concentrarem da larga linha de partida numa trilha muito mais estreita que devem seguir até à meta', 2);";
  mysqli_query($conexao, $sql);

  $sql = "insert into professor values(null,'Thaís Ferreira Araujo','111.111.111-11','1111111','11111-1111','thais@gmail.com',sha1('prof111'),'111',1,1,1,null);";
  mysqli_query($conexao, $sql);

  $sql = "insert into professor values(null,'Ryan Souza Alves','222.222.222-22','2222222','22222-2222','ryan@gmail.com',sha1('prof222'),'222',1,2,1,null);";
  mysqli_query($conexao, $sql);

  $sql = "insert into atleta values(null, 'Luiz Gomes Silva', '2018-01-01', 1, '111.111.111-11', '1111111', 'foto_aluno_1', 'foto_cpf_1', 'foto_rg_1', 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into atleta values(null, 'Clara Ferreira Alves', '2018-02-02', 2, '222.222.222-22', '2222222', 'foto_aluno_2', 'foto_cpf_2', 'foto_rg_2', 1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into atleta values(null, 'Kauan Dias Santos', '2018-03-03', 1, '333.333.333-33', '3333333', 'foto_aluno_3', 'foto_cpf_3', 'foto_rg_3', 2);";
  mysqli_query($conexao, $sql);

  $sql = "insert into atleta values(null, 'Nicole Azevedo Dias', '2018-04-04', 2, '444.444.444-44', '4444444', 'foto_aluno_4', 'foto_cpf_4', 'foto_rg_4', 2);";
  mysqli_query($conexao, $sql);

  $sql = "insert into competidor values(1,1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into competidor values(1,2);";
  mysqli_query($conexao, $sql);

  $sql = "insert into competidor values(2,1);";
  mysqli_query($conexao, $sql);

  $sql = "insert into competidor values(2,2);";
  mysqli_query($conexao, $sql);
?>
