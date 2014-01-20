<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Confirmation Link</h2>
 
        <div>
            {{ $detail }}
        </div>
        <div><a href="{{URL::to('register/verify')}}/{{$activation_code}}">{{ $activation_code }}</a></div>
        <div>{{ $name}} </div>
    </body>
</html>