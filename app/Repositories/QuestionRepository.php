<?php

namespace App\Repositories;

use App\Category;
use App\Question;
use App\Answer;

class QuestionRepository{

    /**
     * 
     * Transforms  question_id 
     * into question model
     * 
     * @param int question_id
     * @return App/Question
     */
    protected $answer;
    public function getQuestion($question_id){
        $question = Question::whereId($question_id)->first();
        return $question;
        //$this->setAnswer($question->answer);   
     }

    //  private function setAnswer(Answer $answer){
    //     $this->answer = $answer;
    //  }

    //  public function getAnswer(){
    //      return $this->answer;
    //  }




}


?>