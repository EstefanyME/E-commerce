@extends('layouts.app')

@section('content')
<div class="container-fluid">
     <!-- Header-->
     <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Tienda Curso Laravel</h1>
                <p class="lead fw-normal text-white-50 mb-0">La mejor tienda en Tecnología</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <wproducts></wproducts>
    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Derechos Reservados &copy; Curso Laravel 2022</p></div>
    </footer>    
</div>
@endsection