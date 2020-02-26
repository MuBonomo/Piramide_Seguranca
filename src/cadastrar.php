<?php 
    if (isset($_POST["cadastrar"])){
        $db = new SQLite3('../database/piramide.sqlite');
        $nome = $_POST["nome"];
        $user = $_POST["user"];
        $senha = md5($_POST["senha"]);
        $insert_user = "
        INSERT INTO users (nome, user, senha) VALUES (:nome, :user, :senha)
        ";

        $comando=$db->prepare($insert_user);
        $comando->bindValue('nome', $nome);
        $comando->bindValue('user', $user);
        $comando->bindValue('senha', $senha);
        $res_banco = $comando->execute();
    }

?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Cadastrar Usuários</title>
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
            <div class="uk-text-center" style="  display: flex;  padding:1px;">
                <div class="uk-width-1-3"></div>
                <div class="uk-width-1-3">
                    <h2>Faça seu Cadastro</h2>
                    <br>
                    <form action"" method="POST">

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input class="uk-input" type="text" placeholder="Nome Completo" name="nome" required>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" name="user" onkeyup="maiuscula(this)" required>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name="senha" required>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s">
                            <strong><input class="uk-button uk-button-primary" type="submit" name="cadastrar" value="CADASTRAR" style="border-radius:5px"><strong>
                        </div>

                    </form>
                </div>
                <div class="uk-width-1-3"></div>
                

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