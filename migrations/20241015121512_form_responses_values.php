<?php

declare(strict_types=1);

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class FormResponsesValues extends AbstractMigration
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

        $table_name = PackageConfig::tablesValues();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

        $table = $this->table($table_name);
        $table
            ->addColumn('id_form', 'integer', ['signed' => false])
            ->addColumn('id_field', 'integer', ['signed' => false])
            ->addColumn('consumer', 'string')
            ->addColumn('consumer_id', 'integer')
            ->addColumn('value', 'text')
            ->addColumn('modified', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ]);

        $table->addIndex(['id_form']);
        $table->addIndex(['id_field']);
        $table->addIndex(['consumer', 'consumer_id']);

        $table->save();

        $table
            ->addForeignKey(
                'id_form',
                FormsBuilderModels::forms()->getFullNameTable(),
                'id',
                ['constraint' => 'forms_id_forms_values_id_form', 'delete' => 'RESTRICT', 'update' => 'NO_ACTION']
            )
            ->addForeignKey(
                'id_field',
                FormsBuilderModels::fields()->getFullNameTable(),
                'id',
                [
                    'constraint' => 'form_fields_id_forms_values_id_field',
                    'delete' => 'RESTRICT',
                    'update' => 'NO_ACTION',
                ]
            )
            ->save();
    }
}
