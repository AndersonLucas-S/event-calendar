<?php
session_start();
include 'conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$observation = filter_input(INPUT_POST, 'observation', FILTER_SANITIZE_STRING);

if (empty($id) || empty($title) || empty($color) || empty($start) || empty($end)) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Por favor, preencha todos os campos obrigatórios!</div>";
    header('Location: index.php');
    exit;
}

if (!strtotime($start) || !strtotime($end)) {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Formato de data inválido!</div>";
    header('Location: index.php');
    exit;
}

$query_events = "UPDATE events SET title=:title, color=:color, start=:start, end=:end, observation=:observation WHERE id=:id";
$update_events = $conn->prepare($query_events);
$update_events->bindParam(':title', $title);
$update_events->bindParam(':color', $color);
$update_events->bindParam(':start', $start);
$update_events->bindParam(':end', $end);
$update_events->bindParam(':id', $id);
$update_events->bindParam(':observation', $observation);

if ($update_events->execute()) {
    $_SESSION['msg'] = "<div class='alert alert-success'>Evento atualizado com sucesso!</div>";
    header('Location: index.php');
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao atualizar o evento!</div>";
    header('Location: index.php');
    exit;
}
?>
