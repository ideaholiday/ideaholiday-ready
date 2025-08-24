<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class SupplierCredential extends Model { protected $fillable=['tenant_id','supplier_id','creds']; protected $casts=['creds'=>'array']; }
