<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Phinx\Migration\AbstractMigration;

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
        $table_name = FormsBuilderModels::fields()->getTable();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }

    }
}
