<?php

namespace ByTIC\FormBuilder\Consumers\Models;

use Nip\Records\Record;

/**
 *
 */
interface Consumer
{
    public function getName(): string;

    public function getTenantId(): ?int;

    public function getTenant(): ?string;

    public function getTenantRecord(): ?Record;
}
