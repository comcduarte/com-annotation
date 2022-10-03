<?php
namespace Annotation\Traits;

use Annotation\Model\AnnotationModel;
use Laminas\Db\Sql\Where;
use Laminas\Db\Sql\Predicate\Like;
use User\Model\UserModel;

trait AnnotationAwareTrait
{
    public $annotations_tablename;
    public $annotations_prikey;
    public $annotations_user;
    
    public function getAnnotations(String $tablename = NULL, String $prikey = NULL)
    {
        /****************************************
         * ANNOTATIONS
         ****************************************/
        if (! is_null($tablename)) { $this->annotations_tablename = $tablename; }
        if (! is_null($prikey)) { $this->annotations_prikey = $prikey; }
        
        $annotation = new AnnotationModel($this->adapter);
        $where = new Where([
            new Like('TABLENAME', $this->annotations_tablename),
            new Like('PRIKEY', $this->annotations_prikey),
        ]);
        $annotations = $annotation->fetchAll($where, ['DATE_CREATED DESC']);
        $notes = [];
        foreach ($annotations as $annotation) {
            $user = new UserModel($this->adapter);
            $user->read(['UUID' => $annotation['USER']]);
            
            $notes[] = [
                'USER' => $user->USERNAME,
                'ANNOTATION' => $annotation['ANNOTATION'],
                'DATE_CREATED' => $annotation['DATE_CREATED'],
            ];
        }
        
        return [
            'annotations' => $notes,
            'annotations_prikey' => $this->annotations_prikey,
            'annotations_tablename' => $this->annotations_tablename,
            'annotations_user' => $this->annotations_user,
        ];
    }
}