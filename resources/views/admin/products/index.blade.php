@extends('admin.layouts.app')

@section('title', 'Listagem de Produtos')

@section('content')
  

    <div class="py-1 mb-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Produtos
        </h2>

        <a href="{{ route('products.create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> Cadastrar
        </a>
    </div>

    <x-alert />

    <div class="bg-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  
                    <th scope="col" class="px-6 py-4">Nome</th>
                    <th scope="col" class="px-6 py-4">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($products as $product)
                    <tr class="bg-gray-900 border-b dark:bg-gray-800 dark:border-gray-700">
                      
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Excluir este produto?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Nenhum produto cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    
@endsection
