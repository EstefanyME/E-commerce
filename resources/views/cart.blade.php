@extends('layouts.app')

@section('content')
<div class="container-fluid">
     <!-- Header-->
     <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Mi carrito de Compras</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <div class="container">
        <table class="table mb-5 mt-2">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Producto</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-end" colspan="3"><b>Total:</b></td>
                    <td>{{ $total }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Derechos Reservados &copy; Curso Laravel 2022</p></div>
    </footer>    
</div>
@endsection