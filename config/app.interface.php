<?php
    return [
        'plugins' => [
            'meliscore' => [
                'interface' => [
                    'meliscore_leftmenu' => [
                        'interface' => [
                            'meliscore_toolstree_section' => [
                                'interface' => [
                                    'meliscore_tool_creatrion_designs' => [
                                        'conf' => [
                                            'id' => 'id_meliscore_tool_creatrion_designs',
                                            'melisKey' => 'meliscore_tool_creatrion_designs',
                                            'name' => 'tr_meliscore_tool_creatrion_designs',
                                            'icon' => 'fa fa-paint-brush',
                                        ],
                                        'interface' => [
                                            'meliscore_tool_tools' => [
                                                'conf' => [
                                                    'id' => 'id_meliscore_tool_tools',
                                                    'melisKey' => 'meliscore_tool_tools',
                                                    'name' => 'tr_meliscore_tool_tools',
                                                    'icon' => 'fa fa-magic',
                                                ],
                                                'interface' => [
                                                    'melisplatform_framework_symfony_demo_tool' =>  [
                                                        'conf' => [
                                                            'type' => '/melisplatform_framework_symfony_demo/interface/melisplatform_framework_symfony_demo_tool'
                                                        ],
                                                    ],
                                                ],
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'melisplatform_framework_symfony_demo' => [
                'conf' => [
                    'id' => '',
                    'name' => 'tr_melis_code_example_symfony_name',
                    'rightsDisplay' => 'none',
                ],
//                'datas' => [
//                    'index_path' => 'symfony\public\index.php',
//                ],
                'ressources' => [
                    'js' => array(
                        '/MelisCodeExampleSymfony/js/album.js',
                    ),
                    'css' => array(

                    ),
                    /**
                     * the "build" configuration compiles all assets into one file to make
                     * lesser requests
                     */
                    'build' => [
                        'disable_bundle' => true,
                        'js' => [
                            '/MelisCms/build/js/bundle.js',
                        ]
                    ]

                ],
                'interface' => [
                    'melisplatform_framework_symfony_demo_tool' => [
                        'conf' => [
                            'id' => 'id_meliscodeexamplesymfony_tool',
                            'melisKey' => 'meliscodeexamplesymfony_tool',
                            'name' => 'tr_melis_code_example_symfony_name',
                            'icon' => 'fa-dot-circle-o',
                        ],
                        'forward' => [
                            'module' => 'MelisPlatformFrameworkSymfonyDemoTool',
                            'controller' => 'SymfonyDemoTool',
                            'action' => 'render-symfony-demo-tool',
                            'jscallback' => '',
                            'jsdatas' => [],
                        ],
                    ],
                ],
            ],
        ],
    ];