<?php

declare(strict_types=1);

// /contatos/listar
function contatos_listar(): void
{
    $dados = conexao()->query('SELECT * FROM tb_contatos');

    view('listar', $dados->fetchAll());
}

function contatos_add(): void
{
    if ($_POST) {
        $nome = strip_tags($_POST['nome']);
        $email = strip_tags($_POST['email']);
        $telefone = strip_tags($_POST['telefone']);

        $data = date('d/m/Y');

        conexao()->query("
            INSERT INTO tb_contatos (nome, email, telefone, data_cadastro)
            VALUES ('{$nome}', '{$email}', '{$telefone}', '{$data}')
        "); 

        //redirecionar
        header('location: /contatos/listar');
    } 

    view('cadastro');
}

function contatos_excluir(): void
{
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_contatos WHERE id='{$id}'";

    conexao()->query($sql);

    header('location: /contatos/listar');
}

function contatos_editar(): void
{
    if ($_POST) {
        $nome = request_input('nome');
        $email = request_input('email');
        $telefone = request_input('telefone');
        $id = $_GET['id'];

        $sql = "UPDATE tb_contatos 
                SET ':nome, :email, :telefone' 
                WHERE id='{$id}'";

        $sql = conexao()->prepare($query);

        $sql->execute([
            ':nome' => $nome,
            ':email'=> $email,
            ':telefone' => $telefone
        ]);
        
        header('location: /contatos/listar');
    }

    $id = $_GET['id'];
    $dados = conexao()->query("SELECT * FROM tb_contatos WHERE id='{$id}'");

    view('editar', $dados->fetchObject());

    function request_input (string $nome):mixed {
        return strip_tags($_POST[$nome] || $_GET[$nome]);
    }
}


