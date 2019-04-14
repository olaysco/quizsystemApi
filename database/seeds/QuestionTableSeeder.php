<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Question::class,10)->create()->each(function($question){
            factory(App\Option::class,3)->create(
                ['question_id'=>$question->id]
            );
            factory(App\Answer::class,1)->create(
                ['question_id'=>$question->id,
                 'option_id'=>$this->getRandomAnswerId($question)]
            );
            $question->categories()->save($this->getRandomCategories());
        });
    }

    public function getRandomCategories(){
        $categories = App\Category::all()
                        ->sortBy(DB::raw('RAND'));
        return $categories->shuffle()->first();
    }

    public function getRandomAnswerId($question){
        return $question->options->shuffle()->first()->id;
        
    }
}
