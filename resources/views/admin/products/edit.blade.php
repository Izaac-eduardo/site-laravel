@extends('admin.layouts.app')

@section('title', 'Editar o Produto')

@section('content')
   
    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Editar o Produto{{ $product->name }}
        </h2>
    </div>
   <form action="{{ route('products.update', $product->id) }}" method="POST">
       @method('PUT')
        @include('admin.products.partials.form')
    </form>
@endsection
