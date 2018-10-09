<?php

namespace App\Http\Controllers\admin;

use App\new_imgs;
use App\news;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;

use App\blog_articles;
use App\blogs;
use App\depart_articles;
use App\depart_books;
use App\depart_serieses;
use App\departs;

class newsController extends Controller
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

        return view('admin.news.all',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count]);
    }


    public function get_news()
    {
        $new = news::latest()->get(['news.*']);

        return Datatables::of($new)
            ->addIndexColumn()
            ->addColumn('action', function ($new)
            {
                return '<a href="news/'.$new->id.'/edit" class="btn btn-xs btn-primary">
            <i class="fa fa-pencil-square-o"></i> تعديل</a> 
            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deletemodel'.$new->id.'">
            <i class="fa fa-trash-o"></i> حذف</a>
            
            <div class="modal fade" id="deletemodel'.$new->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">هل انت متاكد من انك تريد حذف هذا الخبر؟</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">برجاء العلم انك اذا قمت بحذف هذا الخبر فسوف يتم حذف كل التعليقات عليه </p>
                            <form action='. url('admin/news/'.$new->id) .' method="post" class="text-center"> '.
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
            ->addColumn('image', function ($new)
            {
                if (count($new->news_images) > 0)
                {
                    $url= $new->news_images[0]->img_url;
                    return $url;

                }
                else
                {
                    return 'prop-placeholder.png';
                }

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


        return view('admin.news.new',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $this->validate($request,[
            'tittle'=>'required',
            'message'=>'required',
            'images' => 'required',
            'images.*' => 'mimetypes:image/jpeg,image/png', //only allow this type extension file.
        ]);

        $new = new news;
        $new->name = $request->tittle;
        $new->description = $request->message;
        $new->save();
        if($request->hasFile('images')){
            $files=$request->file('images');
            foreach($files as $file)
            {

                $url=time().$file->getClientOriginalName();
                $desti=public_path('/uploads');
                /*$desti=base_path('/uploads');*/
                if ($file->move($desti ,$url))
                {
                    $newimage = new new_imgs();
                    $newimage->news_id=$new->id;
                    $newimage->img_url=$url;

                    $newimage->save();
                }
                else
                {
                    echo 'not move';
                }
            }


        }
        else {

            echo 'Not Uploaded';
        }

        session()->flash('message',' تمت اضافه '.$new->name.' بنجاح ');

        return redirect(url('admin/news'));

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



        $new = news::find($id);
        return view('admin.news.edit',['new'=>$new,'departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
        $new = news::find($id);

        $this->validate($request,[
            'tittle'=>'required',
            'message'=>'required',
            'images.*' => 'mimetypes:image/jpeg,image/png', //only allow this type extension file.
        ]);

        $new->name = $request->tittle;
        $new->description = $request->message;
        $new->save();

        if($request->hasFile('images')){
            $files=$request->file('images');
        }
        else{
            $files = array();
        }
        $deletedImages = $request->deletedImages;

        foreach($files as $file)
        {

            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {
                $newimage = new new_imgs();
                $newimage->news_id=$new->id;
                $newimage->img_url=$url;

                $newimage->save();
            }
            else
            {
                echo 'not move';
            }
        }



        foreach($deletedImages as $image){
            $deletedImg = new_imgs::where('id',$image)->first();
            if(!is_null($deletedImg)){
                $deletedImg->delete();
            }
        }


        session()->flash('message',' تمت تعديل '.$new->name.' بنجاح ');

        return redirect(url('admin/news'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = news::find($id);
        $new->delete();
        session()->flash('message','تم الحذف بنجاح');
        return redirect(url('admin/news'));
    }
}
