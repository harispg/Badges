
<!doctype html class="h-100">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Album example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!-- Stylesheet -->

    <link href="/css/tagsinput.css" rel="stylesheet" type="text/css">

<!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" 
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" 
            crossorigin="anonymous">
    </script>
    
    <script src="/js/tagsinput.js"></script>

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <!-- Font awesome free icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
  </head>

  <body class="d-flex flex-column h-100">

    @include('partials.header')

      <main class="flex-shrink-0" role="main" >
        <div class="container-fluid pt-5">

            @yield('jumbotron')

            @yield('content')

        </div>
      </main>

    @include('partials.footer')

    

    @include('flash')
    @yield('script')

  </body>
</html>
