<?php

namespace App\Http\Controllers\Data;

use App\Model\Article;
use App\Model\Categorys;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;


class DataController extends Controller
{
    
    public function getArticles(Request $request){
        try {
            $catergoryid = $request->input('categoryid');
            $curcategory = Categorys::where('id','=',$catergoryid)->first();
            if($catergoryid == null)
                $articles = Article::all();
            else   $articles = Article::where('category','=',$catergoryid)->get();
            foreach ($articles as $article) {
                $id = $article->userid;
                $username = User::where('id', '=', $id)->first()->name;
                $category = Categorys::where('id', '=', $article->category)->first()->name;
                $article->username = $username;
                $article->category = $category;
            }
            $categorys = Categorys::all();
            return view('articles/index')
                ->with('articles',$articles)
                ->with('categorys',$categorys)
                ->with('curcategory',$curcategory);
        }catch (Exception $e){
            return view('errors/503');
        }


    }
    
    public function getArticle(Request $request){
        try{
            $id = $request->input('id');
            $article = Article::where('id','=',$id)->first();
            $username = User::where('id','=',$article->userid)->first()->name;
            $categoryname = Categorys::where('id','=',$article->category)->first()->name;
            $article->username = $username;
            $article->categoryname = $categoryname;
            return view('article/index')->with('article',$article);
        }catch (Exception $e){
            return view('errors/503');
        }
    }
    
    public function insertArticles(Request $request){
        try {
            $title = $request->input('title');
            $content = $request->input('content');
            $category = $request->input('category');
            $userid = Auth::user()->id;
            $article = new Article();
            $article->title = $title;
            $article->content = $content;
            $article->userid = $userid;
            $article->category = Categorys::where('name','=',$category)->first()->id;
            $article->save();
            return $article->id;
        }catch (Exception $ex){
            return 0;
        }
    }

    public function getUserArticles(Request $request){
        try {
            $categoryid = $request->input('categoryid');
            $userid = Auth::user()->id;
            if($categoryid==null)
                $articles = Article::where('userid', '=', $userid)->get();
            else $articles = Article::where('userid', '=', $userid)->where('category','=',$categoryid)->get();
            foreach ($articles as $art) {
                $cat = Categorys::where('id', '=', $art->category)->first()->name;
                $art->category = $cat;
            }
            $categorys = Categorys::select('name', 'id')->get();
            if($categoryid!=null)$categoryid=Categorys::where('id','=',$categoryid)->first();
            return view('article/update')
                ->with('articles', $articles)
                ->with('categorys', $categorys)
                ->with('curcategory',$categoryid);
        }catch (Exception $e){
            return view('errors/503');
        }
    }

    public function getUserArticleForUpdate(Request $request){
        try{
            $id = $request->input('id');
            $article = Article::where('id','=',$id)->first();
            $username = User::where('id','=',$article->userid)->first()->name;
            $categoryname = Categorys::where('id','=',$article->category)->first()->name;
            $article->username = $username;
            $article->categoryname = $categoryname;
            $categorys = Categorys::select('name','id')->get();
            return view('article/upedit')
                ->with('article',$article)
                ->with('categorys',$categorys);
        }catch (Exception $e){
            return view('errors/503');
        }
    }
    
    public function updateArticle(Request $request){
        $result = array();
        $result['status'] = true;
        $result['data'] = [];
        try{
           $article = Article::where('id','=',$request->input('id'))->first();
            $article->title = $request->input('title');
            $article->content = $request->input('content');
            $article->category = Categorys::where('name','=',$request->category)->first()->id;
            $article->save();
            $result['data'] = $article->id;
        }catch (Exception $e){
            $result['status'] = false;
        }
        return $result['data'];
    }

    public function deleteArticle(Request $request){
        $id = $request->input('id');
        try{
            $article = Article::where('id','=',$id)->first();
            $article->delete();
            return "true";
        }catch (Exception $ex){
            return "false";
        }
        return true;
    }



    public function getCategorys(){
        $categorys = Categorys::all();
        return view('categorys/index')->with('categorys',$categorys);
    }

    public function insertCategory(Request $request){
        try{
            $name = $request->input('category');
            $userid = Auth::user()->id;
            $t_result = Categorys::withTrashed()->where('userid','=',$userid)->where('name','=',$name)->first();
            if($t_result==NULL) {
                $category = new Categorys();
                $category->name = $request->input('category');
                $category->userid = Auth::user()->id;
                $category->save();
            }else $t_result->restore();
            return "Succeed";
        }catch (Exception $e){
            return "Failed";
        }
    }

    public function updatecategory(Request $request){
        try {
            $old = $request->input('old');
            $new = $request->input('category');

            $cat = Categorys::where('name', '=', $old)->first();
            $cat->name = $new;
//            return var_dump($cat);
            $cat->save();
            return "Update Succeed";
        }catch (Exception $ex){
            return "Update Failed";
        }
//        return "ss";
    }
    
}
