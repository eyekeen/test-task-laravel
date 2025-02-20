<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('product')->paginate(10);

        // Добавляем итоговую стоимость для каждого заказа
        $orders->each(function ($order) {
            $order->total_price = $order->product ? $order->product->price * $order->quantity : 0;
        });

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::all(); // Получаем все товары для выбора
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $order = new Order();
        $order->full_name = $validated['full_name'];
        $order->product_id = $validated['product_id'];
        $order->quantity = $validated['quantity'];
        $order->comment = $validated['comment'] ?? null;
        $order->status = 'Новый';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $products = Product::all(); // Получаем все товары для выбора
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
            'status' => 'nullable|string|in:new,completed'
        ]);


        // Если чекбокс не установлен, устанавливаем статус "new"
        if (!$request->has('status')) {
            $validated['status'] = 'Новый';
        } else {
            $validated['status'] = 'Выполнен';
        }

        $order->full_name = $validated['full_name'];
        $order->product_id = $validated['product_id'];
        $order->quantity = $validated['quantity'];
        $order->comment = $validated['comment'] ?? null;
        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно обновлен.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно удален.');
    }


    public function complete(Order $order)
    {
        if ($order->status == 'Новый') {
            $order->status = 'Выполнен';
            $order->save();

            return redirect()->route('orders.edit', $order)->with('success', 'Заказ успешно помечен как выполнен.');
        }

        return redirect()->route('orders.edit', $order)->with('info', 'Заказ уже выполнен.');
    }
}
