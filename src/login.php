<?php 

    if (isset($_POST["login"])){
        $db = new SQLite3('../database/piramide.sqlite');
        $user = $_POST["user"];
        $senha = md5($_POST["senha"]);
        $select_user = "
        SELECT user, senha FROM users where user = :usr and senha = :psw
        ";

        $comando=$db->prepare($select_user);
        $comando->bindValue('usr', $user);
        $comando->bindValue('psw', $senha);
        $res_banco = $comando->execute();

        while ($row = $res_banco->fetchArray()) {
            
            if (count($row) > 1)
            {
                $go_index = header('Location: edit_pir.php');
                session_start();
                session_name('Piramide');
                $_SESSION['usr'] = $user;
                $_SESSION['logado'] = 1;
                session_write_close(); 
                echo $go_index;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Área de Login</title>
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
                    <h2>Faça seu Login</h2>
                    <br>
                    <form action="" method="POST">

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" id="user" name="user" onkeyup="maiuscula(this)" required>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name="senha" required>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s">
                            <strong><input class="uk-button uk-button-primary" type="submit" name="login" value="LOGIN" style="border-radius:5px"><strong>
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