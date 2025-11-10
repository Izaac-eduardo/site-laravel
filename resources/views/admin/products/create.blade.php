@extends('admin.layouts.app')

@section('title', 'Criar novo Produto ')

@section('content')
  
    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Novo Produto
        </h2>
    </div>
    {{-- @include('admin.includes.errors') --}}
    <form action="{{ route('products.store') }}" method="POST">
        @include('admin.products.partials.form')
    </form>
@endsection
