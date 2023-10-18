<?php
    include_once("auxilio.php");
    $user = verificador_user();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário</title>
</head>
<body>
    <header>
        <h1>Preencha o Formulário</h1>
    </header>    
    <main>
        <form class="form-1" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $user['id'] : '';?>">
            <label class="label-1" for="nome">Nome</label>
            <input class="input-1" type="text" name="nome" id="nome" value="<?php echo isset($_GET['id']) ? $user['nome'] : '';?>">
            <label class="label-1" for="sobrenome">Sobrenome</label>
            <input class="input-1" type="text" name="sobrenome" id="sobrenome" value="<?php echo isset($_GET['id']) ? $user['sobrenome']:'';?>">
            <label class="label-1" for="pessoa">Selecione o tipo de pessoa</label>
            <select name="pessoa" id="pessoa">
                
            <?php 
                if(isset($_GET['id']))
                {
                    if($user['tipo_de_pessoa']=='PF')
                    {
                        $tipoPessoa = ['PF','PJ'];
                    }
                    else
                    {
                        $tipoPessoa = ['PJ','PF'];
                    }
                    $pessoas = array('PF' => 'Pessoa Física', 'PJ' => 'Pessoa Jurídica');
                    
                    foreach ($tipoPessoa as $tipo){
                        
                        echo"<option class='option-1' value=\"$tipo\">$pessoas[$tipo]</option>";
                        
                        
                    };
                } 
                else
                {
                    $tipoPessoa = ['PF','PJ'];
                    $pessoas = array('PF' => 'Pessoa Física', 'PJ' => 'Pessoa Jurídica');
                    
                    foreach ($tipoPessoa as $tipo){
                        
                        echo"<option class='option-1' value=\"$tipo\">$pessoas[$tipo]</option>";
                        
                        
                    };
                }
            ?>

        </select>
        <label class="label-1" for="data">Escolha uma data</label>
        <input class="input-1" type="date" name="data" id="data" value="<?php echo isset($_GET['id']) ? $user['data'] : '';?>">
        <label class="label-1" for="observacoes">Observações</label>
        <textarea class="text-area-1" name="observacoes" id="observacoes" cols="50" rows="4" ><?php echo isset($_GET['id']) ? $user['observacoes'] : '';?></textarea>
        <input class="bottom" type="submit" value="<?php echo isset($_GET['id']) ? 'Alterar' : 'Enviar';?>" name="<?php echo isset($_GET['id']) ? 'alterar' : 'enviar';?>">

        <a href="listar.php" class="link-1">Clique aqui para avançar para proxima parte.</a>

        </form>
        
        <section>
            <?php
            
            if(isset($_POST['enviar'])){
                $data = isset($_POST["data"]) ? $_POST["data"]:"";
                $nome = isset($_POST["nome"]) ? $_POST["nome"]:"";
                $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"]:"";
                $observacoes = isset($_POST["observacoes"]) ? $_POST["observacoes"]:"";
                $tipoPessoa = isset($_POST["pessoa"]) ? $_POST["pessoa"]:"";

                
                
                if(empty($data) ||empty($nome) ||empty($sobrenome) ||empty($observacoes) ||empty($tipoPessoa)){
                    echo "<p>Preencha corretamente todos os campos!</p>";
                    
                } 
                
                else{
                    
                    include_once('conexao.php');
                



                    $nome = $_POST["nome"];
                    $sobrenome = $_POST["sobrenome"];
                    $observacoes = $_POST["observacoes"];
                    $tipoPessoa = $_POST["pessoa"];
                    $data = $_POST["data"];
                    

                    $query = "INSERT INTO tabela_teste (nome, sobrenome, observacoes, tipo_de_pessoa,data) VALUES ('$nome', '$sobrenome', '$observacoes','$tipoPessoa','$data')";

                    $result = mysqli_query($connection,$query);

                    if ($result){
                        echo 'Dados inseridos com sucesso!';
                    }
                    else {
                        echo 'Erro na inserção: ' . mysqli_error($connection);

                    }

                    mysqli_close($connection);

                }
                
                
            }
        
            elseif(isset($_POST['alterar']))
        
            {
                include_once("conexao.php");

                // atribuindo variaveis
                $id = $_POST['id'];
                $nome_alterado = isset($_POST["nome"]) ? $_POST["nome"]:"";
                $sobrenome_alterado = $_POST['sobrenome'];
                $data_alterada = $_POST['data'];
                $observacoes_alterada =  $_POST['observacoes'];
                $tipo_pessoa_alterada= $_POST['pessoa'];

                // alterando
                $result_usuario = "UPDATE tabela_teste SET nome = '$nome_alterado' WHERE id= '$id' ";
                mysqli_query($connection, $result_usuario);
                $result_usuario = "UPDATE tabela_teste SET sobrenome = '$sobrenome_alterado' WHERE id= '$id' ";
                mysqli_query($connection, $result_usuario);
                $result_usuario = "UPDATE tabela_teste SET data = '$data_alterada' WHERE id= '$id' ";
                mysqli_query($connection, $result_usuario);
                $result_usuario = "UPDATE tabela_teste SET observacoes = '$observacoes_alterada' WHERE id= '$id' ";
                mysqli_query($connection, $result_usuario);
                $result_usuario = "UPDATE tabela_teste SET tipo_de_pessoa = '$tipo_pessoa_alterada' WHERE id= '$id' ";
                mysqli_query($connection, $result_usuario);

                echo "Mudanças feitas!";
            }
            ?>

            



        </section>

    </main>



</body>
</html>