<?php

namespace ByTIC\FormBuilder\Forms\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\FormBuilder\Forms\Models\Form;

class ImportForm extends Action
{
    use HasSubject;

    protected Form|null $source = null;


    public function handle()
    {
        $this->emptyOldFields();
        $this->duplicateFields();
    }

    protected function emptyOldFields(): void
    {
        $fields = $this->getSubject()->getFormFields();
        $fields->delete();
    }

    protected function duplicateFields(): void
    {
        $form = $this->getSubject();
        $fields = $this->getSource()->getFormFields();
        foreach ($fields as $field) {
            $field->duplicate(['id_form' => $form->id]);
        }
    }

    /**
     * @param $source
     * @return $this
     */
    public function withSource($source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): ?Form
    {
        return $this->source;
    }
}
