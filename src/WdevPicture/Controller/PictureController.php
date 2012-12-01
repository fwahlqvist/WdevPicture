<?php

namespace wdev-picture\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
    
use wdev-picture\Model\Picture,
    wdev-picture\Form\PictureForm;

use Zend\Validator\File\Size;

class PictureController extends AbstractActionController
{
    public function addAction()
    {
        $form = new PictureForm();
        $request = $this->getRequest();  
        if ($request->isPost()) {
            
            $picture = new Picture();
            $form->setInputFilter($picture->getInputFilter());
            
            $nonFile = $request->getPost()->toArray();
            $File    = $this->params()->fromFiles('fileupload');
            $data = array_merge(
                 $nonFile,
                 array('fileupload'=> $File['name'])
             );
            //set data post and file ...    
            $form->setData($data);
             
            if ($form->isValid()) {
                
               // $picture->exchangeArray($form->getData());
                $size = new Size(array('min'=>'0.001MB')); //2MB
                
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                
                        $extensionvalidator = new \Zend\Validator\File\Extension(array('extension'=>array('jpg','png')));
                  //      $adapter->setValidators(array($extensionvalidator));                

                
                $adapter->setValidators(array($size,$extensionvalidator), $File['name']);
                if (!$adapter->isValid()){
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach($dataError as $key=>$row)
                    {
                        $error[] = $row;
                    }
                    $form->setMessages(array('fileupload'=>$error ));
                } else {
                    $adapter->setDestination(dirname(__DIR__).'/assets');
                    if ($adapter->receive($File['name'])) {
                            $picture->exchangeArray($form->getData());
                            // redirect to picture route
                            return $this->redirect()->toRoute('picture');
                            //echo 'Picture Name '.$picture->picturename.' upload '.$picture->fileupload;
                    }
                }  
            } 
        }
         
        return array('form' => $form);
    }
}