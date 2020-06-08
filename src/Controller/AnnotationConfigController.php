<?php
namespace Annotation\Controller;

use Components\Controller\AbstractConfigController;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Ddl\CreateTable;
use Laminas\Db\Sql\Ddl\DropTable;
use Laminas\Db\Sql\Ddl\Column\Datetime;
use Laminas\Db\Sql\Ddl\Column\Integer;
use Laminas\Db\Sql\Ddl\Column\Text;
use Laminas\Db\Sql\Ddl\Column\Varchar;
use Laminas\Db\Sql\Ddl\Constraint\PrimaryKey;

class AnnotationConfigController extends AbstractConfigController
{
    public function __construct()
    {
        $this->setRoute('annotation/config');
    }
    
    public function clearDatabase()
    {
        $sql = new Sql($this->adapter);
        $ddl = [];
        
        $ddl[] = new DropTable('annotations');
        
        foreach ($ddl as $obj) {
            $this->adapter->query($sql->buildSqlString($obj), $this->adapter::QUERY_MODE_EXECUTE);
        }
    }
    
    public function createDatabase()
    {
        $sql = new Sql($this->adapter);
        
        /******************************
         * ANNOTATIONS
         ******************************/
        $ddl = new CreateTable('annotations');
        
        $ddl->addColumn(new Varchar('UUID', 36));
        $ddl->addColumn(new Integer('STATUS', TRUE));
        $ddl->addColumn(new Datetime('DATE_CREATED', TRUE));
        $ddl->addColumn(new Datetime('DATE_MODIFIED', TRUE));
        
        $ddl->addColumn(new Varchar('TABLENAME', 100));
        $ddl->addColumn(new Varchar('PRIKEY', 36));
        $ddl->addColumn(new Varchar('USER', 36));
        $ddl->addColumn(new Text('ANNOTATION', TRUE));
        
        $ddl->addConstraint(new PrimaryKey('UUID'));
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
        unset($ddl);
    }
    
}