<?php

namespace ByTIC\FormBuilder\FormResponseValues\Models;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;
use ByTIC\DataObjects\Casts\Metadata\Metadata;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsField;
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
 *
 * @property Metadata $metadata
 */
trait FormResponseValueTrait
{
    use TimestampableTrait;

    /**
     * @var string
     */
    static protected $createTimestamps = ['created'];
    /**
     * @var string
     */
    static protected $updateTimestamps = ['modified'];
    public $timestamps = true;
    protected string $name = '';

    public function bootFormTrait()
    {
        $this->addCast('metadata', AsMetadataObject::class.':json');
    }

    public function setConsumerClass($consumerClass)
    {
        $this->get('metadata')->set('consumer_class', $consumerClass);
    }

    public function getConsumerClass($default = null)
    {
        return $this->get('metadata')->get('consumer_class', $default);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hasResponses(): bool
    {
        return false;
    }
}
