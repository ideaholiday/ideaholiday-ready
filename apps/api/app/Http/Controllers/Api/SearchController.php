<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; use Illuminate\Http\Request;
use App\Services\Suppliers\SupplierRegistry;
class SearchController extends Controller {
  public function search(Request $req){
    $validated = $req->validate([
      'from'=>'required|string|size:3','to'=>'required|string|size:3','depDate'=>'required|date',
      'adults'=>'required|integer|min:1','children'=>'nullable|integer|min:0','infants'=>'nullable|integer|min:0','cabin'=>'nullable|string'
    ]);
    $tenant = app('tenant');
    $offers = app(SupplierRegistry::class)->searchAll($tenant, $validated);
    return response()->json(['results'=>$offers,'count'=>count($offers)]);
  }
  public function price(string $id){ return response()->json(['offerId'=>$id,'pricedTotal'=>15499.00,'currency'=>'INR']); }
}
