<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2019 Melis Technology (http://www.melistechnology.com)
 *
 */

return array(
    'third-party-framework' => [
        'index-path' => [
            '/Symfony/public/index.php'
        ]
    ],
    'router' => array(
        'routes' => array(
            'melis-backoffice' => array(
                'child_routes' => array(
                    'application-MelisPlatformFrameworkSymfonyDemoTool' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => 'MelisPlatformFrameworkSymfonyDemoTool',
                            'defaults' => array(
                                '__NAMESPACE__' => 'MelisPlatformFrameworkSymfonyDemoTool\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'default' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/[:controller[/:action][/:id]]',
                                    'constraints' => array(
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'MelisPlatformFrameworkSymfonyDemoTool\Controller\SymfonyDemoTool' => 'MelisPlatformFrameworkSymfonyDemoTool\Controller\SymfonyDemoToolController',
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'MelisPlatformFrameworkSymfonyDemoToolPlugin' => 'MelisPlatformFrameworkSymfonyDemoTool\Controller\Plugin\MelisPlatformFrameworkSymfonyDemoToolPlugin',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'layout/layout'             => __DIR__ . '/../view/layout/default.phtml',
            'DemoTool/SymfonyPlugin'    => __DIR__ . '/../view/melis-platform-framework-symfony-demo-tool/plugins/render-symfony-demo-tool-plugin.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
