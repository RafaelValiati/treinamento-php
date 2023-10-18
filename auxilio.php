<?php


function verificador_user()

{

    if(isset($_GET['id']))

    {
        $id = $_GET['id'];
        $user = user_search($id);
        return $user;
    }

}


function user_search($id)

{

    #procura o usuário pelo id e retorna o mesmo
    include_once("conexao.php");
    $result_usuario ="SELECT * FROM tabela_teste WHERE id='$id'";
    $resultado_usuario = mysqli_query($connection,$result_usuario);
    $row_usuario = mysqli_fetch_assoc($resultado_usuario);

    return $row_usuario;

} 



function redefinir_nome($nome_usuario,$id)

{

    #busca redefine o nome do usuário
    include_once("conexao.php");
    $result_usuario = "UPDATE tabela_teste SET nome = '$nome_usuario' WHERE id= '$id' ";
    mysqli_query($connection, $result_usuario);

}



function listar()

{
    
    include_once("conexao.php");
    $result_usuario = "SELECT * FROM tabela_teste";
    $resultado_usuario = mysqli_query($connection,$result_usuario);
    while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
            echo $row_usuario['id']."<br>";
            echo $row_usuario['nome']."<br>"; ?>
            <a href="index.php?id=<?php echo $row_usuario['id']; ?>">Editar</a> <hr>


    <?php    }
    

}

function alterar($id)
{
    if(isset($_POST['alterar']))
 
    {
        include_once("conexao.php");
        $nome = isset($_POST["nome"]) ? $_POST["nome"]:"";
        $result_usuario = "UPDATE tabela_teste SET nome = '$nome_usuario' WHERE id= '$id' ";
        mysqli_query($connection, $result_usuario);

    }

}




