<?php
namespace Database\Seeders; use Illuminate\Database\Seeder; use App\Models\Tenant; use App\Models\Supplier;
class DatabaseSeeder extends Seeder {
  public function run(): void {
    Tenant::firstOrCreate(['domain'=>'ideaholiday.local'],['name'=>'Idea Holiday','status'=>'active']);
    Supplier::firstOrCreate(['code'=>'TBO'],['name'=>'TBO Holidays']);
  }
}
