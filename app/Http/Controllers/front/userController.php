<?php

namespace App\Http\Controllers\front;

use App\blog_article_comments;
use App\depart_articel_comments;
use App\depart_articel_rates;
use App\depart_articles;
use App\depart_book_comments;
use App\depart_book_rates;
use App\depart_books;
use App\depart_serie_comments;
use App\depart_serie_rates;
use App\depart_serieses;
use App\new_comments;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\home_details;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Hash;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check())
        {
            alert(__('انت بالفعل مستخدم لدى موقع الصفوه'))->persistent('استمرار');
            return redirect('/');
        }
        else
        {
            $detail = home_details::where('id',1)->first();
            return view('front.register',['detail'=>$detail]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'retype_password'=>'required|same:password',
        ]);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $request->retype_password;
        $user->save();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->retype_password]))
        {
            // Authentication passed...
            alert(__('مرحبا بك فى موقع الصفوه للانتاج الفنى'))->persistent('استمرار');
            return redirect('/');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'exists:users,email',
            'password'=>'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            // Authentication passed...
            alert(__('مرحبا بك فى موقع الصفوه للانتاج الفنى'))->persistent('استمرار');
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        alert(__('تم تسجيل الخروج بنجاح'))->persistent('استمرار');
        return redirect('/');
    }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $fb_user = Socialite::driver('facebook')->user();

        $find_user = User::where('email',$fb_user->email)->first();

        if ($find_user)
        {
            Auth::login($find_user);
            // Authentication passed...
            alert(__('مرحبا بك فى موقع الصفوه للانتاج الفنى'))->persistent('استمرار');
            return redirect('/');
        }
        else
        {
            $user = new User;


            $user->name= $fb_user->name;
            $user->email= $fb_user->email;
            $user->password= '123456';

            $user->save();

            Auth::login($user);
            // Authentication passed...
            alert(__('مرحبا بك فى موقع الصفوه للانتاج الفنى'))->persistent('استمرار');
            return redirect('/');

        }


    }






    public function show($id)
    {
        $user = User::find($id);
        $detail = home_details::where('id',1)->first();


        return view('front.profile',['detail'=>$detail,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $detail = home_details::where('id',1)->first();

        return view('front.edit_profile',['detail'=>$detail,'user'=>$user]);
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
        $user = User::find($id);
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
        ]);
        $user->name= $request->name;
        $user->email= $request->email;
        $hashedPassword = Hash::make($request->password);
        if($hashedPassword != $user->password){
            $user->password = $request->password;
        }
        if($request->hasFile('file')){
            $file=$request->file('file');
            $url=time().$file->getClientOriginalName();
            $desti=public_path('/uploads');
            /*$desti=base_path('/uploads');*/
            if ($file->move($desti ,$url))
            {

                $user->img_url=$url;
            }
            else
            {
                echo 'not move';
            }
        }

        $user->save();

        alert(__('تم تعديل بياناتك بنجاح'))->persistent('استمرار');
        return redirect('/users/'.$user->id);

    }


    public function add_comment_rate_to_series(Request $request)
    {
        $series_comment=new depart_serie_comments;
        $series_comment->comment = $request->comment;
        $series_comment->user_id = Auth::user()->id;
        $series_comment->depart_serieses_id = $request->depart_series;
        if ($series_comment->comment != '')
        {
            $series_comment->save();

            $oldRate = depart_serie_rates::where('depart_serieses_id',$request->depart_series)->where('users_id',Auth::user()->id)->first();

            if(is_null($oldRate))
            {
                $series_rate=new depart_serie_rates;
                $series_rate->rate = $request->rating;
                $series_rate->users_id = Auth::user()->id;
                $series_rate->depart_serieses_id = $request->depart_series;
                if ($series_rate->rate == 0)
                {
                    return back();
                }
                else
                {
                    $series_rate->save();
                    $allRates = depart_serie_rates::where('depart_serieses_id',$request->depart_series)->get();
                    $sum = 0;
                    $total = count($allRates);
                    foreach($allRates as $rate){
                        $sum += $rate->rate;
                    }
                    $rate_avr= $sum/$total;
                    $series = depart_serieses::where('id',$request->depart_series)->first();
                    $series->rate = $rate_avr;
                    $series->save();
                }

            }

            return back();
        }
        else
        {
            return back();
        }




    }

    public function add_comment_rate_to_book(Request $request)
    {
        $book_comment=new depart_book_comments();
        $book_comment->comment = $request->comment;
        $book_comment->user_id = Auth::user()->id;
        $book_comment->depart_books_id = $request->depart_book;
        if ($book_comment->comment != '')
        {
            $book_comment->save();

            $oldRate = depart_book_rates::where('depart_books_id',$request->depart_book)->where('users_id',Auth::user()->id)->first();

            if(is_null($oldRate))
            {
                $book_rate=new depart_book_rates;
                $book_rate->rate = $request->rating;
                $book_rate->users_id = Auth::user()->id;
                $book_rate->depart_books_id = $request->depart_book;
                if ($book_rate->rate == 0)
                {
                    return back();
                }
                else
                {
                    $book_rate->save();
                    $allRates = depart_book_rates::where('depart_books_id',$request->depart_book)->get();
                    $sum = 0;
                    $total = count($allRates);
                    foreach($allRates as $rate){
                        $sum += $rate->rate;
                    }
                    $rate_avr= $sum/$total;
                    $book = depart_books::where('id',$request->depart_book)->first();
                    $book->rate = $rate_avr;
                    $book->save();
                }

            }

            return back();
        }
        else
        {
            return back();
        }




    }

    public function add_comment_rate_to_depart_article(Request $request)
    {
        $article_comment=new depart_articel_comments;
        $article_comment->comment = $request->comment;
        $article_comment->user_id = Auth::user()->id;
        $article_comment->depart_articles_id = $request->depart_article;
        if ($article_comment->comment != '')
        {
            $article_comment->save();

            $oldRate = depart_articel_rates::where('depart_articles_id',$request->depart_article)->where('users_id',Auth::user()->id)->first();

            if(is_null($oldRate))
            {
                $article_rate=new depart_articel_rates;
                $article_rate->rate = $request->rating;
                $article_rate->users_id = Auth::user()->id;
                $article_rate->depart_articles_id = $request->depart_article;
                if ($article_rate->rate == 0)
                {
                    return back();
                }
                else
                {
                    $article_rate->save();
                    $allRates = depart_articel_rates::where('depart_articles_id',$request->depart_article)->get();
                    $sum = 0;
                    $total = count($allRates);
                    foreach($allRates as $rate){
                        $sum += $rate->rate;
                    }
                    $rate_avr= $sum/$total;
                    $article = depart_articles::where('id',$request->depart_article)->first();
                    $article->rate = $rate_avr;
                    $article->save();
                }

            }

            return back();
        }
        else
        {
            return back();
        }




    }

    public function add_comment_to_new(Request $request)
    {
        $new_comment=new new_comments;
        $new_comment->comment = $request->comment;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->news_id = $request->new;
        if ($new_comment->comment != '')
        {
            $new_comment->save();
            return back();
        }
        else
        {
            return back();
        }


    }

    public function add_comment_to_blog_article(Request $request)
    {
        $article_comment=new blog_article_comments;
        $article_comment->comment = $request->comment;
        $article_comment->user_id = Auth::user()->id;
        $article_comment->blog_articles_id = $request->blog_article;
        if ($article_comment->comment != '')
        {
            $article_comment->save();
            return back();
        }
        else
        {
            return back();
        }


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
