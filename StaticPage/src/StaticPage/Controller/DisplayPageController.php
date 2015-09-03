<?php
namespace StaticPage\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DisplayPageController extends AbstractActionController
{
    public function indexAction()
    {
        /**
         * @var \StaticPage\Model\StaticPageModel $model
         */
        $model = $this->getServiceLocator()->get('StaticPage/Model/StaticPage');
        $page = $model->findBySlug($this->params()->fromRoute('slug'));
        if(null == $page || ! $page->getIsPublished()){
            throw new \Zend\Mvc\Exception\InvalidControllerException('Page not found', 404);
        }
        $translation = $model->getPageTranslation($page);
        $this->getServiceLocator()->get('viewHelperManager')->get('headTitle')->append($translation->getMetaTitle());
        $this->getServiceLocator()->get('viewHelperManager')->get('headMeta')
            ->appendName('keywords', $translation->getMetaKeywords())
            ->appendName('description', $translation->getMetaDescription());
        return array(
            'content' => $translation->getContent()
        );
    }
}