<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('PengeluaranSeeder');
        $this->call('TrxPengeluaranSeeder');
        $this->call('PromoSeeder');
        $this->call('ProdukSeeder');
        $this->call('BahanProdukSeeder');
    }
}
