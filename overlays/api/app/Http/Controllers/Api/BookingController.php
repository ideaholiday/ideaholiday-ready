<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; use Illuminate\Http\Request;
class BookingController extends Controller {
  public function book(Request $req){
    $validated = $req->validate(['offerId'=>'required|string','passengers'=>'required|array|min:1']);
    return response()->json(['bookingId'=>'IH'.rand(100000,999999),'status'=>'HOLD']);
  }
  public function show(string $id){ return response()->json(['bookingId'=>$id,'status'=>'HOLD','pnr'=>null]); }
}
