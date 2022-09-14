<?php
namespace Annotation\Form;

use Components\Form\AbstractBaseForm;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Textarea;

class AnnotationForm extends AbstractBaseForm
{
    public $user;
    public $tablename;
    public $prikey;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'TABLENAME',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'TABLENAME',
                'value' => $this->tablename,
            ],
        ]);
        
        $this->add([
            'name' => 'PRIKEY',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'PRIKEY',
                'value' => $this->prikey,
            ],
        ]);
        
        $this->add([
            'name' => 'USER',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'USER',
                'value' => $this->user,
            ],
        ]);
        
        $this->add([
            'name' => 'ANNOTATION',
            'type' => Textarea::class,
            'attributes' => [
                'id' => 'ANNOTATION',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Annotation',
            ],
        ],['priority' => 10]);
        
        $this->remove('STATUS');
    }
}