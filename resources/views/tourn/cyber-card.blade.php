@foreach($tourn_cybers as $tourn_cyber)
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="cyber-item">
            <div class="media">
                <div class="media-left">
                    <a href="{{url('cyber/'.$tourn_cyber->id)}}">
                        <img class="media-object img-responsive" src="{{url('uploads/'.$tourn_cyber->cyberImg[0]->img_url)}}">
                    </a>
                </div>
                <div class="media-body">
                    @if($tourn_cyber->tourn_cyber_status() == 0)
                        <h5>
                            {{$tourn_cyber->name}}
                        </h5>
                        <p class="rate">
                            @for($i=0;$i<$tourn_cyber->tourn_rate();$i++)
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            @endfor
                            @for($i;$i<5;$i++)
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            @endfor
                            <span>({{$tourn_cyber->count_tourn_rates()}})</span>
                        </p>

                        <p class="add">
                            {{$tourn_cyber->address}}
                            <br>
                            {{$tourn_cyber->phone}}
                        </p>
                    @elseif($tourn_cyber->tourn_cyber_status() == 1)
                        <h5 class="cyber-gray">
                            {{$tourn_cyber->name}}
                        </h5>
                        <p class="block-text">
                            {{ __('strings.out_cyber')}}
                        </p>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endforeach