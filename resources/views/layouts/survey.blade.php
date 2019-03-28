<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Yargıtay Anket </title>

  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/front.css">
  <link rel="stylesheet" type="text/css" href="/css/formstyle.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body >

<div id="app">
  <div class="container-fluid ">
    <div class="fixed-top"><img src="/images/logo.png" width="50px" height="50px" class="mx-auto d-block" alt=""></div>  
    <div class="row full-height">
        <div class="col-sm page-left-side">
          
          <div class="row h-100">
            
             <div class="col-sm-12 my-auto">

                <img src="/images/survey.png" width="50%" alt="" class="img-fluid">
                <h2>Yargıtay Başkanlığı<br>Ön Büro Memnuniyet Anketi</h2>
                <p>Tation argumentum et usu, dicit viderer evertitur te has.<br> Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel. <br>Adhuc invidunt duo ex. Eu tantas dolorum ullamcorper qui.</p>
             </div>
             
          </div>
          

        </div>
        <div class="col-sm page-right-side">
          <div class="row h-100">
              @yield('content')
        </div>
        </div>
    </div>
    <div class="fixed-bottom footer row"><span class="mx-auto d-block">© 2019 Yargıtay Başkanlığı | Web Tasarım</span></div>
      </div>

</div>
  

<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript" src="/js/app.js"></script>
@yield('scripts')
</body>
</html>