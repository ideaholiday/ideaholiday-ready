<?php
namespace App\Services\Suppliers;
class TBOAdapter implements FlightSupplier {
  public function code(): string { return 'TBO'; }
  public function search(array $q): array {
    return [[
      'id' => 'tbo-'.md5(json_encode($q)), 'supplier'=>'TBO','carrier'=>'AI','flight'=>'AI 505',
      'from'=>strtoupper($q['from']),'to'=>strtoupper($q['to']),
      'dep'=>$q['depDate'].'T08:10:00','arr'=>$q['depDate'].'T10:05:00','stops'=>0,
      'total'=>12499.00,'currency'=>'INR','baggage'=>'15kg','refundable'=>true
    ]];
  }
}
