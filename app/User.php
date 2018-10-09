<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use Laravel\Scout\Searchable;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Searchable;

    protected $fillable = ['name', 'email', 'password', 'remember_token', 'img_url', 'phone', 'forget_token'];



    public function searchableAs()
    {
        return 'name';
    }


    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }


    public function depart_article_comment()
    {
        return $this->hasmany(depart_articel_comments::class);
    }

    public function depart_series()
    {
        return $this->hasmany(depart_serieses::class);
    }

    public function depart_serie_comments()
    {
        return $this->hasmany(depart_serie_comments::class);
    }

    public function depart_book_comment()
    {
        return $this->hasmany(depart_book_comments::class);
    }

    public function news_comment()
    {
        return $this->hasmany(new_comments::class);
    }

    public function blog_article_comment()
    {
        return $this->hasmany(blog_article_comments::class);
    }


    public function interests()
    {
        return $this->hasmany(interests::class);
    }













    public function avg_rate()
    {
        $tradeRates = 0;
        $totalRates = 0;
        foreach ($this->trade as $trd) {
            if($trd->tradeRate->count() > 0){

                foreach ($trd->tradeRate as $rate) {
                    $tradeRates += $rate->rate;
                    $totalRates++;
                }
            }
        }

        if ($totalRates == 0)
        {
            return 0;
        }
        else
        {
            return  $tradeRates/$totalRates;
        }

    }



    public function number_of_trading_rates()
    {
        $totalRates = 0;
        foreach ($this->trade as $trd) {
            $totalRates += $trd->tradeRate->count();
        }

        return  $totalRates;
    }

    public function updateScore($matchState,$tournamentId,$goalIn,$goalOut){
        $tournamentScore = scores::where('tourn_id',$tournamentId)
            ->where('user_id',$this->id)->get()->last();
        if($tournamentScore){
            if($tournamentScore->num_of_matches < 40){
                // keda ma3nah en da msh awl match we en 3ando score abl keda we 3add matchato ma3dash 40
                if($matchState == 0){
                    // 0 5sran
                    $tournamentScore->lose += 1;
                }
                else if ($matchState == 1){
                    // 1 et3adel
                    $tournamentScore->draw += 1;

                }
                else if ($matchState == 2){
                    //2 ksban
                    $tournamentScore->win += 1;

                }
                $tournamentScore->num_of_matches += 1;
                $tournamentScore->num_of_inner_goals += $goalIn;
                $tournamentScore->num_of_outer_goals += $goalOut;
                $tournamentScore->g_d = $tournamentScore->num_of_inner_goals - $tournamentScore->num_of_outer_goals;
                $tournamentScore->points = (5*$tournamentScore->win)+(2*$tournamentScore->draw)+(1*$tournamentScore->lose);
                $tournamentScore->save();
            }
            else{
                // keda 3ada el 40 match fmsh hn3ml 7aga b2a
                return;
            }

        }
        else{
            // hancreate score gded leh
            $newScore = new scores;
            $newScore->tourn_id = $tournamentId;
            $newScore->user_id = $this->id;
            $newScore->num_of_matches = 1;
            if($matchState == 0){
                // 0 5sran
                $newScore->lose = 1;

            }
            else if ($matchState == 1){
                // 1 et3adel
                $newScore->draw = 1;

            }
            else if ($matchState == 2){
                //2 ksban
                $newScore->win = 1;

            }
            $tournamentScore->num_of_matches += 1;
            $newScore->num_of_inner_goals = $goalIn;
            $newScore->num_of_outer_goals = $goalOut;
            $newScore->g_d = $goalIn - $goalOut;
            $newScore->points = (5*$newScore->win)+(2*$newScore->draw)+(1*$newScore->lose);
            $newScore->save();

        }
    }


    public function updateEditscore($matchState,$tournamentId,$goalIn,$goalOut,$oldscore){
        $tournamentScore = scores::where('tourn_id',$tournamentId)
            ->where('user_id',$this->id)->get()->last();
        if($tournamentScore){
            if($tournamentScore->num_of_matches < 40){
                // keda ma3nah en da msh awl match we en 3ando score abl keda we 3add matchato ma3dash 40
                if ($oldscore == 2)
                {
                    $tournamentScore->win -= 1;
                    if($matchState == 0){
                        // 0 5sran
                        $tournamentScore->lose += 1;
                    }
                    else if ($matchState == 1){
                        // 1 et3adel
                        $tournamentScore->draw += 1;

                    }
                    else if ($matchState == 2){
                        //2 ksban
                        $tournamentScore->win += 1;

                    }
                }

                elseif ($oldscore == 1)
                {
                    $tournamentScore->draw -= 1;
                    if($matchState == 0){
                        // 0 5sran
                        $tournamentScore->lose += 1;
                    }
                    else if ($matchState == 1){
                        // 1 et3adel
                        $tournamentScore->draw += 1;

                    }
                    else if ($matchState == 2){
                        //2 ksban
                        $tournamentScore->win += 1;

                    }
                }

                elseif($oldscore == 0)
                {
                    $tournamentScore->lose -= 1;
                    if($matchState == 0){
                        // 0 5sran
                        $tournamentScore->lose += 1;
                    }
                    else if ($matchState == 1){
                        // 1 et3adel
                        $tournamentScore->draw += 1;

                    }
                    else if ($matchState == 2){
                        //2 ksban
                        $tournamentScore->win += 1;

                    }
                }

                $tournamentScore->num_of_inner_goals += $goalIn;
                $tournamentScore->num_of_outer_goals += $goalOut;
                $tournamentScore->g_d = $tournamentScore->num_of_inner_goals - $tournamentScore->num_of_outer_goals;
                $tournamentScore->points = (5*$tournamentScore->win)+(2*$tournamentScore->draw)+(1*$tournamentScore->lose);
                $tournamentScore->save();
            }
            else{
                // keda 3ada el 40 match fmsh hn3ml 7aga b2a
                return;
            }

        }
        else{
            // hancreate score gded leh
            $newScore = new scores;
            $newScore->tourn_id = $tournamentId;
            $newScore->user_id = $this->id;
            $newScore->num_of_matches = 1;
            if($matchState == 0){
                // 0 5sran
                $newScore->lose = 1;

            }
            else if ($matchState == 1){
                // 1 et3adel
                $newScore->draw = 1;

            }
            else if ($matchState == 2){
                //2 ksban
                $newScore->win = 1;

            }
            $newScore->num_of_inner_goals = $goalIn;
            $newScore->num_of_outer_goals = $goalOut;
            $newScore->g_d = $goalIn - $goalOut;
            $newScore->points = (5*$newScore->win)+(2*$newScore->draw)+(1*$newScore->lose);
            $newScore->save();

        }
    }
}
