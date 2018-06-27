<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }</style>

  <style>
    h1 { margin-bottom: 10px; }
    .title, .subtitle { display: inline-block;}
    .subtitle {
      float: right;
      margin-top: 30px;
    }
    .address {
      display: inline-block;
    }
    .address strong {
      display: block;
      margin-bottom: 5px;
    }
    .date {
      float: right;
    }
    .date strong {
      display: block;
      margin-bottom: 5px;
    }
    .table {
      width: 100%;
    }
    .table td, .table th {
      padding: .5rem 0;
      vertical-align: top;
    }
    .text-center { text-align: center; }
    .text-right { text-align: right; }

    .mb-5 {
      margin-bottom: 5px;
    }
  </style>

  @stack('styles')
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    @yield('main-content')

  </section>

</body>

</html>