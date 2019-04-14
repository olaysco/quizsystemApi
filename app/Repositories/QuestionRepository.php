<?php

namespace App\Repositories;

use App\Category;
use App\Question;

class CategoryRepository{

    /**
     * 
     * Gets all the question for a given category
     * 
     * @param category
     * @return collection
     */

     public function question($question_id){
         return Question::whereId($question_id)->get();
     }


}


?>