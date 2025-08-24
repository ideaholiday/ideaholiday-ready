<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
  Schema::create('tenants', function (Blueprint $t){ $t->id(); $t->string('name'); $t->string('domain')->unique(); $t->string('status')->default('active'); $t->timestamps(); });
} public function down(): void { Schema::dropIfExists('tenants'); } };
