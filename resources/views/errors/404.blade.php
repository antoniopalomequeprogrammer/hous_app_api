@extends('layout.app')

@section('title', 'Validación de usuario')

@section('style')
    <style media="screen">
        body {
            background-color: #00528a;
        }
        #main {
            height: 100vh;
            color: #fff;
            font-weight: 'bold';
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" id="main">
        <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
        <div class="inline-block align-middle">
        	<h2 class="font-weight-normal lead" id="desc">The page you requested was not found.</h2>
        </div>
    </div>
@endsection
