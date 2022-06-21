<?php

//add_comment.php
date_default_timezone_set('America/Manaus');

require_once 'config.php';

$error = '';
$comment_name = '';
$comment_content = '';


if (empty($_POST["comment_name"])) {
    $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert" data-mdb-color="danger" id="Close">
                    <strong>Digite seu nome!</strong>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
    ';
} else {
    $comment_name = $_POST["comment_name"];
}

if (empty($_POST["comment_content"])) {
    $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert" data-mdb-color="danger" id="Close">
                    <strong>Digite um comentário!</strong>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
    ';
} else {
    $comment_content = $_POST["comment_content"];
}

if ($error == '') {
    $query = "
 INSERT INTO tbl_comment 
 (parent_comment_id, comment, comment_sender_name, date, hora) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name, :date, :hora)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':parent_comment_id' => $_POST["comment_id"],
            ':comment'    => $comment_content,
            ':comment_sender_name' => $comment_name,
            ':date' => date('Y-m-d'),
            ':hora' => date('H:i')
        )
    );
    $error = '<div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="success" id="Close">
                <strong>Comentário publicado com sucesso!</strong>
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>';
}

$data = array(
    'error'  => $error
);

echo json_encode($data);
