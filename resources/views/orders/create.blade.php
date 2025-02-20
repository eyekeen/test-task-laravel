@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавление заказа</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">ФИО покупателя</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Товар</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Выберите товар</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ number_format($product->price, 2, '.', ' ') }} ₽)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Добавить заказ</button>
    </form>
</div>
@endsection