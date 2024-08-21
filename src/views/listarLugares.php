<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Avaliação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($dados as $cada) {
                $id = $cada['id'];

                echo "
                    <tr>
                        <td>{$id}</td>
                        <td>{$cada['nome']}</td>
                        <td>{$cada['endereco']}</td>
                        <td>{$cada['avaliacao']}</td>
                        <td>
                            <a href='/lugares/editarLugares?id={$id}'>Editar</a>
                            <a href='#' onclick='excluir({$id})'>Excluir</a>
                        </td>
                    </tr>
                ";
            }
        ?>
    </tbody>
</table>

<script>
    function excluir(id) {
        let resposta = confirm('Voce tem certeza?');

        if (resposta === true) {
            location.href = '/lugares/excluir?id='+id;
        }
    }
</script>