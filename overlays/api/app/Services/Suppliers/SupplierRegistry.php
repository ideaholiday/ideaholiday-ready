<?php
namespace App\Services\Suppliers; use App\Models\Tenant;
class SupplierRegistry {
  protected array $suppliers;
  public function __construct(){ $this->suppliers = [ new TBOAdapter() ]; }
  public function searchAll(Tenant $tenant, array $q): array {
    $out=[]; foreach($this->suppliers as $s){ $out=array_merge($out,$s->search($q)); }
    return $out;
  }
}
