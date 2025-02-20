@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Информация о товаре</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p><strong>Категория:</strong> {{ $product->category?->name ?? 'Без категории' }}</p>
            <p><strong>Цена:</strong> {{ number_format($product->price, 2, '.', ' ') }} ₽</p>
            <p><strong>Описание:</strong></p>
            <p>{{ $product->description }}</p>

            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Редактировать</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </div>
</div>
@endsection