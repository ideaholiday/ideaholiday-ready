<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use App\Models\Tenant;
class TenantMiddleware {
  public function handle(Request $request, Closure $next){
    $host = $request->header('X-Tenant-Domain') ?: env('TENANT_FALLBACK_DOMAIN');
    $tenant = Tenant::where('domain',$host)->first();
    if(!$tenant){ return response()->json(['error'=>'Tenant not found','host'=>$host],404); }
    app()->instance('tenant',$tenant);
    return $next($request);
  }
}
