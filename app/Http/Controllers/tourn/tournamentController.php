<?php

namespace App\Http\Controllers\tourn;

use App\add_sliders;
use App\citys;
use App\matches;
use App\partner_sliders;
use App\reports;
use App\rules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\trade;
use App\Cyber;
use App\news;
use App\zone;
use App\tournaments;
use App\header_sliders;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\scores;
use App\match_rates;
use Illuminate\Support\Facades\View;
use App\guides;
class tournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $zones = citys::all();
        $guides = guides::all();

        $latestCybers = Cyber::latest()->where('status',1)->get();
        $latesttrades = trade::latest()->where('status',1)->get();
        $latestnews = news::latest()->get();


        $tourn = tournaments::all()->last();

        $header_slides = header_sliders::where('tourn_id',$tourn->id)->get();

        $adds = add_sliders::where('tourn_id',$tourn->id)->get();
        $partners = partner_sliders::where('tourn_id',$tourn->id)->get();

        $approved = Cyber::where('status',1)->get();
        $tourn_cybers = $approved->keyBy('id');
        foreach($tourn_cybers as $cyber){
            if(!$cyber->isInTournament($tourn->id)){
                $tourn_cybers->forget($cyber->id);
            }
        }


        if (Auth::check())
        {
            $matchs = matches::where('player1_id',Auth::user()->id)->orwhere('player2_id',Auth::user()->id)->get();
            $ranking =  'SELECT `user_name`,`img_url`,`points`,`g_d`,`num_of_inner_goals`,`num_of_outer_goals`,`num_of_matches`,`win`,`lose`,`draw`,`user_id`,`tourn_id` , @curRank := @curRank + 1 AS rank FROM `scores` LEFT Join `users` on `scores`.`user_id` = `users`.`id` , (SELECT @curRank := 0) r where `scores`.`tourn_id` = '.$tourn->id.' order by `scores`.`points` desc, `scores`.`g_d` desc, `scores`.`num_of_inner_goals` desc ,`scores`.`num_of_matches` asc, `scores`.`id` asc';
            $ranks = DB::select($ranking);
            $ranks_cut = DB::select($ranking);
            $userRankingSql = 'SELECT * From ( '.$ranking.' ) as s where s.`user_id` = '.Auth::user()->id;

            if(count(DB::select($userRankingSql)) > 0){
                $userRanking = DB::select($userRankingSql)[0];
            }
            else{
                $userRanking = new \stdClass();
                $userRanking->rank = count($ranks)+1;
            }

            return view('tourn.home',['latestCybers'=>$latestCybers
                ,'latesttrades'=>$latesttrades,'latestnews'=>$latestnews,'zones'=>$zones,
                'tourn'=>$tourn,'header_slides'=>$header_slides,'adds'=>$adds,'partners'=>$partners,
                'approved'=>$approved,'tourn_cybers'=>$tourn_cybers,'matchs'=>$matchs,'ranks'=>$ranks,
                'ranks_cut'=>$ranks_cut
                ,'userRanking'=>$userRanking,'guides'=>$guides
            ]);

        }
        else
        {
            alert(__('strings.login_to_tourn'))->persistent('Ok');
            return redirect(url('front'));

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function report(Request $request)
    {
        $report = new reports;
        $this->validate($request,[
            'report'=>'required',
        ]);
        $match = matches::where('id',$request->match)->first();
        if($match){
            $report->user_id = Auth::user()->id;
            $report->user_name = Auth::user()->user_name;
            $report->match_id = $request->match;
            $report->cyber_id = $match->cyber_id;
            $report->cyber_name = $match->cyber->name;
            $report->tourn_id = $match->tourn_id;
            $report->massege = $request->report;
            $report->save();
            alert('Your report sent thank you')->persistent('Ok');
            return redirect(url('tournament'));
        }
        else{
            alert('Match not found')->presistent('Ok');
            return redirect(url('tournament'));
        }

    }

    public function match_rate(Request $request)
    {
        $match = matches::where('id',$request->match)->first();

        $oldRate = match_rates::where('match_id',$request->match)->where('user_id',$request->user)->first();

        if(is_null($oldRate))
        {
            $match_rate=new match_rates;
            $match_rate->rate = $request->rating;
            $match_rate->user_id = $request->user;
            $match_rate->match_id = $request->match;
            $match_rate->cyber_id = $match->cyber_id;
            $match_rate->tourn_id = $match->tourn_id;
            if ($match_rate->rate == 0)
            {
                return back();
            }
            else
            {
                $match_rate->save();
                $allRates = match_rates::where('match_id',$request->match)->get();
                $sum = 0;
                $total = count($allRates);
                foreach($allRates as $rate){
                    $sum += $rate->rate;
                }
                $rate_avr= $sum/$total;
                $match = matches::where('id',$request->match)->first();
                $match->rate = $rate_avr;
                $match->save();
                alert('Rate Added ')->persistent('Ok');
                return redirect(url('tournament'));
            }

        }

        return back();
    }


    public function ajaxCyber($zone,$state)
    {
        $tourn = tournaments::all()->last();

        $approved = Cyber::where('status',1)->get();

        $tourn_cybers = $approved->keyBy('id');
        foreach($tourn_cybers as $cyber){
            if(!$cyber->isInTournament($tourn->id)){
                $tourn_cybers->forget($cyber->id);
            }
        }


        if($zone != 0)
            $tourn_cybers = $tourn_cybers->where('zone',$zone);
        if ($state != 2){
            foreach($tourn_cybers as $cyber){
                if($cyber->tourn_cyber_status() != $state){
                    $tourn_cybers->forget($cyber->id);
                }
            }
        }


        $htmlString = View::make('tourn.cyber-card',['tourn_cybers'=>$tourn_cybers])->render();;
        $returnedData = [
            'htmlString'=>$htmlString,
            'tourn_cybers'=>$tourn_cybers,
        ];
        return json_encode($returnedData);
    }

    public function rules_page()
    {
        $rules = rules::where('type',0)->get();
        $rules1 = rules::where('type',1)->get();
        $rules2 = rules::where('type',2)->get();

        $zones = zone::all();

        $latestCybers = Cyber::latest()->get();
        $latesttrades = trade::latest()->get();
        $latestnews = news::latest()->get();


        $tourn = tournaments::all()->last();

        $header_slides = header_sliders::where('tourn_id',$tourn->id)->get();

        $adds = add_sliders::where('tourn_id',$tourn->id)->get();
        $partners = partner_sliders::where('tourn_id',$tourn->id)->get();

        if (Auth::check())
        {
            return view('tourn.tourn_rules',['latestCybers'=>$latestCybers
                ,'latesttrades'=>$latesttrades,'latestnews'=>$latestnews,'zones'=>$zones,
                'tourn'=>$tourn,'header_slides'=>$header_slides,'adds'=>$adds,'partners'=>$partners,
                'rules'=>$rules,'rules1'=>$rules1,'rules2'=>$rules2
            ]);

        }
        else
        {
            alert(__('strings.login_to_join'))->persistent('Ok');
            return redirect(url('front'));

        }

    }
}
