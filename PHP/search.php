<?php
require 'dbcon.php';

if (isset($_POST['searchData'])) {
    $searchData = $_POST['searchData'];

    $sql = "SELECT author.author_id, 
                   author.first_name, 
                   author.middle_name, 
                   author.last_name,
                   COUNT(article.article_id) AS article_count
            FROM author
            LEFT JOIN article ON author.author_id = article.author_id
            WHERE author.first_name LIKE :searchData 
               OR author.middle_name LIKE :searchData 
               OR author.last_name LIKE :searchData
               AND article.status = 1
            GROUP BY author.author_id
            ORDER BY article_count DESC
            LIMIT 5";

    $vars = array(':searchData' => "%$searchData%");
    $result = database_run($sql, $vars);

    if ($result) {
        foreach ($result as $row) {
            echo '<li style="margin-top: 10px; margin-left: -10px">' . $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name . ' - Published Articles: ' . $row->article_count .
            '<a onclick="onclickSupport()" style="padding-left: 5px; color: blue; text-decoration: underline; cursor: pointer" title="Support this author by giving them some of your charisma">SUPPORT</a>' .  '</li>';
            
         
        }
    } else {
        echo '<li>No results found</li>';
    }
}
?>

!