@extends('admin.layouts.app')

@section('title', 'Criar Categoria')

@section('content')
    @include('admin.categories.partials.breadcrumb')

    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Criar Nova Categoria
        </h2>
    </div>

    <form action="{{ route('categories.store') }}" method="POST">
        @include('admin.categories.partials.form')
    </form>
@endsection
