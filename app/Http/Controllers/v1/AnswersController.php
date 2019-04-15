<?php

namespace App\Http\Controllers\v1;


use App\Question;

use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;
use App\Repositories\OptionsRepository;

use Illuminate\Http\Request;

class AnswersController extends Controller
{

    protected $question;
    protected $option;

    public function __construct(QuestionRepository $question,OptionsRepository $option){
        $this->question = $question;
        $this->option = $option;
    }
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
        }else if(count($request->get('options_id')) !== count($request->get('questions_id')) ){
            return response()->json(["message"=>"selected options must be equal with number of question"], 200, []);
        }else {
            $result = [];
            $fail = $pass = 0;
            $index = 0;
            foreach($request->get('questions_id') as $question_id){
                $question =  $this->question->getQuestion($question_id);
                $answer = $this->option->getOption($question->answer->option_id)->options_text;
                $userAnswer = $this->option->getOption($request->get('options_id')[$index]);
                $userAnswer = ($userAnswer)?$userAnswer->options_text:'';
                $result[] = ['question'=>$question,'valid_answer'=>$answer,'userAnswer'=>$userAnswer];
                ($userAnswer === $answer)?++$pass:++$fail;
                $index++;
            }
            $result[] = ["pass"=>$pass];
            $result[] = ["fail"=>$fail];
            return response()->json($result, 200, []);
        }
        
    }


    


    
}
