@extends('admin.layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    @include('admin.categories.partials.breadcrumb')

    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Editar Categoria: {{ $category->name }}
        </h2>
    </div>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @method('PUT')
        @include('admin.categories.partials.form')
    </form>
@endsection
