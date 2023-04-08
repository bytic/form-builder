<?php

namespace ByTIC\FormBuilder\Forms\Models;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\FormBuilder\Models\FormsFields\FormsField;
use Nip\Records\Collections\Associated;

/**
 * Trait FormTrait.
 *
 * @property int $id
 * @property string $name
 * @property string $tenant
 * @property int $tenant_id
 *
 * @method FormsField[]|Associated getFormFields
 */
trait FormTrait
{
    use TimestampableTrait;

    protected string $name = '';

    public $timestamps = true;

    /**
     * @var string
     */
    static protected $createTimestamps = ['created'];

    /**
     * @var string
     */
    static protected $updateTimestamps = ['modified'];

    public function getName(): string
    {
        return $this->name;
    }

    public function hasResponses(): bool
    {
        return false;
    }
}
