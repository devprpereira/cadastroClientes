<?php
session_status() !== 2 ? session_start() : null;
require_once("db.php");


if (empty($_POST)) {
    header("Location: form.php");
}


if (isset($_POST['edit']) && !empty($_POST['edit'])) { $dados['edit'] = filter_input(INPUT_POST, "edit", FILTER_VALIDATE_INT);}
$dados['nome'] = filter_input(INPUT_POST, "name");
$dados['dtNascimento'] = filter_input(INPUT_POST, "dtNascimento");
$dados['sexo'] = filter_input(INPUT_POST, "sexo");
$dados['cep'] = filter_input(INPUT_POST, "cep");
$dados['cidade'] = filter_input(INPUT_POST, "cidade");
$dados['uf'] = filter_input(INPUT_POST, "uf");
$dados['bairro'] = filter_input(INPUT_POST, "bairro");
$dados['endereco'] = filter_input(INPUT_POST, "endereco");
$dados['numero'] = filter_input(INPUT_POST, "numero");
$dados['complemento'] = filter_input(INPUT_POST, "complemento");

$_SESSION['status'] = "";
$data = array();
//checka se todos os campos estão preenchidos
foreach ($dados as $key => $value) {
    if (empty($value)) {
        $_SESSION['status'] = "FALHA";
        $_SESSION['area'] = "client.php";
        $_SESSION['mensagem'][] = $key;
    }
}

if ($_SESSION['status'] == "FALHA")
    header("Location: form.php");

$conn = conecta();

if (!isset($dados['edit'])){
    $sql = "
    INSERT INTO clientescadastro (nome, dtNascimento, sexo, cep, cidade, uf, bairro, endereco, numero, complemento) 
    VALUES (?,?,?,?,?,?,?,?,?,?)
    ";
    
    $query = $conn->prepare($sql)->execute([$dados['nome'],$dados['dtNascimento'],$dados['sexo'],$dados['cep'],$dados['cidade'],$dados['uf'],$dados['bairro'],$dados['endereco'],$dados['numero'],$dados['complemento']]);
    
} else {
    echo 'tem edicao';
}