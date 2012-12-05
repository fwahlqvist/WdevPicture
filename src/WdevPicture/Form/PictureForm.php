<?php
// fileuploadname:
namespace WdevPicture\Form;

use Zend\Form\Form;

class PictureForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Picture');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('data-ajax', 'false');

        $this->add(array(
            'name' => 'picturename',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Picture Name',
            ),
        ));

        $this->add(array(
            'name' => 'fileupload',
            'attributes' => array(
                'type' => 'file',
            ),
            'options' => array(
                'label' => 'File Upload',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Upload Now',
            ),
        ));          
    }
}    