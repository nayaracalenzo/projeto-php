<?php

declare(strict_types=1);

function lugares_listar(): void
{
    $dados = conexao()->query('SELECT * FROM tb_lugares');

    view('listarLugares', $dados->fetchAll());
}

function lugares_add(): void
{
    if ($_POST) {
        
        $nome = request_input('nome');
        $endereco = request_input('endereco');
        $avaliacao = request_input('avaliacao');

        $data_cadastro = date('d/m/Y');

        $sql = "INSERT INTO tb_lugares (nome, endereco, avaliacao, data_cadastro, data_edicao)
                VALUES (:nome, :endereco, :avaliacao, :data_c, :data_e)
                "; 
        $sql = conexao()->prepare($query);

        $sql->execute([
            ':nome' => $nome,
            ':endereco'=> $endereco,
            ':avaliacao' => $avaliacao,
            ':data_c' => $data_cadastro,
            ':data_e' => $data_cadastro

        ]);
        //redirecionar
        header('location: /lugares/listarLugares');
       
    } function request_input (string $nome):mixed {
        return strip_tags($_POST[$nome]);
    }

    view('cadastroLugares');

    
}

function lugares_excluir(): void
{
    echo "Pagina de excluir lugar";
}

function lugares_editar(): void
{
    echo "Pagina de editar lugar";
}

