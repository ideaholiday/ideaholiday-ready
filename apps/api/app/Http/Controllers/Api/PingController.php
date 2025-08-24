<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
class PingController extends Controller {
  public function ping(){
    $t = app('tenant');
    return response()->json(['ok'=>true,'tenant'=>$t? $t->only(['id','name','domain']):null, 'version'=>'1.0.0']);
  }
}
