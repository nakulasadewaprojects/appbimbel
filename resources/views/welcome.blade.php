<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>App Bimbel</title>
  <link rel="stylesheet" href="style.css">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="assets/demo/demo6/media/img/logo/favicon.ico" />

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

  <div class="landing-page">
    <div class="page-content">
      <h1>App Bimbel</h1>
      <p>
        Aplikasi Bimbel Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia illo facilis non mollitia eos fuga quas
        asperiores modi adipisci cupiditate odit rem reiciendis, natus aspernatur.

      </p>
      @if (Auth::guard('web')->check())
      <a href="{{ url('/dashboard') }}">Dashboard</a> @elseif ( Auth::guard('siswa')->check())
      <a href="{{ url('/dashboardsiswa') }}">Dashboard</a> @else
      <a href="{{ url('mentor/login') }}">Mentor</a>
      <a href="{{ url('siswa/login') }}">Siswa</a> @endif
      <br><br><br>
      <audio controls>
        <source src="https://server8.mp3quran.net/afs_dori/014.mp3" type="audio/mpeg">
        </audio>
        <p>Jangan lupa ngaji ya :)</p>
    </div>
  </div>


</body>

</html>