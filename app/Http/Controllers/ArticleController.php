<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth')->except(['index','detail']);
   }   

   public function index(){
      // $data= Article::all();
      $data = Article::latest()->paginate(5);


      return view('articles/index',[
         'articles'=>$data 
      ]);
   }
   public function detail($id){

      $article = Article::find($id); // <--
      
      return view("articles/detail",[
         'article' => $article       // <--
      ]);
   }

   public function delete($id){
      $article = Article::find($id);
      if(Gate::allows('delete-article',$article)){

         $article->delete();
         return redirect('/articles')->with("info","An article deleted");
      }

      return back()->with('info','Unauthorized to delete');

   }

   public function add(){
      $article = Article::all();
      $category = Category::all();


      return view('articles/add',[
         'article' => $article,
         'category' => $category
      ]);
   }

   public function create(){
      //route with post method

      // make sure the form filled completely
      $validator = validator(request()->all(),[
         "title" => "required",
         "body" => "required",
         "category_id" => "required",
      ]);

      if($validator->fails()){
         return back()->withErrors($validator); //redirect to the last address
      }

      $article = new Article;     
       // request can work as both post and get method
      $article->title = request()->title; 
      $article->body = request()->body;
      $article->category_id = request()->category_id;
      $article->user_id = auth()->user()->id;
      $article->save(); //save data to database

      return redirect('/articles');
   }

   public function edit($id){

      $article = Article::find($id);
      $category = Category::all();
      
      return view('/articles/edit',[
         'article' => $article,
         'category' => $category
      ]);
   }
   
   public function updated($id){

      $validator = validator(request()->all(),[
         'title'=>'required',
         'body' => 'required',
         'category_id' => 'required',
      ]);

      if($validator->fails()){
         return back()->withErrors($validator);
      }

      // $article = new Article;

      $article = Article::find($id);
      $article->title = request()->title;
      $article->body = request()->body;
      $article->category_id = request()->category_id;
      $article->user_id = auth()->user()->id;
      $article->update();

      return redirect('/articles')->with('info','an article is updated');
   }
}

