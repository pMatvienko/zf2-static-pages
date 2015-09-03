<?php

namespace StaticPage\Form\StaticPage;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class LocaleFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='locale')
    {
        parent::__construct($name);
        $this
            ->add(
                array(
                    'name' => 'languageId',
                    'type' => 'Hidden',
                )
            )
            ->add(array(
                'name' => 'metaTitle',
                'type' => 'Text',
                'options' => array(
                    'label' => 'metaTitle',
                ),
            ))
            ->add(array(
                'name' => 'metaKeywords',
                'type' => 'Text',
                'options' => array(
                    'label' => 'metaKeywords',
                ),
            ))
            ->add(array(
                'name' => 'metaDescription',
                'type' => 'Textarea',
                'options' => array(
                    'label' => 'metaDescription',
                ),
                'attributes' => array(
                    'rows' => '10',
                ),
            ))
            ->add(
                array(
                    'name' => 'content',
                    'type' => 'SbxCommon\Form\Element\RichEditor',
                    'options' => array(
                        'label' => 'content',
                        'editorVersion' => 'staticPage',
                    ),
                    'attributes' => array(
                        'rows' => '30',
                    ),
                )
            );
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        if(!$this->isHaveData()){
            return array();
        };
        return array(
            'metaTitle' => array(
                'required' => true,
            ),
            'content' => array(
                'required' => true,
            ),
        );
    }

    public function isHaveData()
    {
        foreach ($this as $name => $item) {
            if($item->getName() == 'languageId') continue;
            if($item->getValue() != null) return true;
        }
        return false;
    }
}