<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class FormsMetadata extends AbstractMigration
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
        $table_forms = PackageConfig::tablesForms();

        $this->table($table_forms)
            ->addColumn('metadata', 'json', ['null' => true, 'after' => 'name'])
            ->save();
    }
}
