<?php
namespace Annotation\Controller;

use Annotation\Model\AnnotationModel;
use Components\Controller\AbstractBaseController;
use Laminas\Db\Sql\Where;
use Laminas\View\Model\ViewModel;

class AnnotationController extends AbstractBaseController
{
    public function indexAction()
    {
        return $this->redirect()->toRoute('home');
    }
    
    public function readAction()
    {
        $annotation = new AnnotationModel($this->adapter);
        $annotations = $annotation->fetchAll(new Where(), ['TABLENAME']);
        
        return ([
            'annotations' => $annotations,
        ]);
    }
    
    public function createAction()
    {
        $view = new ViewModel();
        $view = parent::createAction();
        
        $url = $this->getRequest()->getHeader('Referer')->getUri();
        return $this->redirect()->toUrl($url);
    }
}