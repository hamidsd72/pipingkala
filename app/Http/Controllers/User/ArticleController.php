<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\ArticleCategory;
use App\ArticleAttribute;
use App\AttributeArticleJoin;
use App\Comment;
use App\ArticleVisit;
use App\Category;
use App\Arate;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ArticleController extends Controller
{


    public function allArticle(){

        $articles = Article::orderBy('created_at','desc')->paginate(15);

        $title = 'مقالات';
        $titlt_page = $title;
        return view('article.index' , compact('titlt_page','articles' , 'title'));

    }

    public function allNews(){

        $articles = News::orderBy('created_at','desc')->paginate(15);

        $title = 'اخبار';
        $titlt_page = $title;

        return view('article.index' , compact('titlt_page','articles' , 'title'));

    }
    public function articles($id)
        {
        $attribu=AttributeArticleJoin::all();
        foreach ($attribu as $a){
            session()->forget($a->value);
        }

        $articles = Article::where('category_id',$id)->orderBy('created_at','desc')->paginate(15);
        $category = ArticleCategory::find($id);
        $attributes = ArticleAttribute::where('category_id',$id)->get();
        $categoryId = $id;
        $num=15;
        $order='created_at';
        $dir='desc';
        return view('articles',compact('articles','category','categoryId','num','order','dir','attributes'));
    }

    public function article($id)
    {
        $article = Article::find($id);
        $compares= Article::skip(5)->take(2)->where('category_id',$article->category_id)->where('id', '!=', $id)->get();
        $articles = Article::where('category_id',$article->category_id)->where('id','!=',$article->id)->get();
        $comments = Comment::where('status',1)->where('article_id',$id)->get();
        $category = ArticleCategory::find($article->category_id);
        $rates= Arate::where('article_id',$id)->get();
        $titlt_page = $article->title;

        $sum=0;
        $count = count($rates);
        foreach ($rates as $rate)
        {
            $sum += $rate->rate;
        }

        if($count != 0)
        {
            $rate = ($sum)/($count);
        }
        else
        {
            $rate =0;
        }

        $sys = self::systemInfo();

        $vis = ArticleVisit::where(['article_id' => $article->id, 'ip' => $sys['ip']])->first();
        if (!$vis) {
            $visit = ArticleVisit::create([
                'article_id' => $article->id,
                'ip' => $sys['ip'],
                'device' => $sys['device'],
                'os' => $sys['os'],
            ]);
        }


        return view('blog.show',compact('titlt_page','article','rate','count','comments','articles','compares','category'));
    }

    public function article_comment(Request $request)
    {
        dd($request);
    }

    public function sort(Request $request ,$id)
    {
        if ($request->order == 'created_at'){
            if($request->dir == 'desc'){
                $articles = Article::where('category_id',$id)->orderBy('created_at','desc')->paginate($request->num);
            }else{
                $articles = Article::where('category_id',$id)->orderBy('created_at','asc')->paginate($request->num);
            }
        }else{
            if($request->dir == 'desc'){
                $articles = Article::where('category_id',$id)->orderBy('price','desc')->paginate($request->num);
            }else{
                $articles = Article::where('category_id',$id)->orderBy('price','asc')->paginate($request->num);
            }
        }

        $category = ArticleCategory::find($id);
        $attributes = ArticleAttribute::where('category_id',$id)->get();
        $categoryId = $id;
        $num=$request->num;
        $order=$request->order;
        $dir=$request->dir;
        return view('articles',compact('articles','attributes','category','categoryId','num','order','dir'));
    }

    public function filter(Request $request, $id)
    {
        $attribu=AttributeArticleJoin::whereIn('attribute_id',$request->attr_id)->get();
        foreach ($attribu as $a){
            session()->forget($a->value);
        }
        $attrs = array();
        foreach ($request->attr_id as $key => $item) {
            if ($request->$item) {
                foreach ($request->$item as $at) {
                    session([$at => $at]);
                }
                $attrs[] = AttributeArticleJoin::whereIn('value', $request->$item)->get();
            }
        }
        $fin = array();
        $fin1 = array();
        foreach ($attrs as $attr) {
            foreach ($attr as $att) {
                $fin[] = $att->article_id;
            }
            $fin1[] = $fin;
            $fin = null;
        }
        $end = count($fin1);
        if ($end > 1) {
            for ($i = 0; $i < $end - 1;) {
                $fin3 = array_intersect($fin1[$i], $fin1[++$i]);
                $fin1[$i] = $fin3;
            }
            $articles = Article::whereIn('id', $fin3)->where('category_id',$id)->paginate(15);
        } else {
            if (count($fin1)) {
                $fin3 = $fin1[0];
                $articles = Article::whereIn('id', $fin3)->where('category_id',$id)->paginate(15);
            }else{
                $articles = Article::where('category_id',$id)->orderBy('created_at','desc')->paginate(15);
            }
        }
        $category = ArticleCategory::find($id);
        $attributes = ArticleAttribute::where('category_id', $id)->get();
        $categoryId = $id;
        $num = 15;
        $order = 'created_at';
        $dir = 'desc';
        return view('articles', compact('articles', 'category', 'categoryId', 'num', 'order', 'dir', 'attributes'));
    }

    public static function systemInfo()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    = "Unknown OS Platform";
        $os_array       = array('/windows phone 8/i'    =>  'Windows Phone 8',
            '/windows phone os 7/i' =>  'Windows Phone 7',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile');
        $found = false;
        $device = '';
        foreach ($os_array as $regex => $value)
        {
            if($found)
                break;
            else if (preg_match($regex, $user_agent))
            {
                $os_platform    =   $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                    ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
            }
        }
        $device = !$device? 'SYSTEM':$device;

        $ip = getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
                getenv('HTTP_X_FORWARDED') ?:
                    getenv('HTTP_FORWARDED_FOR') ?:
                        getenv('HTTP_FORWARDED') ?:
                            getenv('REMOTE_ADDR');

        return array('os'=>$os_platform,'device'=>$device, 'ip'=> $ip);
    }
}