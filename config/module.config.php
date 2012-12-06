<?php
// module/Picture/config/module.config.php
namespace WdevPicture;

return array(
  'controllers' => array(
      'invokables' => array(
          'picture' => 'WdevPicture\Controller\PictureController',
      ),
  ),
 /*   
  'router' => array(
      'routes' => array(
          'picture' => array(
              'type' => 'segment',
              'options' => array(
                  'route' => '/picture[/:action][/:id]',
                  'constraints' => array(
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                      //'title' => '[a-zA-Z][a-zA-Z0-9_-]*',
                  ),
                  'defaults' => array(
                      'controller' => 'WdevPicture\Controller\picture',
                      'action' => 'index', 
                  ),
              ),
          ),
      ),
  ),  
  */
    
  'router' => array(
      'routes' => array(
          'picture' => array(
              'type' => 'Literal',
              'prioirty' => 1000,
              'options' => array(
                  'route' => '/picture',
                  'defaults' => array(
                      'controller' => 'picture',
                      'action' => 'add',
                  ),
              ),
              'may_terminate' => 'true',
              'child_routes' => array(
                  /*'view' => array(
                      'type' => 'segment',
                      'options' => array(
                          'route' => '/view[/:id]',
                          'defaults' => array(
                              'controller' => 'picture',
                              'action' => 'view',
                          ),
                      ), 
                  ),*/
                  'add' => array(
                      'type' =>'Literal',
                      'options' => array(
                          'route' => '/add',
                          'defaults' => array(
                              'controller' => 'picture',
                              'action' => 'add',
                          ),
                      ),
                  ),/*
                  'edit' => array(
                      'type' => 'segment',
                      'options' => array(
                          'route' => '/edit[/:id]',
                          'defaults' => array(
                              'controller' => 'picture',
                              'action' => 'edit',
                          ),
                      ),
                  ),
                  'delete' => array(
                      'type' => 'segment',
                      'options' => array(
                          'route' => '/delete[/:id]',
                          'defaults' => array(
                              'controller' => 'picture',
                              'action' => 'delete',
                          ),
                      ),
                  ),*/
              ),    
          ),
      ),
  ),    
  'view_manager' => array(
      'template_path_stack' => array(
          'picture' => __DIR__ . '/../view',
      ),
  ),
);
