<?php
session_start();
include_once 'conexao.php';
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    $query_event = "SELECT id, title, color, start, end, observation FROM events WHERE id=:id";
    $select_event = $conn->prepare($query_event);
    $select_event->bindParam(':id', $eventId);
    $select_event->execute();
    $evento = $select_event->fetch(PDO::FETCH_ASSOC);
    
    if ($evento) {
        $title = $evento['title'];
        $start = $evento['start'];
        $end = $evento['end'];
        $color = $evento['color'];
        $observation = $evento['observation'];
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger">Evento não encontrado.</div>';
        header('Location: index.php');
        exit();
    }

} else {
    $_SESSION['msg'] = '<div class="alert alert-danger">ID do evento não fornecido.</div>';
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link rel='stylesheet' href='css/core/main.min.css' />
    <link rel='stylesheet' href='css/daygrid/main.min.css' />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='css/personalizado.css'>
    <script src='js/core/main.min.js'></script>
    <script src='js/interaction/main.min.js'></script>
    <script src='js/daygrid/main.min.js'></script>
    <script src='js/core/locales/pt-br.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <script src='js/personalizado.js'></script>
</head>
<body>
    <div class='container'>
        <h2>Editar Evento</h2>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <form id='edit-event' method='POST' action='atualizar_evento.php'>
            <input type='hidden' name='id' value='<?php echo $eventId; ?>'>

            
            <div class='form-group'>
                <label for='title'>Título</label>
                <input type='text' class='form-control' name='title' id='title' value='<?php echo $title; ?>' required>
            </div>

            <div class='form-group'>
                <label for='start'>Início do evento</label>
                <input type='datetime-local' class='form-control' name='start' id='start' value='<?php echo $start; ?>' required>
            </div>

            <div class='form-group'>
                <label for='end'>Fim do evento</label>
                <input type='datetime-local' class='form-control' name='end' id='end' value='<?php echo $end; ?>' required>
            </div>

            <div class='form-group'>
                <label for='color'>Color</label>
                <select name='color' class='form-control' id='color' required>
                    <option value=''>Selecione</option>
                    <option style='color:#FFD700;' value='#FFD700' <?php echo ($color == '#FFD700') ? 'selected' : ''; ?>>Amarelo</option>
                    <option style='color:#0071c5;' value='#0071c5' <?php echo ($color == '#0071c5') ? 'selected' : ''; ?>>Azul Turquesa</option>
                    <option style='color:#FF4500;' value='#FF4500' <?php echo ($color == '#FF4500') ? 'selected' : ''; ?>>Laranja</option>
                    <option style='color:#8B4513;' value='#8B4513' <?php echo ($color == '#8B4513') ? 'selected' : ''; ?>>Marrom</option>
                    <option style='color:#1C1C1C;' value='#1C1C1C' <?php echo ($color == '#1C1C1C') ? 'selected' : ''; ?>>Preto</option>
                    <option style='color:#436EEE;' value='#436EEE' <?php echo ($color == '#436EEE') ? 'selected' : ''; ?>>Royal Blue</option>
                    <option style='color:#A020F0;' value='#A020F0' <?php echo ($color == '#A020F0') ? 'selected' : ''; ?>>Roxo</option>
                    <option style='color:#40E0D0;' value='#40E0D0' <?php echo ($color == '#40E0D0') ? 'selected' : ''; ?>>Turquesa</option>
                    <option style='color:#228B22;' value='#228B22' <?php echo ($color == '#228B22') ? 'selected' : ''; ?>>Verde</option>
                    <option style='color:#8B0000;' value='#8B0000' <?php echo ($color == '#8B0000') ? 'selected' : ''; ?>>Vermelho</option>
                </select>
            </div>
            <div class="form-group">
                <label for='title'>Observação</label>
                <input type='text' class='form-control' name='observation' id='observation' value='<?php echo $observation; ?>'>
            </div>

            <button type='submit' class='btn btn-primary'>Atualizar</button>
            <a href='index.php' class='btn btn-secondary'>Cancelar</a>
        </form>
    </div>
</body>
</html>
