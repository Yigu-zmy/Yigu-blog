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
        $evepagecnt = 5;
        try {
            $page = $request->input('page');
            if($page==null || $page=="") $page = 0;
            $catergoryid = $request->input('categoryid');
            $curcategory = Categorys::where('id','=',$catergoryid)->first();
            if($catergoryid == null)
                $articles = Article::select('*')->skip($page*$evepagecnt)->take($evepagecnt)->get();
            else   $articles = Article::where('category','=',$catergoryid)->skip($page*$evepagecnt)->take($evepagecnt)->get();
            foreach ($articles as $article) {
                $id = $article->userid;
                $username = User::where('id', '=', $id)->first()->name;
                $category = Categorys::where('id', '=', $article->category)->first()->name;
                $article->username = $username;
                $article->category = $category;
            }
            $categorys = Categorys::all();
            $path = config("app.url")."/articles?";

            if($catergoryid!=null) {
                $path.="categoryid=".$catergoryid;
                $pagecnts = ceil(count(Article::where('category','=',$catergoryid)->get())/$evepagecnt);
            }else $pagecnts = ceil(count(Article::all())/$evepagecnt);
            return view('articles/index')
                ->with('articles',$articles)
                ->with('categorys',$categorys)
                ->with('curcategory',$curcategory)
                ->with('curpage',$page)
                ->with('evepagecnt',$evepagecnt)
                ->with('pagecnts',$pagecnts)
                ->with('path',$path);
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
        $evepagecnt = 5;
        try {
            $page=$request->input("page");
            if($page==null || $page=="") $page=0;
            $categoryid = $request->input('categoryid');
            $userid = Auth::user()->id;
            if($categoryid==null)
                $articles = Article::where('userid', '=', $userid)->skip($page*$evepagecnt)->take($evepagecnt)->get();
            else $articles = Article::where('userid', '=', $userid)->where('category','=',$categoryid)->skip($page*$evepagecnt)->take($evepagecnt)->get();
            foreach ($articles as $art) {
                $cat = Categorys::where('id', '=', $art->category)->first()->name;
                $art->category = $cat;
            }
            $categorys = Categorys::select('name', 'id')->get();
            $path = config("app.url")."/updatearticle?";
            if($categoryid!=null){
                $path.="categoryid=".$categoryid;
                $pagecnts = ceil(count(Article::where('category','=',$categoryid)->get())/$evepagecnt);
                $categoryid=Categorys::where('id','=',$categoryid)->first();
            }else $pagecnts = ceil(count(Article::where('userid', '=', $userid)->get())/$evepagecnt);
            return view('article/update')
                ->with('articles', $articles)
                ->with('categorys', $categorys)
                ->with('curcategory',$categoryid)
                ->with('curpage',$page)
                ->with('pagecnts',$pagecnts)
                ->with('evepagecnt',$evepagecnt)
                ->with('path',$path);
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
    }
    
}
