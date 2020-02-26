<?php
    ob_start();
    $db = new SQLite3('../database/piramide.sqlite');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Teste Relatório</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
            $arquivo = 'piramide.xls';
            
            $select_banco="
            SELECT * FROM regpir
            ";
            echo"<div style='width: auto; height:600px; overflow:auto;'>
                <table class='uk-table uk-table-responsive uk-table-divider'>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Turno</th>
                            <th>Nome</th>
                            <th>EDV</th>
                            <th>Função</th>
                            <th>Tipo do Evento</th>
                            <th>Natureza do Evento</th>
                            <th>Descrição do Evento</th>
                            <th>Equipamento Envolvido</th>
                            <th>Descrição do Equipamento</th>
                            <th>Colaborador</th>
                            <th>Nome do Colaborador</th>
                            <th>Local</th>
                            <th>Observação</th>
                            <th>Status</th>
                            <th>Hse</th>
                        </tr>
                    </thead>";

            $comando=$db->prepare($select_banco);
            $res_banco = $comando->execute();

            while ($row = $res_banco->fetchArray()) {
                echo"<tr>
                <td>".$row['id_piramide']."</td>
                <td>".$row['data']."</td>
                <td>".$row['hora']."</td>
                <td>".$row['turno']."</td>
                <td>".$row['nome']."</td>
                <td>".$row['edv']."</td>
                <td>".$row['funcao']."</td>
                <td>".$row['evento_tipo']."</td>
                <td>".$row['evento_natureza']."</td>
                <td>".$row['evento_desc']."</td>
                <td>".$row['equipamento']."</td>
                <td>".$row['equipamento_desc']."</td>
                <td>".$row['colaborador']."</td>
                <td>".$row['colaborador_desc']."</td>
                <td>".$row['local']."</td>
                <td>".$row['obs']."</td>
                <td>".$row['status']."</td>
                <td>".$row['hse']."</td>
                </tr>
                ";
            }
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
            header ("Content-Description: PHP Generated Data" );
            exit;
        ?>
        
    </body>
</html>