<?php

namespace App\Http\Controllers\Admin;

use App\info_images;
use App\infos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use UxWeb\SweetAlert\SweetAlert;
use App\departs;
use App\depart_serieses;
use App\depart_articles;
use App\depart_books;
use App\news;
use App\blogs;
use App\blog_articles;
use App\home_slides;
use App\home_details;

class infosController extends Controller
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

        $infos = infos::all();

        return view('admin.infos.all',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count,'infos'=>$infos]);
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

        return view('admin.infos.new',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
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
            'description'=>'required',
            'images' => 'required',
            'images.*' => 'mimetypes:image/jpeg,image/png', //only allow this type extension file.
        ]);
        $info = new infos;
        $info->description = $request->description;
        $info->save();
        if($request->hasFile('images')){
            $files=$request->file('images');
            foreach($files as $file)
            {

                $url=time().$file->getClientOriginalName();
                $desti=public_path('/uploads');
                /*$desti=base_path('/uploads');*/
                if ($file->move($desti ,$url))
                {
                    $info_img = new info_images;
                    $info_img->img_url=$url;

                    $info_img->save();
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

        session()->flash('message',' تمت اضافه الملعومات بنجاح');

        return redirect(url('admin/infos'));
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

        $info = infos::find($id);
        $imgs = info_images::all();

        return view('admin.infos.edit',['departs_count'=>$departs_count,'departs_series_count'=>$departs_series_count
            ,'departs_articles_count'=>$departs_articles_count,'departs_books_count'=>$departs_books_count
            ,'news_count'=>$news_count,'blogs_count'=>$blogs_count,'blogs_article_count'=>$blogs_article_count,'info'=>$info
            ,'imgs'=>$imgs]);
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
        $info = infos::find($id);

        $this->validate($request,[
            'description'=>'required',
            'images.*' => 'mimetypes:image/jpeg,image/png', //only allow this type extension file.
        ]);

        $info->description = $request->description;
        $info->save();

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
                $info_img = new info_images();
                $info_img->img_url=$url;

                $info_img->save();
            }
            else
            {
                echo 'not move';
            }
        }



        foreach($deletedImages as $image){
            $deletedImg = info_images::where('id',$image)->first();
            if(!is_null($deletedImg)){
                $deletedImg->delete();
            }
        }


        session()->flash('message',' تمت تعديل المعلومات بنجاح ');

        return redirect(url('admin/infos'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
