@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование заказа</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('orders.update', $order) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">ФИО покупателя</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $order->full_name }}" required>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Товар</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Выберите товар</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name }} ({{ number_format($product->price, 2, '.', ' ') }} ₽)
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="{{ $order->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий</label>
            <textarea name="comment" id="comment" class="form-control">{{ $order->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Обновить заказ</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
    </form>

    <!-- Статус заказа -->
    <div class="mb-3">
        <label class="form-label">Статус заказа</label>
        @if ($order->status === 'Выполнен')
        <!-- Если заказ выполнен, показываем только текст -->
        <p class="form-control-plaintext text-success fw-bold">Выполнен</p>
        @else
        <!-- Если заказ новый, показываем кнопку для изменения статуса -->
        <form action="{{ route('orders.complete', $order) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-primary">Пометить как выполнен</button>
        </form>
        @endif
    </div>
</div>
@endsection