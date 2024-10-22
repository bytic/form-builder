<?php

namespace ByTIC\FormBuilder\Forms\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;

class DuplicateForm extends Action
{
    use HasSubject;

    protected $formNew;

    protected $tenant = null;

    protected $consumers = [];

    public function handle()
    {
        $formNew = $this->getFormNew();
        $this->updateTenant($formNew);
        $formNew->save();
        $this->duplicateFields($formNew);
        $this->updateConsumers($formNew);

        return $formNew;
    }

    protected function getFormNew()
    {
        if ($this->formNew === null) {
            $this->formNew = $this->duplicateForm();
        }

        return $this->formNew;
    }

    protected function duplicateForm()
    {
        $form = $this->getSubject();
        $formNew = $form->duplicate();

        return $formNew;
    }

    protected function updateTenant($form = null): void
    {
        if (!is_object($this->tenant)) {
            return;
        }
        $form = $form ?: $this->getFormNew();
        $form->tenant_id = $this->tenant->id;
        $form->tenant_type = $this->tenant->getManager()->getMorphName();
    }

    protected function duplicateFields($form = null)
    {
        $form = $form ?: $this->getFormNew();
        $fields = $this->getSubject()->getFormFields();
        foreach ($fields as $field) {
            $field->duplicate(['id_form' => $form->id]);
        }
    }

    protected function updateConsumers($form = null): void
    {
        $form = $form ?: $this->getFormNew();
        foreach ($this->consumers as $consumer) {
            $relationName = $consumer->getManager()->getMorphName();
            $relationName = ucfirst($relationName);
            $formConsumersRelation = $form->getRelation($relationName);
            $formConsumers = $formConsumersRelation->getResults();
            $formConsumers->add($consumer);
            $formConsumersRelation->save();
        }
    }

    /**
     * @param $tenant
     * @return $this
     */
    public function withTenant($tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function withConsumer($consumer)
    {
        $this->consumers[] = $consumer;

        return $this;
    }
}