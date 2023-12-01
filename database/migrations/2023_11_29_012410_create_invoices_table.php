<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->nullable()->constrained();
            $table->string('number', 9);
            $table->decimal('amount', 10, 2);
            $table->dateTime('date_emissary')->nullable();
            $table->string('cnpj_retirement', 14);
            $table->string('name_retirement', 100);
            $table->string('cnpj_transporter', 14);
            $table->string('name_transporter', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
