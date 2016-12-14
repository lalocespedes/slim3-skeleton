<?php

use Phinx\Migration\AbstractMigration;

class CreateUserMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $data = [
            'username' => 'lalocespedes',
            'email' => 'lalocespedes@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'active' => 1
        ];

        $table = $this->table('users');
        $table->insert($data);
        $table->saveData();

    }
}
