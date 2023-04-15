<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use Nip\Collections\Registry;
use Nip\Records\Record;

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
