<?php

namespace Feature;

use App\Models\Invoice;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    private string $path = '/api/v1/invoices';
    private string $table = 'invoices';

    protected mixed $token;

    public function setUp(): void
    {
        parent::setUp();

        $user = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->token = $response->json('token');
    }

    public function test_list_InvoiceTest(): void
    {
        Invoice::factory()->count(10)->create();
        $response = $this->getJson(
            uri:$this->path . '/',
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ]);

        $response->assertOk();
    }

    public function test_create_InvoiceTest(): void
    {
        $data = Invoice::factory()->make();

        $response = $this->postJson(
            uri: $this->path . '/',
            data: ['payload' => $data->toArray()],
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ]
        );

        $response->assertCreated();
        $this->assertDatabaseHas($this->table, $data->toArray());
    }

    public function test_show_InvoiceTest(): void
    {
        $data = Invoice::factory()->create();

        $this->get($this->path.'/'.$data->id)
            ->assertOk();
    }

    public function test_update_InvoiceTest(): void
    {
        $data = Invoice::factory()->create();
        $newData = Invoice::factory()->make();

        $this->putJson($this->path.'/'.$data->id, ['payload' => $newData->toArray()])
            ->assertOk();
    }

    public function test_delete_InvoiceTest(): void
    {
        $data = Invoice::factory()->create();
        $this->delete($this->path.'/'.$data->id)
            ->assertNoContent();

        $this->assertDatabaseCount($this->table, 0);
    }
}
