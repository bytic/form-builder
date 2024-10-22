<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use ByTIC\FormBuilder\Base\Models\Record;
use Nip\Collections\Registry;

/**
 * Class Field.
 */
class FormsField extends Record
{
    use FormFieldTrait;

    /**
     * @var Registry
     */
    protected $registry = null;

    /**
     * @return Registry
     */
    public function getRegistry()
    {
        if ($this->registry === null) {
            $this->registry = new Registry();
        }

        return $this->registry;
    }

}
