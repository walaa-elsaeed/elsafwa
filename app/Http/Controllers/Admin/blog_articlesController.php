<?php

namespace App\Http\Controllers\Admin;

use App\blog_articles;
use App\blogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use App\departs;
use App\depart_serieses;
use App\depart_articles;
use App\depart_books;
use App\news;

class blog_articlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();
        $blogs = blogs::all();

        return view('admin.blogs.articles.all',['blogs'=>$blogs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }


    public function get_articles($filter)
    {
        $article = blog_articles::latest()->get(['blog_articles.*']);

        if($filter != 0)
            $article = $article->where('blogs_id',$filter);

        return Datatables::of($article)
            ->addIndexColumn()
            ->addColumn('blog', function ($article)
            {
                $blog = blogs::where('id',$article->blogs_id)->first();
                return $blog->name;

            })
            ->addColumn('action', function ($article)
            {
                return '<a href="blog_articles/'.$article->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> تعديل</a> 
            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$article->id.'">
            <i class="fa fa-trash-o"></i> حذف</a>
            
            <div class="modal fade" id="deletemodel'.$article->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">هل انت متاكد من انك تريد حذف هذا المقال ؟</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">برجاء العلم انك اذا قمت بحذف هذا المقال فسوف يتم حذف كل التعليقات و التقييمات عليه</p>
                            <form action='. url('admin/blog_articles/'.$article->id) .' method="post" class="text-center"> '.
                    csrf_field().
                    method_field('DELETE').'
                               <button class="btn btn-default" type="submit">
                                    حذف
                                </button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">إلغاء</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            })
            ->make (true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();


        $blogs = blogs::all();
        return view('admin.blogs.articles.new',['blogs'=>$blogs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new blog_articles;
        $this->validate($request,[
            'blog'=>'required',
            'name'=>'required',
            'description'=>'required',
        ]);


        $article->blogs_id = $request->blog;
        $article->name = $request->name;
        $article->description = $request->description;

        $article->save();

        session()->flash('message',' تمت اضافه '.$article->name.' بنجاح ');

        return redirect(url('admin/blog_articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departs_count = departs::count();
        $departs_series_count = depart_serieses::count();
        $departs_articles_count = depart_articles::count();
        $departs_books_count = depart_books::count();
        $news_count = news::count();
        $blogs_count = blogs::count();
        $blogs_article_count = blog_articles::count();


        $article = blog_articles::find($id);
        $blogs = blogs::all();
        return view('admin.blogs.articles.edit',['article'=>$article,'blogs'=>$blogs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = blog_articles::find($id);
        $this->validate($request,[
            'blog'=>'required',
            'name'=>'required',
            'description'=>'required',
        ]);


        $article->blogs_id = $request->blog;
        $article->name = $request->name;
        $article->description = $request->description;

        $article->save();

        session()->flash('message',' تمت اضافه '.$article->name.' بنجاح ');

        return redirect(url('admin/blog_articles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = blog_articles::find($id);
        $article->delete();
        session()->flash('message','تم الحذف بنجاح');
        return redirect(url('admin/blog_articles'));
    }
}
