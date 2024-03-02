<?php
include 'dbcon.php';
require '../../vendor/autoload.php';

function addNotification($article_id, $author_id, $title, $message)
{
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'cabcad916f55a998eaf5',
        '0aef8b4d2da6760f5726',
        '1764683',
        $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);

    $description = $article_id . ' - ' . $title . ', ' . $message;

    $query = "INSERT INTO `notification`(`article_id`,`author_id`, `title`, `description`) VALUES (?, ?, ?, ?)";

    $result = execute_query($query, [$article_id, $author_id, $message, $description], true);

    if ($result !== false) {
        echo json_encode(['status' => true, 'message' => 'Record added successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to add record']);
    }
}
