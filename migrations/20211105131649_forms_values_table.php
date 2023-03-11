<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

/**
 *
 */
final class FormsValuesTable extends AbstractMigration
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

    }
}
