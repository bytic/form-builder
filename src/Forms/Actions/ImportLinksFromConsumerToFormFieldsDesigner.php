<?php

namespace ByTIC\FormBuilder\Forms\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\FormBuilder\Forms\Models\Form;

class ImportLinksFromConsumerToFormFieldsDesigner extends Action
{
    use HasSubject;

    protected Form $form;

    protected $consumers;
    public function withForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function forConsumers($consumers)
    {
        $this->consumers = $consumers;
        return $this;
    }

    public function handle()
    {
        foreach ($this->consumers as $consumer) {
            $this->addDesignerImportLink($consumer);
        }
    }

    protected function addDesignerImportLink($consumer)
    {
        $sourceForm = FormGenerateForConsumer::for($consumer)->handle();
        $this->getSubject()->addImportLink([
           'name' => $consumer->getName(),
           'href' => $this->generateImportLink($this->form, $sourceForm),
        ]);
    }

    protected function generateImportLink($form, $sourceForm)
    {
        return $form->compileUrl('import',['form_id' => $sourceForm->id]);
    }
}