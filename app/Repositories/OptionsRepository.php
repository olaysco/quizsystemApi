<?php

namespace App\Repositories;

use App\Option;
use App\Answer;

class OptionsRepository{

    /**
     * 
     * Transforms  option_id 
     * into option model
     * 
     * @param int question_id
     * @return App/Question
     */
     public function getOption($option_id){
         return Option::whereId($option_id)->first();
     }
     


}


?>