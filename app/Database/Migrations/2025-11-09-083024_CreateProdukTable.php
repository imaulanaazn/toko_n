<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'hpp' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'margin' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
                'comment'    => 'Selisih harga jual - HPP',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_promo' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'default'    => null,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'produksi_harian' => [
                'type'           => 'INT',
                'constraint'     => 11,
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

        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_promo', 'promo', 'id_promo', 'SET NULL', 'CASCADE');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
