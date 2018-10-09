<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use App\departs;
use App\depart_books;
use App\blog_articles;
use App\blogs;
use App\depart_articles;
use App\depart_serieses;
use App\news;

class depart_booksController extends Controller
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

        $departs = departs::all();


        return view('admin.departs.books.all',['departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }


    public function get_books($filter)
    {
        $boook = depart_books::latest()->get(['depart_books.*']);

        if($filter != 0)
            $boook = $boook->where('departs_id',$filter);

        return Datatables::of($boook)
            ->addIndexColumn()
            ->addColumn('depart', function ($boook)
            {
                $depart = departs::where('id',$boook->departs_id)->first();
                return $depart->name;

            })
            ->addColumn('action', function ($boook)
            {
                return '<a href="books/'.$boook->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> تعديل</a> 
            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$boook->id.'">
            <i class="fa fa-trash-o"></i> حذف</a>
            
            <div class="modal fade" id="deletemodel'.$boook->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">هل انت متاكد من انك تريد حذف هذا الكتاب ؟</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">برجاء العلم انك اذا قمت بحذف هذا المقال فسوف يتم حذف كل التعليقات و التقييمات عليه</p>
                            <form action='. url('admin/books/'.$boook->id) .' method="post" class="text-center"> '.
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


        $departs = departs::all();
        return view('admin.departs.books.new',['departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $book = new depart_books();
        $this->validate($request,[
            'depart'=>'required',
            'name'=>'required',
            'description'=>'required',
            'url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);


        $book->departs_id = $request->depart;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->url = $request->url;

        $book->save();

        session()->flash('message',' تمت اضافه '.$book->name.' بنجاح ');

        return redirect(url('admin/books'));
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


        $book =  depart_books::find($id);
        $departs = departs::all();
        return view('admin.departs.books.edit',['book'=>$book,'departs'=>$departs,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $book = depart_books::find($id);
        $this->validate($request,[
            'depart'=>'required',
            'name'=>'required',
            'description'=>'required',
            'url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);


        $book->departs_id = $request->depart;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->url = $request->url;

        $book->save();

        session()->flash('message',' تمت تعديل '.$book->name.' بنجاح ');

        return redirect(url('admin/books'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = depart_books::find($id);
        $book->delete();
        session()->flash('message','تم الحذف بنجاح');
        return redirect(url('admin/books'));
    }
}
