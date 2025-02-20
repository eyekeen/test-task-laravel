@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Информация о заказе</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ФИО покупателя:</strong> {{ $order->full_name }}</p>
            <p><strong>Товар:</strong> {{ $order->product?->name ?? 'Товар удален' }}</p>
            <p><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p><strong>Цена за единицу:</strong> {{ number_format($order->product?->price ?? 0, 2, '.', ' ') }} ₽</p>
            <p><strong>Общая стоимость:</strong> {{ number_format(($order->product?->price ?? 0) * $order->quantity, 2, '.', ' ') }} ₽</p>
            <p><strong>Статус:</strong> {{ $order->status }}</p>
            <p><strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Комментарий:</strong></p>
            <p>{{ $order->comment }}</p>

            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Редактировать</a>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </div>
</div>
@endsection