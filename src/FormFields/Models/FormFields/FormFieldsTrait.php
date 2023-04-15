<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeTrait;
use ByTIC\FormBuilder\Utility\PackageConfig;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait as HasTypesTrait;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;

/**
 * Trait FormFieldsTrait.
 *
 * @method FormFieldTrait getNew($data = [])
 */
trait FormFieldsTrait
{
    use HasTypesTrait;
    use HasFormsRecordsTrait;
    use I18nRecordsTrait;

    /**
     * @var array|null
     */
    protected $typesMatrix = null;

    /**
     * @param string $role
     *
     * @return AbstractTypeTrait[]|null
     */
    public function getTypesByRole($role)
    {
        $this->checkInitTypesMatrix();

        return $this->typesMatrix[$role] ?? null;
    }

    protected function checkInitTypesMatrix()
    {
        if (null === $this->typesMatrix) {
            $this->generateTypesMatrix();
        }
    }

    protected function generateTypesMatrix()
    {
        $items = $this->getSmartPropertyDefinition('Type')->getItems();
        foreach ($items as $item) {
            $this->typesMatrix[$item->getRole()][$item->getName()] = $item;
        }
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return [];
    }

//    /**
//     * @param AbstractTypeTrait $object
//     */
//    public function addType($object)
//    {
//        /** @noinspection PhpParamsInspection */
//        $this->addTypeTrait($object);
//        $this->typesMatrix[$object->getRole()][$object->getName()] = $object;
//    }

    public function getRootNamespace(): string
    {
        return 'ByTIC\FormBuilder\Models\\';
    }

    /**
     * @return array
     */
    protected function getTypesMatrix()
    {
        $this->checkInitTypesMatrix();

        return $this->typesMatrix;
    }

    protected function generateTable(): string
    {
        return PackageConfig::tablesFields();
    }

    protected function generateController(): string
    {
        return FormsFields::TABLE;
    }
}
