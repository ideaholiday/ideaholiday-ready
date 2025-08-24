<?php
namespace App\Services\Suppliers;
interface FlightSupplier { public function code(): string; public function search(array $query): array; }
