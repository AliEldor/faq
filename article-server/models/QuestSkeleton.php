<?php

class QuestSkeleton{
    private $id;
    private $question;
    private $answer;

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
         $this->id=$id;
    }

    //question

    public function getQuestion(){
        return $this->question;
    }
    
    public function setQuestion($question){
         $this->question=$question;
    }

    //answer

    public function getAnswer(){
        return $this->answer;
    }
    
    public function setAnswer($answer){
         $this->answer=$answer;
    }
}