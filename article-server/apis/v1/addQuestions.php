<?php
include("../../../../faq/article-server/connection/connection.php");
include("../../../../faq/article-server/models/Question.php");

header("Content-Type: application/json");

try{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method. Only POST requests are allowed.");
    }

    if (!isset($_POST['question']) || empty(trim($_POST['question']))) {
        throw new Exception("Question field is required");
    }

    if (!isset($_POST['answer']) || empty(trim($_POST['answer']))) {
        throw new Exception("Answer field is required");
    }

    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);

    $quest= new Question($conn);
    $result=$quest->create($question, $answer);

    if (is_array($result) && isset($result['success']) && $result['success'] === false) {
        throw new Exception($result['message']);
    }

    echo json_encode($result);

}
catch(Exception $e){
    echo json_encode([
        "success"=>false,
        "message"=>$e->getMessage()
    ]);
    
}