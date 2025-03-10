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

        $stmt->bind_param("ss", $quest->getQuestion(), $quest->getAnswer());

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

    public function read($id) {
        $sql = "SELECT * FROM questions WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ["success" => false, "message" => "SQL Error: " . $this->conn->error];
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}