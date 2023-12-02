<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    private string $path = 'api/v1/invoices';
    private string $table = 'invoices';
    private string $token;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $response = $this->postJson('api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->token = $response->collect('data')->get('token');
    }

    public function test_all_invoice_endpoint(): void
    {
        Invoice::factory(3)->create();
        $response = $this->getJson(
            uri: $this->path,
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token
            ]
        );

        $response->assertStatus(200);
    }

    public function test_create_invoice_endpoint(): void
    {
        $invoice = Invoice::factory()->make();

        $response = $this->postJson(
            uri: $this->path,
            data: ['payload' => $invoice->toArray()],
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token
            ]
        );

        $response->assertStatus(201);

        $this->assertDatabaseHas($this->table, $invoice->toArray());
    }

    public function test_show_invoice_endpoint(): void
    {
        $invoice = Invoice::factory()->createOne();

        $response = $this->getJson(
            uri: $this->path.'/'.$invoice->id,
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token
            ]
        );

        $response->assertStatus(200);
    }

    public function test_update_invoice_endpoint(): void
    {
        $invoice = Invoice::factory()->createOne();
        $newInvoice = Invoice::factory()->make();

        $response = $this->putJson(
            uri: $this->path.'/'.$invoice->id,
            data: ['payload' => $newInvoice->toArray()],
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token
            ]
        );

        $response->assertStatus(202);
    }

    public function test_delete_invoice_endpoint(): void
    {
        $invoice = Invoice::factory()->createOne();

        $response = $this->deleteJson(
            uri: $this->path.'/'.$invoice->id,
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token
            ]
        );

        $response->assertStatus(204);
    }
}
