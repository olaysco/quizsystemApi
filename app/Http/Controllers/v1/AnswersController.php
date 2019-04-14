<?php

namespace App\Http\Controllers\v1;

use App\Answer;
use App\Question;
use App\Option;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * 
     * Evaluates the question
     * as attempted by the user
     * and returns the total score
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function evaluate(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'questions_id'=>'required|array',
            'options_id'=>'required|array' ,               
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(), 200, []);
        }else{
            foreach($request->get('questions_id') as $question_id){
                echo $this->getQuestion($question_id);
            }
        }
        
    }


    /**
     * 
     * Transforms  question_id 
     * into question model
     * 
     * @param int question_id
     * @return App/Question
     */
    public function getQuestion(Question $question){
        return $question;
    }


    
}
