<?php

namespace App\Http\Controllers\v1;

use App\Question;
use App\Category;
Use App\Option;
Use App\Answer;
use Validator;
use Illuminate\Validation\Rule;;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::all()->each(function($question){
            $question->options;
            $question->answer;
        });
        return response()->json($questions, 200);
    }

    /**
     * Displays the listing of a question that belongs to a particular category
     * 
     * @param int category_id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryQuestion(Request $request)
    {
        //
        $category_id = $request->get('category_id');
        $category = Category::whereId($category_id)->get()->each(function($cat){
            $cat->questions;
            $cat->questions->each(function($question){
                $question->options;
                $question->answer;
            });
        });
        
        return response()->json($category, 200, []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate  = Validator::make($request->all(),[
            'question_text'=>'required',
            'question_type'=>['required',Rule::in(['multi','binary'])],
            'options'=>'required|array|distinct',
            'category_id'=>'required|integer|exists:Categories,id',
            'answer'=>'required|in_array:options.*',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 200, []);
        }else{
            $question = new Question();
            $question->question_text = $request->get('question_text');
            $question->question_type = $request->get('question_type');
            $question->save();
            $this->addQuestionOption($question, $request);
            $categories = $question->categories()->save(Category::where('id',$request->get('category_id'))->first());
            $questions = $question->whereId($question->id)->get()->each(function($q){
                $q->options;
                $q->answer;
            });
            $questions->push(["categories"=>$categories]);
            return response()->json($questions, 200, []);
        }

        
    }

    /**
     * Adds options to a question
     * 
     * @param \App\Question $question
     * @param Request $request
     * 
     * @return boolean;
     */
    public function addQuestionOption(Question $question, Request $request){
        collect($request->get('options'))->each(function($text) use ($question,$request){
                $option = Option::create(['options_text'=>$text,'question_id'=>$question->id]);
                if($text==$request->get('answer')){
                    Answer::create(['question_id'=>$question->id,'option_id'=>$option->id]);
                }
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validate  = Validator::make($request->all(),[
            'question_text'=>'required',
            'question_type'=>['required',Rule::in(['multi','binary'])],
            'options'=>'required|array|distinct',
            'category_id'=>'required|integer|exists:Categories,id',
            'answer'=>'required|in_array:options.*',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 200, []);
        }else{
            $question->question_text = $request->get('question_text');
            $question->question_type = $request->get('question_type');
            
            for($i=0; $i<count($request->get('options')); $i++){
                Option::where('id', $question->options[$i]->id)
                        ->update(['options_text'=> $request->get('options')[$i]]);
                if($request->get('options')[$i] === $request->get('answer')){
                    Answer::where('id', $question->answer->id)
                            ->update(['option_id'=> $question->options[$i]->id ]);
                }
                
            }
            $question->categories()->detach($question->categories->first()->id);
            $question->save();
            $categories = $question->categories()->save(Category::where('id',$request->get('category_id'))->first());
            $questions = $question->whereId($question->id)->get()->each(function($q){
                $q->options;
                $q->answer;
            });
            $questions->push(["categories"=>$categories]);
             return response()->json($questions, 200, []);
        }
    }

    /**
     * Updates options to a question
     * 
     * @param \App\Question $question
     * @param Request $request
     * 
     * @return boolean;
     */
    public function updateQuestionOption(Question $question, Request $request){
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
