<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('TITLE')}} {{env('TITLE_SEPERATOR')}} @yield('page_name')</title>
    <!-- Bootstrap -->
    <link href="{{asset("$theme_path/assets/css/bootstrap.min.css")}}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- D3VSOFT -->
    <link href="{{asset("$theme_path/assets/css/d3vsoft.css")}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset("$theme_path/assets/css/cover.css")}}" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-dark">
