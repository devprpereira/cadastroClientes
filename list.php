<?php
require_once("db.php");
$con = conecta();
$query = "SELECT * FROM clientescadastro";
$data = $con->query($query);
?>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Sexo</th>
            <th>CEP</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Complemento</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($data as $dados) {
            echo '<tr>';
            echo '<th>' . $dados['nome'] . '</th>';
            echo '<th>' . $dados['dtNascimento'] . '</th>';
            echo '<th>' . ($dados['sexo'] == 'M' ? "Masculino" : "Feminino") . '</th>';
            echo '<th>' . $dados['cep'] . '</th>';
            echo '<th>' . $dados['uf'] . '</th>';
            echo '<th>' . $dados['cidade'] . '</th>';
            echo '<th>' . $dados['bairro'] . '</th>';
            echo '<th>' . $dados['endereco'] . '</th>';
            echo '<th>' . $dados['numero'] . '</th>';
            echo '<th>' . $dados['complemento'] . '</th>';
            echo '<th> <a href="form.php?edit=' . $dados['id'] . '">Editar</a> </th>';
            echo '<th> <a href="client.php?remove=' . $dados['id'] . '">Remover</a> </th>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>