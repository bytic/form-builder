<?php

declare(strict_types=1);

use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class FormFieldsValuesUnique extends AbstractMigration
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

        $table = $this->table($table_name);
        $table->addIndex(['id_form', 'id_field', 'consumer', 'consumer_id'], ['unique' => true]);
        $table->save();
    }
}
