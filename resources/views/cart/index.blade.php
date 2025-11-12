@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrinho de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>
                            @if($item['image'])
                                <img src="{{ $item['image'] }}" width="50" alt="{{ $item['name'] }}">
                            @endif
                            {{ $item['name'] }}
                        </td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                    <td>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Limpar Carrinho</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Seu carrinho está vazio.</p>
    @endif
</div>
@endsection
