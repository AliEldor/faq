<?php
include("QuestSkeleton.php");

class Question{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        
    }

    public function create($question,$answer){
        $quest= new QuestSkeleton();
        $quest->setQuestion($question);
        $quest->setAnswer($answer);

        $sql = "INSERT INTO questions (question, answer) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ["success" => false, "message" => "SQL Error: " . $this->conn->error];
        }

        $trimmedQuestion = trim($question);
$trimmedAnswer = trim($answer);
mysqli_stmt_bind_param($stmt, "ss", $trimmedQuestion, $trimmedAnswer);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "question_id" => $this->conn->insert_id,
                "message" => "Question added successfully"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Error: " . $stmt->error
            ];
        }

    }

    public function read() {
        $sql = "SELECT * FROM questions ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ["success" => false, "message" => "SQL Error: " . $this->conn->error];
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $quest=[];
        while ($row = $result->fetch_assoc()) {
            $quest[] = $row;
        }

        return $quest;
    }
}