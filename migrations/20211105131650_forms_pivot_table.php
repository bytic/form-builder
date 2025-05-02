<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

/**
 *
 */
final class FormsPivotTable extends AbstractMigration
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
        $table_name = PackageConfig::tablesForms().'_pivot';
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

        $table = $this->table($table_name);
        $table
            ->addColumn('id_form', 'integer', ['signed' => false])
            ->addColumn('pivotal_id', 'integer')
            ->addColumn('pivotal_type', 'string');

        $table
            ->addIndex(['id_form', 'pivotal_id', 'pivotal_type'], ['unique' => true])
            ->addIndex(['id_form'])
            ->addIndex(['pivotal_id'])
            ->addIndex(['pivotal_type']);

        $table->save();
    }
}
