<?php

namespace App\Http\Controllers;


use App\blog_articles;
use App\blogs;
use App\depart_articles;
use App\depart_books;
use App\depart_serieses;
use App\departs;
use App\news;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()

    {

        $this->middleware(function($request,$next)

        {

            if (Auth::check())
            {
                if (Auth::user()->user_type == 0)
                {
                    alert(__('Sorry You cant Access This'))->persistent('Ok');
                    return redirect('/');
                }

                return $next($request);

            }

            else
            {
                return redirect('login');
            }



        }
        );

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type',0)->latest()->get();
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();


        return view('home',['users'=>$users,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }

}
