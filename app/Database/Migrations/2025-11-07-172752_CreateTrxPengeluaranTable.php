<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrxPengeluaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_trx' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pengeluaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'nama_pengeluaran' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => false,
            ],
            'tanggal_pengeluaran' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'harga_satuan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
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

        $this->forge->addKey('id_trx', true);
        $this->forge->addForeignKey('id_pengeluaran', 'pengeluaran', 'id_pengeluaran', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trx_pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('trx_pengeluaran');
    }
}
