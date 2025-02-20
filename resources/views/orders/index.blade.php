@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список заказов</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Дата создания</th>
                <th>ФИО покупателя</th>
                <th>Статус</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $order->full_name }}</td>
                    <td>
                        @if ($order->status === 'Выполнен')
                            <span class="text-success fw-bold">Выполнен</span>
                        @else
                            <span class="text-primary">Новый</span>
                        @endif
                    </td>
                    <td>{{ number_format($order->total_price ?? 0, 2, '.', ' ') }} ₽</td>
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