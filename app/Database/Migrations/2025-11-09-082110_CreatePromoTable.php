<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_promo' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_promo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tipe' => [
                'type'       => 'ENUM',
                'constraint' => ['persen', 'nominal'],
                'default'    => 'persen',
                'comment'    => 'Tipe promo: persen atau nominal',
            ],
            'nilai' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
                'comment'    => 'Nilai promo (bisa % atau nominal)',
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default'    => 'aktif',
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

        $this->forge->addKey('id_promo', true);
        $this->forge->createTable('promo');
    }

    public function down()
    {
        $this->forge->dropTable('promo');
    }
}
