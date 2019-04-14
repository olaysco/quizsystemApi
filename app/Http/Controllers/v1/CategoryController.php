<?php

namespace App\Http\Controllers\v1;


use App\Category;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    /**
     * 
     * creates new Category instance
     * 
     * @return void
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        return response()->json($category, 200, []);
    }
    

    /**
     * 
     * Gets all the question for a given category
     * 
     * @param category
     * @return collection
     */

    public function categoryQuestions(Category $category){
         return response()->json($category->questions,200,[]);
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
        $validator = Validator::make($request->all(),[
            'category_name'=>'required|unique:categories|max:200',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 200, []);
        }else{
            $category_name = $request->get('category_name');
            $category = new Category();
            $category->category_name = $category_name;
            $category->save();
            return response()->json($category, 200, []);
        }
        
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'category_name'=>'required|unique:categories|max:200',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 200, []);
        }else{
            $category_name = $request->get('category_name');
            $category->category_name = $category_name;
            $category->save();
            return response()->json($category, 200, []);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
