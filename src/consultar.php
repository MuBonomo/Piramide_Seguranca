<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Consultar Pirâmide</title>
        <meta charset="utf-8">
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

                    <div class="uk-width-1-3"></div>
                    
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

                        <div class="uk-width-1-4"></div>
                        
                        <div class="uk-width-1-4">
                            <strong><input class="uk-button uk-button-primary" type="submit" name="pesquisar" value="PESQUISAR" style="border-radius:5px"></strong>                        
                        </div>

                    </form>
                </div>


                <br>
                <div class="uk-width-1-1">
                <?php 


                echo"<div style='width: auto; height:600px; overflow:auto;'>
                <table class='uk-table uk-table-responsive uk-table-divider'>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Nome</th>
                            <th>Data de Abertura</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Comentário</th>
                        </tr>
                    </thead>";
                    if (isset($_POST["pesquisar"])){
                        $db = new SQLite3('../database/piramide.sqlite');
                        $id = $_POST["numero"];
                        $edv = $_POST["edv"];
                        $select_user = "
                        SELECT id_piramide, nome, strftime('%d/%m/%Y', data) as data, evento_desc, status, hse FROM regpir where id_piramide = '$id' or edv = '$edv'
                        ";

                        $comando=$db->prepare($select_user);
                        $comando->bindValue('id', $id);
                        $comando->bindValue('edv', $edv);
                        $res_banco = $comando->execute();

                        while ($row = $res_banco->fetchArray()) {
                            echo"<tr>
                                <td>".$row['id_piramide']."</td>
                                <td>".$row['nome']."</td>
                                <td>".$row['data']."</td>
                                <td>".$row['evento_desc']."</td>
                                <td>".$row['status']."</td>
                                <td>".$row['hse']."</td>
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
                        </table>
                        </div>";
                    }
                ?>
                </div>

            </div>

        </main>
        <script type="text/javascript">
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z){
                v = z.value.toUpperCase();
                z.value = v;
            }
        //FIM DA FUNÇÃO MASCARA MAIUSCULA
        </script>

        <!--Java Script do uikit-->
        <script src="../assets/js/uikit.js"></script>
        <script src="../assets/js/uikit-icons.js"></script>
    </body>
</html>