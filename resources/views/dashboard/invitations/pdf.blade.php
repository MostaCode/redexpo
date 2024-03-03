<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitation</title>
</head>
<body>
    <div id="overlay"></div>
    <img style="height: 100px" src="{{asset('images/logo.png')}}" alt="">
    <h2>You are invited to attend</h2>
    <h1>{{$event->title}}</h1>


    <img src="data:image/png;base64, {{$qrcode}}" alt="">


    <p>#{{$invitation->invitation_number}}</p>

    <h2>{{$invitation->user->name}}</h2>

    <p>Start Date: {{$event->start_date}}  <span style="color:red"> | </span>  End Date: {{$event->end_date}}</p>

    <h1>{{$event->location}}</h1>

    <img style="width: 100%;position:fixed;bottom:0" src="{{asset('images/invite-footer.jpg')}}" alt="">

</body>

<style>
    @page {
    margin: 0 !important;
    padding: 0 !important;
}
    /* *{margin:0;padding:0}  */
    body {
    background: url({{asset('images/pattern.jpg')}});
    width:100%;
    height:100%;
    padding-top:30px;
    display: block;
    text-align: center;
    }
</style>
</html>
