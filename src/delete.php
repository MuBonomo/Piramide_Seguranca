<?php
    $db = new SQLite3('../database/piramide.sqlite');

    $id = $_GET["id"];

    echo"
    <html lang='pt'>
    <head>
        <title>Piramide de Segurança</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='../assets/css/uikit.css'/>
    </head>

    <body CLASS='UK-CONTAINER'>
    <br><br><br><br>
        <form class='uk-grid-small' uk-grid action='' method='POST'>

            
            <div class='uk-width-1-1'>
                <h2 style='text-align:center'>Você deseja realmente excluir a piramide $id?</h2>
                <br>
            </div>
            
            <div class='uk-width-1-4@s'>
            </div>
            <div class='uk-width-1-2@s' style='display: flex'>
                <div class='uk-width-1-3@s'>
                    <strong><input class='uk-input uk-button uk-button-primary' type='submit' name='sim' value='SIM' style='border-radius:5px'></strong>
                </div>
                <div class='uk-width-1-3@s'></div>
                <div class='uk-width-1-3@s'>
                    <strong><input class='uk-input uk-button uk-button-danger' type='submit' name='nao' value='NÃO' style='border-radius:5px'><strong>
                </div>
            </div>
            <div class='uk-width-1-4@s'>
            </div>

        </form>

    </body>
    
    <script src='../assets/js/uikit.js'></script>
    <script src='../assets/js/uikit-icons.js'></script>
    
    </html>
    ";

    if (isset($_POST["sim"]))
    {
        $delete_pir="
        delete from regpir where id_piramide = :id
        ";

        $go_edit = header('Location: edit_pir.php');
        $comando=$db->prepare($delete_pir);
        $comando->bindValue('id', $id);
        $res_banco = $comando->execute();

        echo $go_edit;
    }

    if (isset($_POST["nao"]))
    {
        $go_edit = header('Location: edit_pir.php');
        echo $go_edit;
    }
?>