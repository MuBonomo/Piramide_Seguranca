<?php 
    if (isset($_POST["enviar"])){
        $db = new SQLite3('../database/piramide.sqlite');
        $data = $_POST["data"];
        $hora = $_POST["hora"];
        $turno = $_POST["turno"];
        $nome = $_POST["nome"];
        $edv = $_POST["edv"];
        $funcao = $_POST["funcao"];
        $t_evento = $_POST["t_evento"];
        $n_evento = $_POST["n_evento"];
        $event_desc = $_POST["event_desc"];
        $equipamento = $_POST["equipamento"];
        $colaborador = $_POST["colaborador"];
        isset($_POST["equip_desc"])?$equip_desc = $_POST["equip_desc"]:$equip_desc=" ";
        isset($_POST["col_nome"])?$col_nome=$_POST["col_nome"]:$col_nome=" ";
        $obs = $_POST["obs"];
        $local = $_POST["local"];

        $insert_piramide = "
        INSERT INTO regpir (data, hora, turno, nome, edv, funcao, evento_tipo, evento_natureza, evento_desc, equipamento, equipamento_desc,colaborador, colaborador_desc, local, obs, status, hse)
        VALUES (:data, :hora, :turno, :nome, :edv, :funcao, :evento_tipo, :evento_natureza, :evento_desc, :equipamento, :equipamento_desc, :colaborador, :colaborador_desc, :local, :obs, 'Aberto', '')
        ";

        $comando=$db->prepare($insert_piramide);
        $comando->bindValue('data', $data);
        $comando->bindValue('hora', $hora);
        $comando->bindValue('turno', $turno);
        $comando->bindValue('nome', $nome);
        $comando->bindValue('edv', $edv);
        $comando->bindValue('funcao', $funcao);
        $comando->bindValue('evento_tipo', $t_evento);
        $comando->bindValue('evento_natureza', $n_evento);
        $comando->bindValue('evento_desc', $event_desc);
        $comando->bindValue('equipamento', $equipamento);
        $comando->bindValue('equipamento_desc', $equip_desc);
        $comando->bindValue('colaborador', $colaborador);
        $comando->bindValue('colaborador_desc', $col_nome);
        $comando->bindValue('local', $local);
        $comando->bindValue('obs', $obs);
        $res_banco = $comando->execute();

        $select_ultimo = "
            SELECT id_piramide FROM regpir ORDER BY id_piramide DESC LIMIT 1
        ";

        $comando1=$db->prepare($select_ultimo);
        $res_banco1 = $comando1->execute();

        $row = $res_banco1->fetchArray();

        echo"
            <script>
                alert('Piramide aberta com sucesso! Numero da Piramide: $row[0]')
            </script>
        ";



        $insert_temp = "
        INSERT INTO temp_regpir (data, hora, turno, nome, edv, funcao, evento_tipo, evento_natureza, evento_desc, equipamento, equipamento_desc,colaborador, colaborador_desc, local, obs, status, hse)
        VALUES (:data, :hora, :turno, :nome, :edv, :funcao, :evento_tipo, :evento_natureza, :evento_desc, :equipamento, :equipamento_desc, :colaborador, :colaborador_desc, :local, :obs, 'Aberto', '')
        ";

        $comando_temp=$db->prepare($insert_temp);
        $comando_temp->bindValue('data', $data);
        $comando_temp->bindValue('hora', $hora);
        $comando_temp->bindValue('turno', $turno);
        $comando_temp->bindValue('nome', $nome);
        $comando_temp->bindValue('edv', $edv);
        $comando_temp->bindValue('funcao', $funcao);
        $comando_temp->bindValue('evento_tipo', $t_evento);
        $comando_temp->bindValue('evento_natureza', $n_evento);
        $comando_temp->bindValue('evento_desc', $event_desc);
        $comando_temp->bindValue('equipamento', $equipamento);
        $comando_temp->bindValue('equipamento_desc', $equip_desc);
        $comando_temp->bindValue('colaborador', $colaborador);
        $comando_temp->bindValue('colaborador_desc', $col_nome);
        $comando_temp->bindValue('local', $local);
        $comando_temp->bindValue('obs', $obs);
        $res_banco_temp = $comando_temp->execute();

    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Piramide de Segurança</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/uikit.css"/>
    </head>
    
    <body style="font-family: Verdana, Geneva, Tahoma, sans-serif;">       

        <header >   
            <nav class="uk-background-contain uk-background-top-center" style="background-image: url('../img/bosch-faixa.png'); background-color:#FFFFFF"  uk-navbar>
            
                <div class="uk-navbar-left">

                    <ul class="uk-navbar-nav" >
                        <li class="uk-active"><a href="../index.php">Home</a></li>
                        <li class="uk-active"><a href="consultar.php">Consultar</a></li>
                        <li class="uk-active"><a href="login.php">Login</a></li>                        
                    </ul>

                </div>

                <div class="uk-navbar-right">
                    <div>
                        <img src="../img/bosch-logo.png" style="width: 150px; margin-right:20px; margin-top:10px">
                    </div>
                </div>

            </nav>

            <div class="uk-text-center " style="display: flex;">

                <div class="uk-width-1-3" style="display:flex">

                    <div class="uk-width-1-3"></div>

                    <div class="uk-width-1-3"></div>

                </div>
                
                <div class="uk-width-1-3">
                    <div>
                        <h2>Pirâmide de Segurança</h2>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div>
                    </div>
                </div> 
            </div>
        </header>

        <main>
            <div class="uk-text-center" style="  display: flex;  padding:1px;">
                <div class="uk-width-1-4">
                   
                </div>
                
                <div class="uk-width-1-1" >
                    <form class="uk-grid-small uk-card uk-card-default uk-card-body" uk-grid method="POST" action="">
                    
                        <div class="uk-width-1-3 uk-text-left">
                            <a href="form_pt.php"><img src="../img/brazil.png"></a>
                            <a href="form_en.php"><img src="../img/england.png"></a>
                            <a href="form_ge.php"><img src="../img/germany.png"></a>
                        </div>
                        <div class="uk-width-1-3"></div>
                        <div class="uk-width-1-3"></div>

                        <div class="uk-width-1-4">
                            <input class="uk-input" type="date" name="data" required>
                        </div>
                        <div class="uk-width-1-4@s">
                            <input class="uk-input" type="time" name="hora" required>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label><input class="uk-radio" type="radio" name="turno" value="1"> 1ºT</label>
                            <label><input class="uk-radio" type="radio" name="turno" value="2"> 2ºT</label>
                        </div>
                        <div class="uk-width-1-4@s">
                            <select class="uk-select">
                                <option>ITV</option>
                                <option>CGS</option>
                                <option>CSA</option>
                            </select>
                        </div>

                        <div class="uk-width-1-1@s">
                            <h4 style="border-top-style: solid; border-width:1px; border-color:lightgray">Dados do Emitente</h4>
                        </div>
                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" placeholder="Nome Completo" name="nome" required>
                        </div>
                        <div class="uk-width-1-4@s">
                            <input class="uk-input" type="text" placeholder="EDV" name="edv" maxlength="8" required>
                        </div>
                        <div class="uk-width-1-4@s">
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" placeholder="Função" name="funcao" required>
                        </div>

                        <div class="uk-width-1-1@s">
                            <h4 style="border-top-style: solid; border-width:1px; border-color:lightgray">Tipo do Evento</h4>
                        </div>
                        <div class="uk-width-1-1@s" style="display:flex">
                            <div class="uk-width-1-4@s" uk-tooltip="Hello World">
                                <label><input class="uk-radio" type="radio" name="t_evento" value="Risco"> Condição de Risco</label>
                            </div>
                            <div class="uk-width-1-4@s" uk-tooltip="Hello World">
                                <label><input class="uk-radio" type="radio" name="t_evento" value="Material"> Dano Material</label>
                            </div>
                            <div class="uk-width-1-4@s" uk-tooltip="Hello World">
                                <label><input class="uk-radio" type="radio" name="t_evento" value="Produto"> Danos ao Produto</label>
                            </div>
                            <div class="uk-width-1-4@s" uk-tooltip="Hello World">    
                                <label><input class="uk-radio" type="radio" name="t_evento" value="Acidente"> Acidente com Pessoas</label>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s">
                            <h4 style="border-top-style: solid; border-width:1px; border-color:lightgray">Natureza do Evento</h4>
                        </div>
                        <div class="uk-width-1-1@s" style="display:flex">
                            <div class="uk-width-1-2@s" uk-tooltip="Hello World">
                                <label><input class="uk-radio" type="radio" name="n_evento" value="Instalacoes"> Instalações</label>
                            </div>
                            <div class="uk-width-1-2@s" uk-tooltip="Hello World">
                                <label><input class="uk-radio" type="radio" name="n_evento" value="Comportamento"> Atitude/Comportamento</label>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" placeholder="Descrever o Evento" name="event_desc">
                        </div>

                        <div class="uk-width-1-1@s">
                            <h4 style="border-top-style: solid; border-width:1px; border-color:lightgray">Equipamentos Envolvidos</h4>
                        </div>
                        <div class="uk-width-1-1@s" style="display:flex">
                            <div class="uk-width-1-4@s">
                                <label><input class="uk-radio" type="radio" name="equipamento" value="Empilhadeira"> Empilhadeira Elétrica</label>
                            </div>
                            <div class="uk-width-1-4@s">
                                <label><input class="uk-radio" type="radio" name="equipamento" value="Eletrica"> Transportadora Elétrica</label>
                            </div>
                            <div class="uk-width-1-4@s">
                                <label><input class="uk-radio" type="radio" name="equipamento" value="Manual"> Transportadora Manual</label>
                            </div>
                            <div class="uk-width-1-4@s">    
                                <label><input class="uk-radio" type="radio" name="equipamento" id="outros" value="Outros" onclick="habilitar()"> Outros</label>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" placeholder="Descrever" name="equip_desc" id="equip_desc" onclick="habilitar()" disabled>
                        </div>

                        <div class="uk-width-1-1@s">
                            <h4 style="border-top-style: solid; border-width:1px; border-color:lightgray">Colaborador Envolvindo no Evento</h4>
                        </div>
                        <div class="uk-width-1-1@s" style="display:flex">
                            <div class="uk-width-1-3@s">
                                <label><input class="uk-radio" type="radio" name="colaborador" value="Bosch"> Bosch</label>
                            </div>
                            <div class="uk-width-1-3@s">
                                <label><input class="uk-radio" type="radio" name="colaborador" value="Terceiro" id="terceiro" onclick="habilitar2()"> Terceiro/Visitante: </label>
                            </div>
                            <div class="uk-width-1-3@s">
                                <input class="uk-input" type="text" placeholder="" name="col_nome" id="col_nome" onclick="habilitar2()" disabled>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" placeholder="Local" name="local" required>
                        </div>

                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" placeholder="Recomendações/Sugestões" name="obs">
                        </div>

                        <div class="uk-width-1-1@s">
                            <strong><input class="uk-button uk-button-primary" type="submit" name="enviar" value="ENVIAR" style="border-radius:5px"></strong>
                        </div>

                    </form>
                    <br>

                </div>

                <div class="uk-width-1-4" ></div> 
                

            </div>

        </main>


        <script language="javascript">
            function habilitar()
            {
                if (document.getElementById('outros').checked==true)
                {
                    document.getElementById('equip_desc').disabled=false;
                }
                if (document.getElementById('outros').checked==false)
                {
                    document.getElementById('equip_desc').disabled=true;
                }
            }

            function habilitar2()
            {
                if (document.getElementById('terceiro').checked==true)
                {
                    document.getElementById('col_nome').disabled=false;
                }
                if (document.getElementById('terceiro').checked==false)
                {
                    document.getElementById('col_nome').disabled=true;
                }
            }
        </script>

        <script src="../assets/js/uikit.js"></script>
        <script src="../assets/js/uikit-icons.js"></script>
    </body>
</html>