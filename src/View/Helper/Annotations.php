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
        ?>
        <div class="card mb-4">
        	<div class="card-header d-flex justify-content-between">
        		<div>
        			<b>Annotations</b>
        		</div>
        		<div>
        			<a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalLoginForm">Add Annotation</a>
        		</div>
    		</div>
    		<div class="card-body">
    			<table class="table table-sm table-striped">
    				<thead>
    					<tr class="d-flex">
    						<th class="col-2">User</th>
    						<th class="col-8">Annotation</th>
    						<th class="col-2">Date Created</th>
						</tr>
    				</thead>
    				<tbody>
    					<?php foreach ($this->annotations as $annotation) : ?>
    					<?php echo $this->renderItem($annotation['USER'], $annotation['ANNOTATION'], $annotation['DATE_CREATED']); ?>
    					<?php endforeach; ?>
    				</tbody>
    			</table>
    		</div>
        </div>
        <?php echo $this->renderAddAnnotationForm(); ?>
        <?php 
//         $result  = '<div class="container">';
//         $result .= '<div class="row">';
//         $result .= '<div class="col">';
//         $result .= '<h3>Annotations</h3>';
//         $result .= '</div>';
//         $result .= '<div class="d-flex justify-content-end">';
//         $result .= '<a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Add Annotation</a>';
//         $result .= '</div></div></div>';
//         $result .= $this->renderAddAnnotationForm();
//         $result .= '<table class="table table-sm table-striped">';
//         $result .= '<thead>';
//         $result .= '<tr class="d-flex"><th class="col-2">User</th><th class="col-8">Annotation</th><th class="col-2">Date Created</th></tr>';
//         $result .= '</thead>';
//         $result .= '<tbody>';

        
        
//         foreach ($this->annotations as $annotation) {
            
//             $result .= $this->renderItem($annotation['USER'], $annotation['ANNOTATION'], $annotation['DATE_CREATED']);
//         }
        
//         $result .= '</tbody>';
//         $result .= '</table>';
//         $result .= '</div>';
        
//         return $result;
    }
    
    public function renderItem($user, $note, $date)
    {
//         $result = sprintf('<tr class="d-flex"><td class="col-2">%s</td><td class="col-8">%s</td><td class="col-2">%s</td></tr>',$user, $note, $date);
//         return $result;
        return sprintf('<tr class="d-flex"><td class="col">%s</td><td class="col">%s</td><td class="col">%s</td></tr>',$user, $note, $date);
    }

    public function renderAddAnnotationForm()
    {
        ?>
        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
        	aria-labelledby="myModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        		<?php 
        		$form = new AnnotationForm();
        		$form->prikey = $this->view->annotations_prikey;
        		$form->tablename = $this->view->annotations_tablename;
        		$form->user = $this->view->annotations_user;
//         		$form->user = $this->view->identity();
        		$form->init();
        		
        		$form->setAttribute('action', $this->view->url('annotation/annotation', ['action' => 'create']));
        		$form->prepare();
        		
        		echo $this->view->form()->openTag($form);
        		echo $this->view->formCollection($form);
        		echo $this->view->form()->closeTag($form);
        		?>
        		</div>
        	</div>
        </div>
        
    	
		<?php 
    }
}