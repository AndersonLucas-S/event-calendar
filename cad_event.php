<?php
session_start();

include_once './conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['title']) || empty($dados['start']) || empty($dados['end'])) {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Todos os campos obrigatórios devem ser preenchidos!</div>'];
} else {
    $data_start = str_replace('/', '-', $dados['start']);
    $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

    $data_end = str_replace('/', '-', $dados['end']);
    $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

    if (!$data_start_conv || !$data_end_conv) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: As datas estão em formato inválido!</div>'];
    } else {
        $query_event = "INSERT INTO events (title, color, start, end, observation) VALUES (:title, :color, :start, :end, :observation)";

        try {
            $insert_event = $conn->prepare($query_event);
            $insert_event->bindParam(':title', $dados['title']);
            $insert_event->bindParam(':color', $dados['color']);
            $insert_event->bindParam(':start', $data_start_conv);
            $insert_event->bindParam(':end', $data_end_conv);
            $insert_event->bindParam(':observation', $dados['observation']);


            if ($insert_event->execute()) {
                $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
            } else {
                $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
            }
        } catch (Exception $e) {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: ' . $e->getMessage() . '</div>'];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($retorna);

