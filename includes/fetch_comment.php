<?php

require_once 'config.php';

$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach ($result as $row) {
    $data = new DateTime($row['date']);
    $output .= '
            <div class="card mb-3 card-comments">
                <div class="card-header card-comments-header"><b>' . $row["comment_sender_name"] . '</b> on <span>' . $data->format('d/m/Y') . " - " . $row["hora"] . '</span></div>
                <div class="card-body card-comments-body">' . $row["comment"] . '</div>
                <div class="card-footer" align="right"><button type="button" class="btn btn-primary btn-comments-section reply" id="' . $row["comment_id"] . '">Responder</button></div>
            </div>
 ';
    $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
    $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '" . $parent_id . "'
 ";
    $output = '';
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $count = $statement->rowCount();
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }
    if ($count > 0) {
        foreach ($result as $row) {
            $output .= '
            <div class="card mb-3 card-comments" style="margin-left:' . $marginleft . 'px">
                <div class="card-header card-comments-header"><b>' . $row["comment_sender_name"] . '</b> on <span>' . $row["date"] . '</span></div>
                <div class="card-body card-comments-body">' . $row["comment"] . '</div>
                <div class="card-footer" align="right"><button type="button" class="btn btn-primary btn-comments-section reply" id="' . $row["comment_id"] . '">Responder</button></div>
            </div>
   ';
            $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
        }
    }
    return $output;
}
