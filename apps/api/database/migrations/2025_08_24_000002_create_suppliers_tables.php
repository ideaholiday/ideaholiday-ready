<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
  Schema::create('suppliers', function (Blueprint $t){ $t->id(); $t->string('code')->unique(); $t->string('name'); $t->timestamps(); });
  Schema::create('supplier_credentials', function (Blueprint $t){ $t->id(); $t->foreignId('tenant_id'); $t->foreignId('supplier_id'); $t->json('creds')->nullable(); $t->timestamps(); $t->unique(['tenant_id','supplier_id']); });
} public function down(): void { Schema::dropIfExists('supplier_credentials'); Schema::dropIfExists('suppliers'); } };
