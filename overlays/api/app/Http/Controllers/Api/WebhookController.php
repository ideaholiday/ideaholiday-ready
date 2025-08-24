<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; use Illuminate\Http\Request;
class WebhookController extends Controller {
  public function razorpay(Request $req){ return response()->json(['ok'=>true]); }
  public function easebuzz(Request $req){ return response()->json(['ok'=>true]); }
}
