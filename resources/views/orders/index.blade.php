@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список заказов</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Добавить заказ</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ФИО покупателя</th>
                <th>Товар</th>
                <th>Количество</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->full_name }}</td>
                    <td>{{ $order->product?->name ?? 'Товар удален' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection