<html>
<body style="text-align: center;background: #f0f2f5;padding:50px 30px;">
<div>
    <img src="http://thegame.com.co/staging/thegame/public/img/mail-banner.png" class="img-responsive" style=" max-width: 100%;margin: auto;">
</div>
<p class="hi-text" style="color: #1b2e3b;font-size: 20px;font-weight: bold">
    Hi {{$user_name}},
</p>
<h2 class="welcome" style="color: #1b2e3b;
    font-weight: bold;font-size: 30px">
    Welcome to The GAME.
</h2>
<p class="info" style="color: #777777;font-size: 18px;line-height: 1.6">
    Thank you for your registration on The GAME website. Please press the below link to verify your email and activate your account.
</p>

<a href="{{route('confirmation',$email_token)}}" style="color: white;text-decoration: none;background: #2679a4;padding: 10px 60px">
    {{'Activate Your Account'}}</a>


<p class="info" style="color: #777777;font-size: 22px;line-height: 1.6;">
    We hope you are ready for The GAME.
</p>
<p style="color: #777777;">
    Enjoy,<br>
    The GAME Team
</p>

<p style="text-align: center">
    <a href="https://www.facebook.com/gameofficialpage/ " target="_blank" style="text-decoration: none">
        <img src="http://thegame.com.co/staging/thegame/public/img/facebook.png" style="width: 30px;height: 30px;margin: 10px;">
    </a>

    <a href="https://www.instagram.com/gameofficialpage/ " target="_blank" style="text-decoration: none">
        <img src="http://thegame.com.co/staging/thegame/public/img/instgram.png" style="width: 30px;height: 30px;margin: 10px;">
    </a>

    <a href="https://www.youtube.com/channel/UCjcHPe1PzdoRxnl35KxM-VQ" target="_blank" style="text-decoration: none">
        <img src="http://thegame.com.co/staging/thegame/public/img/youtube.png" style="width: 30px;height: 30px;margin: 10px;">
    </a>
</p>
</body>
</html>
