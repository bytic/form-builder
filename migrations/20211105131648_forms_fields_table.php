<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

/**
 *
 */
final class FormsFieldsTable extends AbstractMigration
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
        $table_name = PackageConfig::tablesFields();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

        $table = $this->table($table_name);
        $table
            ->addColumn('id_form', 'integer')
            ->addColumn('type', 'string')
            ->addColumn('role', 'string')
            ->addColumn('label', 'string', ['length' => 500])
            ->addColumn('label_intern', 'string')
            ->addColumn('help', 'text')
            ->addColumn('options', 'text')
            ->addColumn('visible', 'enum', ['values' => ['yes', 'no', 'hidden'], 'default' => 'yes'])
            ->addColumn('listing', 'set', ['values' => ['public', 'admin']])
            ->addColumn('filter', 'set', ['values' => ['public', 'admin']])
            ->addColumn('mandatory', 'enum', ['values' => ['yes', 'no'], 'default' => 'no'])
            ->addColumn('pos', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addColumn('modified', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ]);

        $table->addIndex(['id_form']);
        $table->addIndex(['type']);

        $table->save();

        $table->addForeignKey(
            'id_form',
            FormsBuilderModels::forms()->getFullNameTable(),
            'id',
            ['constraint' => 'forms_id_forms_values_id_form', 'delete' => 'RESTRICT', 'update' => 'NO_ACTION']
        )
            ->save();
    }
}
