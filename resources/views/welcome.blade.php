<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>

    <div class="landing-page">
      <div class="page-content">
        <h1>App Bimbel</h1>
        <p>
         Aplikasi Bimbel Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia illo facilis non mollitia eos fuga quas asperiores modi adipisci cupiditate odit rem reiciendis, natus aspernatur.

        </p>
        <!-- <a href="#">Saya Siswa</a>
        <a href="#">Saya Mentor</a> -->
        @if (Auth::guard('web')->check())
        <a href="{{ url('/dashboard') }}" >Dashboard</a>
        @elseif ( Auth::guard('siswa')->check())
        <a href="{{ url('/dashboardsiswa') }}" >Dashboard</a>
        @else
        <a href="{{ url('mentor/login') }}" >Saya Mentor</a>
        <a href="{{ url('siswa/login') }}" >Saya Siswa</a>
        @endif
      </div>
    </div>

 

  </body>
</html>
