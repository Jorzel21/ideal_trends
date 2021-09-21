<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Ideal Trends</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="headers.css" rel="stylesheet">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


    <main>
      <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-1 mb-2 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4">Ideal Trends</span>
          </a>

          <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="{{ route('produto.index') }}" class="nav-link">Produtos</a></li>
            <li class="nav-item"><a href="{{ route('cliente.index') }}" class="nav-link">Clientes</a></li>
            <li class="nav-item"><a href="{{ route('pedido.index') }}" class="nav-link">Pedidos</a></li>
          </ul>
        </header>
      </div>

    </main>

    <main>
         <div class="col-10 container-fluid pb-2 d-flex flex-wrap justify-content py-3 mb-4">
            @yield('content')
         </div>        
    </main>


    

      
  </body>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>