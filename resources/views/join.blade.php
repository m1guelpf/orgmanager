<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@lang('join.join') {{ $org->name }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
    <link href="{{ url('/css/join.css') }}" rel="stylesheet">
    <link href="{{ url('/css/flatty.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/toastr.min.css') }}" rel="stylesheet">
    @include('layouts.code')
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                  <img src="{{ $org->avatar }}" class="logo"><br>
                    @lang('join.join') <a href="https://github.com/{{ $org->name }}" target="_blank">{{ $org->pretty_name or $org->name }}</a>
                    @if (isset($org->team))
                    @if($org->team->privacy == 'closed')
                    <h6>You'll also join the <a href="{{ url('https://github.com/orgs/'.$org->name.'/teams/'.str_slug($org->team->name)) }}" target="_blank">{{ $org->team->name }}</a> team</h6>
                    @else
                    <h6>You'll also join the private "{{ $org->team->name }}" team</h6>
                    @endif
                    @endif
                    @if ($org->description)
                    <blockquote>{{ $org->description }}</blockquote>
                    @endif
                </div>
                <div class="join">
                  @lang('join.username') @if ($org->password != null && trim($org->password) != "")@lang('join.passwd') @endif @lang('join.tojoin') {{ $org->name }}:<br><br>
                    <form id="join" method="POST" href="{{ url('join/'.$org->id) }}">
                      {{ csrf_field() }}
                      <input type="text" name="github_username" class="textbox" placeholder="@lang('join.uplace')"><br><br>
                      @if ($org->password != null && trim($org->password) != "")
                      <input type="password" name="org_password" class="textbox" placeholder="@lang('join.pplace')"><br><br>
                      @endif
                      <center><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_PUBLIC_KEY') }}"></div></center><br><br>
                      <button type="submit" class="submit-button" name="submit">@lang('join.join')!</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ url('js/jquery.min.js') }}"></script>
        <script src="{{ url('js/toastr.min.js') }}"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        {!! Toastr::render() !!}
    </body>
</html>
