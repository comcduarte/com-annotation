<?php
namespace Annotation\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Db\Adapter\Adapter;

class AnnotationModel extends AbstractBaseModel
{
    const INACTIVE_STATUS = 0;
    const ACTIVE_STATUS = 1;
    
    public $TABLENAME;
    public $PRIKEY;
    public $USER;
    public $ANNOTATION;
    
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
        $this->setTableName('annotations');
    }
}