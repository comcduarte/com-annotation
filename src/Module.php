<?php
namespace Annotation;

class Module
{
    const TITLE = "Annontation Module";
    const VERSION = "v1.0.2";
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}