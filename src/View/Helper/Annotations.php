<?php
namespace Annotation\View\Helper;

use Annotation\Form\AnnotationForm;
use Laminas\View\Helper\AbstractHelper;

class Annotations extends AbstractHelper
{
    public $annotations;
    
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;
        return $this;
    }
    
    public function render()
    {
        $html = '';
        $html = $this->getView()->render('annotations', ['annotations' => $this->annotations]);
        $html .= $this->renderAddAnnotationForm();
        
        return $html;
    }

    public function renderAddAnnotationForm()
    {
        $form = new AnnotationForm();
        $form->prikey = $this->getView()->annotations_prikey;
        $form->tablename = $this->getView()->annotations_tablename;
        $form->user = $this->getView()->annotations_user;
        $form->init();
        
        return $this->getView()->render('partials/add-annotation-form', ['form' => $form]);
    }
}