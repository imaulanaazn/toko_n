<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengeluaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengeluaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pengeluaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['bahan_utama', 'bahan_penolong', 'operasional', 'gaji'],
                'default'    => 'bahan_utama',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'comment'    => 'Contoh: kg, liter, pcs',
            ],
            'harga_satuan' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_pengeluaran', true);
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}
