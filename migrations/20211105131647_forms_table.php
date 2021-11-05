<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Phinx\Migration\AbstractMigration;

final class FormsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table_name = FormsBuilderModels::forms()->getTable();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

        $table = $this->table($table_name);
        $table
            ->addColumn('id_topic', 'integer')
            ->addColumn('id_email', 'biginteger')
            ->addColumn('id_item', 'biginteger')
            ->addColumn('status', 'enum', ['values' => ['pending', 'skipped', 'sent']])
            ->addColumn('modified', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ]);

        $table->addIndex(['id_topic']);
        $table->addIndex(['id_email']);
        $table->addIndex(['id_item']);
        $table->addIndex(['status']);
        $table->addIndex(['modified']);
        $table->addIndex(['created']);

        $table->save();
    }
}
