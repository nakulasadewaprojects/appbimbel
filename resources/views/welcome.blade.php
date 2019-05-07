<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>App Bimbel</title>
  {{-- <link rel="stylesheet" href="css/style.css"> --}}
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="assets/demo/demo6/media/img/logo/favicon.ico" />

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

  <div class="landing-page">
    <div class="page-content">
      <h1>App Bimbel</h1>
        <h2>AKAN SEGERA LIRIS PADA</h2>
        <h2 id="demo"></h2>
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

<script>
// Set the date we're counting down to
var countDownDate = new Date("May 29, 2019 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
  + minutes + " Menit " + seconds + " Detik ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "PULANG";
  }
}, 1000);
</script>
</body>

</html>