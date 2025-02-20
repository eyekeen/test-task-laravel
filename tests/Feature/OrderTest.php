<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * Тест создания нового заказа.
     *
     * @return void
     */
    public function test_create_order()
    {
        // Создаем товар
        $product = Product::factory()->create();

        // Создаем заказ
        $order = Order::factory()->create([
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Проверяем, что заказ создан
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'status' => 'Новый',
        ]);
    }

    /**
     * Тест просмотра списка заказов.
     *
     * @return void
     */
    public function test_list_orders()
    {
        // Создаем несколько заказов
        Order::factory(5)->create();

        // Получаем список заказов
        $response = $this->get('/orders');

        // Проверяем, что ответ успешен
        $response->assertStatus(200);

        // Проверяем, что список заказов содержит данные
        $response->assertSee('Список заказов');
    }

    /**
     * Тест обновления статуса заказа.
     *
     * @return void
     */
    public function test_update_order_status()
    {
        // Создаем товар
        $product = Product::factory()->create();

        // Создаем заказ
        $order = Order::factory()->create([
            'product_id' => $product->id,
            'quantity' => 1,
            'status' => 'Новый',
        ]);

        // Обновляем статус заказа на "completed"
        $response = $this->put("/orders/{$order->id}/complete");

        // Проверяем, что статус успешно обновлен
        $response->assertRedirect("/orders/{$order->id}/edit");

        // Проверяем, что статус заказа изменен в базе данных
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Выполнен',
        ]);
    }

    /**
     * Тест удаления заказа.
     *
     * @return void
     */
    public function test_delete_order()
    {
        // Создаем товар
        $product = Product::factory()->create();

        // Создаем заказ
        $order = Order::factory()->create([
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Удаляем заказ
        $response = $this->delete("/orders/{$order->id}");

        // Проверяем, что заказ удален
        $response->assertRedirect('/orders');

        // Проверяем, что заказ отсутствует в базе данных
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}