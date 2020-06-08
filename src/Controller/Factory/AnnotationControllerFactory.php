<?php
namespace Annotation\Controller\Factory;

use Annotation\Controller\AnnotationController;
use Annotation\Form\AnnotationForm;
use Annotation\Model\AnnotationModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AnnotationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new AnnotationController();
        $adapter = $container->get('annotation-model-adapter');
        $model = new AnnotationModel($adapter);
        $form = $container->get('FormElementManager')->get(AnnotationForm::class);
        $controller->setDbAdapter($adapter);
        
        $controller->setModel($model);
        $controller->setForm($form);
        
        return $controller;
    }
}