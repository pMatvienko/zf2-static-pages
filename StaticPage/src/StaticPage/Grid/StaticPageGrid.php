<?php
namespace StaticPage\Grid;

use DataGrid\DataGrid;

class StaticPageGrid extends DataGrid
{
    public function __construct()
    {
        $this->setId('spg');
        $this->setDefaultOrder('id', 'asc');
        $this
            ->appendCell(array(
                'type' => 'text',
                'content' => '{$id}',
                'label' => 'id',
                'orderBy' => 'id',
                'attribs' => array(
                    'cell:style' => 'width:65px; text-align:center;',
                ),
            ), 'identifier')
            ->appendCell(array(
                'type' => 'text',
                'content' => '{$slug}',
                'label' => 'slug',
                'orderBy' => 'slug',
            ), 'slug')

            ->appendCell(array(
                'type' => 'text',
                'content' => '{$locale.metaTitle}',
                'label' => 'metaTitle',
                'orderBy' => 'metaTitle',
            ), 'metaTitle')

            ->appendCell(array(
                'type' => 'text',
                'content' => '{$modifiedTime:|date%d M, Y; H:i}',
                'label' => 'modifiedTime',
                'orderBy' => 'modifiedTime',
            ), 'modifiedTime')
            ->appendCell(array(
                'type'    => 'boolean',
                'content' => 'isPublished',
                'label'   => 'is-published',
                'attribs' => array(
                    'cell:style'       => 'width:120px; text-align:center;',
                    'element:disabled' => 'disabled',
                    'element:name'     => 'isPublished[{$id}]'
                ),
            ), 'isPublished')
            ->appendCell(array(
                'type' => 'union',
                'label' => '',
                'joinBy' => '&nbsp;&nbsp;',
                'attribs' => array(
                    'cell:style' => 'width:55px; text-align:center;',
                ),
                'content' => array(
                    array(
                        'type' => 'action',
                        'label' => 'actions',
                        'content' => array(
                            'action' => 'edit',
                            'id' => '{$id}'
                        ),
                        'attribs' => array(
                            'element:class' => 'glyphicon glyphicon-edit',
                        )
                    ),
                    array(
                        'type' => 'action',
                        'label' => 'actions',
                        'content' => array(
                            'action' => 'remove',
                            'id' => '{$id}'
                        ),
                        'attribs' => array(
                            'element:class' => 'glyphicon glyphicon-trash',
                        )
                    )
                )
            ))
        ;
    }
}