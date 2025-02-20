<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Тест создания нового продукта.
     *
     * @return void
     */
    public function test_create_product()
    {
        // Создаем товар
        $product = Product::factory()->create();

        // Проверяем, что продукт создан
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Тест просмотра списка продуктов.
     *
     * @return void
     */
    public function test_list_products()
    {
        // Создаем несколько продуктов
        Product::factory(5)->create();

        // Получаем список продуктов
        $response = $this->get('/products');

        // Проверяем, что ответ успешен
        $response->assertStatus(200);
    }

    /**
     * Тест удаления продукта.
     *
     * @return void
     */
    public function test_delete_product()
    {
        // Создаем товар
        $product = Product::factory()->create();

        // Удаляем продукт
        $response = $this->delete("/products/{$product->id}");

        // Проверяем, что продукт удален
        $response->assertRedirect('/products');

        // Проверяем, что продукт отсутствует в базе данных
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
