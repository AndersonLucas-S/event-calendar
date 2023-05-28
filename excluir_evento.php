<?php
session_start();

include_once 'conexao.php';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query_check_event = "SELECT * FROM events WHERE id = :id";
    $check_event = $conn->prepare($query_check_event);
    $check_event->bindParam(':id', $id, PDO::PARAM_INT);
    $check_event->execute();

    if ($check_event->rowCount() > 0) {
        $query_backup = "INSERT INTO events_backup (id, title, color, start, end, observation) SELECT id, title, color, start, end, observation FROM events WHERE id = :id";
        $backup_event = $conn->prepare($query_backup);
        $backup_event->bindParam(':id', $id, PDO::PARAM_INT);
        $backup_event->execute();

        $query_delete_event = "DELETE FROM events WHERE id = :id";
        $delete_event = $conn->prepare($query_delete_event);
        $delete_event->bindParam(':id', $id, PDO::PARAM_INT);
        $delete_event->execute();

        if ($delete_event->rowCount() > 0) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Evento excluído com sucesso!</div>";
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao excluir o evento.</div>";
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Evento não encontrado.</div>";
    }
}

header('Location: index.php');
?>
