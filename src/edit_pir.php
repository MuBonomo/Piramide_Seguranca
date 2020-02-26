<?php
	session_start();
	
	if(isset($_SESSION['usr']) && !empty($_SESSION['usr']) && $_SESSION['logado'] == 1){
		echo '';
	}
	else{
		header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Consultar Pirâmide</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/uikit.css" />
    </head>
    
    <body style="font-family: Verdana, Geneva, Tahoma, sans-serif">       

        <header>   
        <nav class="uk-background-contain uk-background-top-center" style="background-image: url('../img/bosch-faixa.png'); background-color:#FFFFFF"  uk-navbar>
                <div class="uk-navbar-left">

                    <ul class="uk-navbar-nav" >
                        <li class="uk-active"><a href="../index.php">Home</a></li>
                        <li class="uk-active"><a href="consultar.php">Consultar</a></li>
                        <li class="uk-active"><a href="login.php">Login</a></li>                        
                    </ul>

                </div>
            </nav>
            <div class="uk-text-center" style="display: flex;">

                <div class="uk-width-1-3" style="display:flex">

                    <div class="uk-width-1-3">
                    </div>
                    
                    <div class="uk-width-1-3">
                    </div>


                    <div class="uk-width-1-3"></div>

                </div>
                
                <div class="uk-width-1-3">
                </div>
                <div class="uk-width-1-3">
                    <div>
                        <img src="../img/bosch-logo.png" style="width: 150px;">
                    </div>
                </div> 
            </div>
        </header>

        <br>

        <main class="uk-container">
            <div class="uk-text-center" style=" padding:1px;">
                <div class="uk-width-1-1">
                    <form class="uk-grid-small" uk-grid method="POST" action="">

                        <div class="uk-width-1-4">
                            <input class="uk-input" type="text" placeholder="Número da Pirâmide" name="numero">
                        </div>

                        <div class="uk-width-1-4">
                            <input class="uk-input" type="text" placeholder="EDV do solicitante" maxlength="8" name="edv">
                        </div>

                        <div class="uk-width-1-4">
                        <strong><a href="gerar_relatorio.php"><button class="uk-button uk-button-primary" type="button" style="border-radius:5px; background-color:green">Gerar Excel</button></a></strong>
                        </div>
                        
                        <div class="uk-width-1-4">
                            <strong><input class="uk-button uk-button-primary" type="submit" name="pesquisar" value="PESQUISAR" style="border-radius:5px"></strong>                        
                        </div>

                    </form>
                </div>

                <br>
                <div class="uk-width-1-1">
                <?php 


                echo"<div style='width: auto; height:500px; overflow:auto;'>
                <table class='uk-table uk-table-justify uk-table-divider'>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Data de Abertura</th>
                            <th>Horário</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Encerrar</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>";
                    if (isset($_POST["pesquisar"])){
                        $db = new SQLite3('../database/piramide.sqlite');
                        $id = $_POST["numero"];
                        $edv = $_POST["edv"];

                        $select_user = "
                        SELECT id_piramide, strftime('%d/%m/%Y', data) as data, hora, evento_desc, status FROM regpir where id_piramide like '$id%' and edv like '%$edv%'
                        ";

                        $comando=$db->prepare($select_user);
                        $comando->bindValue('id', $id);
                        $comando->bindValue('edv', $edv);
                        $res_banco = $comando->execute();

                        while ($row = $res_banco->fetchArray()) {
                            echo"<tr>
                                    <td>".$row['id_piramide']."</td>
                                    <td>".$row['data']."</td>
                                    <td>".$row['hora']."</td>
                                    <td>".$row['evento_desc']."</td>
                                    <td>".$row['status']."</td>
                                    <td>
                                        <a href='update.php?id=".$row['id_piramide']."'>
                                            <button class='uk-button' type='button' style='border-radius:5px; background-color:#FFFFFF '><img src='../img/close.png'></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='delete.php?id=".$row['id_piramide']."'>
                                            <button class='uk-button' type='button' style='border-radius:5px; background-color:#FFFFFF'><img src='../img/lixo.png'></button>
                                        </a>
                                    </td>
                                </tr>
                                ";
                        }
                        
                        $result = $res_banco->fetchArray();

                        if($result == false)
                        {
                            echo "<script>
                            alert('Nenhum Resultado Encontrado');
                            </script>
                        ";
                        }

                        echo "</tbody>
                        </tr>
                        </div>";
                    }
                ?>
                </div>

            </div>

        </main>

        <!--Java Script do uikit-->
        <script src="../assets/js/uikit.js"></script>
        <script src="../assets/js/uikit-icons.js"></script>
    </body>
</html>