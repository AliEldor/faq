<?php
include("../../../../faq/article-server/connection/connection.php");
include("../../../../faq/article-server/models/Question.php");

header("Content-Type: application/json");

try{
    if($_SERVER["REQUEST_METHOD" ] !== "GET"){
        throw new Exception("Invalid request method");
    }

    $quest= new Question($conn);

    $result=$quest->read();

    if (is_array($result) && isset($result['success']) && $result['success'] === false) {
        throw new Exception($result['message']);
    }

    $response = array(
        'success' => true,
        'count' => count($result),
        'questions' => $result
    );

    if (count($result) == 0) {
        $response['message'] = 'No questions found in the database';
    }

    echo json_encode($response);
    
}
catch(Exception $e){
    echo json_encode([
        "success"=>false,
        "message"=>$e->getMessage()
    ]);
}