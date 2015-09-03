<?php

namespace StaticPage;

return [
    'router' => [
        'routes' => [
            'StaticPageView' => [
                'type'    => 'Segment',
                'options' => [
                    'route'       => '/page[/:slug]',
                    'constraints' => [
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults'    => [
                        'controller' => 'StaticPage\Controller\DisplayPage',
                        'action'     => 'index',
                    ],
                ],
            ]
        ]
    ],
    'service_manager' => [
        'invokables' => [
            'StaticPage/Model/StaticPage' => 'StaticPage\Model\StaticPageModel',
            'StaticPage/Grid/StaticPage'  => 'StaticPage\Grid\StaticPageGrid',
        ],
        'factories' =>array(
        )
    ],
    'controllers'     => [
        'invokables' => [
            'StaticPage\Controller\DisplayPage' => 'StaticPage\Controller\DisplayPageController'
        ],
    ],
    'view_manager'    => [
        'template_path_stack'      => [
            'static-page' => __DIR__ . '/../view',
        ],
    ],
    'doctrine'        => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

    'moxiemanager'    => [
        'presets' => array(
            'staticPage' => array(
                'endpoint' => '',
                'configuration' => array(
                    'filesystem.rootpath' => $_SERVER['DOCUMENT_ROOT'] . "/uploads/sp",
                )
            )
        ),
    ],

    'richeditor'      => array(
        'staticPage' => array(
            'type' => 'tiny',
            'moxiemanager' => 'staticPage',
            'options' => array(
                'theme' => 'modern',
                'plugins' => array(
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ),
                'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                'toolbar2' => "print preview media | forecolor backcolor emoticons",
                'image_advtab' => true,
                'relative_urls' => false,
                'document_base_url' => '/',
            ),
        )
    )
];
