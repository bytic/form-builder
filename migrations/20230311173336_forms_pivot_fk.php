<?php
declare(strict_types=1);

use ByTIC\FormBuilder\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class FormsPivotFk extends AbstractMigration
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
    public function change()
    {
        $table_forms = PackageConfig::tablesForms();
        $table_pivot = PackageConfig::tablesForms().'_pivot';

        $this->table($table_pivot)
            ->addForeignKey(
                'id_form',
                $table_forms,
                'id',
                [
                    'constraint' => $table_pivot . '_id_form_' . $table_forms,
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->save();
    }
}
