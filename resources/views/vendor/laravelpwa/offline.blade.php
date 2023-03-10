@extends('layouts.guest')    


@section('content')
<style>
    html,body { margin:0; padding:0; }
    html {
      background: #191919 -webkit-linear-gradient(top, #000 0%, #191919 100%) no-repeat;
      background: #191919 linear-gradient(to bottom, #000 0%, #191919 100%) no-repeat;
    }
    body {
      font-family: sans-serif;
      color: #FFF;
      text-align: center;
      font-size: 150%;
    }
    h1, h2 { font-weight: normal; }
    h1 { margin: 0 auto; padding: 0.15em; font-size: 10em; text-shadow: 0 2px 2px #000; }
    h2 { margin-bottom: 2em; }
  </style>

<h1>⚠</h1>
<h2>No connection to the internet</h2>
<p>This Display has a connection to your network but no connection to the internet.</p>
<p class="desc">The connection to the outside world is needed for updates and keeping the time.</p>

@endsection