<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="input-field col s12">
        <input class="validate" type="" name="" id="" placeholder="" value="">
        <label for="" class="active"></label>
        @if(Session::has('errors'))
            <span class="helper-text" data-error="{{ $errors->first('') }}"></span>
        @endif
    </div>
</div>


</body>
</html>