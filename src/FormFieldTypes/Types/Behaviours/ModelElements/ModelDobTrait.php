<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\ModelElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use Nip_Helper_Date;

/**
 * Trait ModelDobTrait.
 */
trait ModelDobTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('dateselect');
    }

    /**
     * @param $model
     *
     * @return string
     */
    public function printItemValue($model)
    {
        $value = parent::printItemValue($model);

        if ($value) {
            $value = _strftime(
                $value,
                app('locale')->getOption(['time', 'dateStringFormatShort'])
            );
            if ($value) {
                $value .= ' ('.$this->getAgeString($model).')';
            }
        }

        if (!$value) {
            $value = '--';
        }

        return $value;
    }

    /**
     * @param $model
     *
     * @return string
     */
    public function getAgeString($model)
    {
        return $this->getAge($model).' '.translator()->trans('years');
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getAge($model)
    {
        $dob = parent::printItemValue($model);
        if ($dob) {
            [$years] = $this->_calculateAge($dob);

            return $years;
        }
    }

    protected function _calculateAge($unix)
    {
        $calculationDate = $this->getAgeCalculationDate();

        return Nip_Helper_Date::instance()->calculateAge($unix, $calculationDate);
    }

    abstract protected function getAgeCalculationDate();
}
