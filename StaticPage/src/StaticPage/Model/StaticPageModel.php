<?php
namespace StaticPage\Model;

use SbxCommon\Crud\CrudModelInterface;
use StaticPage\Base\Model;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject AS DoctrineObjectHydrator;
use StaticPage\Entity\StaticPage;
use StaticPage\Entity\StaticPageLocale;

class StaticPageModel extends Model implements CrudModelInterface
{
    /**
     * @param StaticPage $page
     *
     * @return \StaticPage\Entity\StaticPageLocale
     */
    public function getPageTranslation(\StaticPage\Entity\StaticPage $page)
    {
        $currentLang = $this->getServiceLocator()->get('translator')->getLocale();
        $config = $this->getServiceLocator()->get('config');
        $defaultLang = $config['slm_locale']['default'];

        $translation = null;
        $defaultLngTranslation = null;
        $existingTranslation = null;
        /**
         * @var \StaticPage\Entity\StaticPageLocale $locale
         */
        foreach($page->getLocale() as $locale){
            if($locale->getLanguageId() == $currentLang){
                $translation = $locale;
                break;
            } elseif($locale->getLanguageId() == $defaultLang){
                $defaultTranslation = $locale;
            } else {
                $existingTranslation = $locale;
            }
        }

        return null != $translation ? $translation : (
            null != $defaultTranslation ? $defaultTranslation : $existingTranslation
        );
    }

    /**
     * @param $slug
     *
     * @return \StaticPage\Entity\StaticPage
     */
    public function findBySlug($slug)
    {
        return $this->getEntityManager()->getRepository('StaticPage\Entity\StaticPage')->findOneBy(
            array(
                'slug' => $slug
            )
        );
    }

    public function findById($id)
    {
        return $this->getEntityManager()->getRepository('StaticPage\Entity\StaticPage')->find($id);
    }

    public function getGrid()
    {
        $grid = $this->getServiceLocator()->get('StaticPage/Grid/StaticPage');
        $grid->setDataSource($this->getEntityManager()->getRepository('StaticPage\Entity\StaticPage'));
        return $grid;
    }

    public function getForm($entity = null)
    {
        if ($entity == null) {
            $entity = new StaticPage();
        }
        $hydrator = new DoctrineObjectHydrator($this->getEntityManager());

        $form = $this->getServiceLocator()->get('StaticPage\Form\StaticPage');
        $data = $hydrator->extract($entity);
        $localesData = array();
        foreach($data['locale'] as $translation){
            $localesData[$translation->getLanguageId()] = $hydrator->extract($translation);
            unset($localesData[$translation->getLanguageId()]['staticPage']);
        }
        $data['locale'] = $localesData;

        $form->setData($data);

        return $form;
    }

    public function saveForm($form, $entity = null)
    {
        if ($entity == null) {
            $entity = new StaticPage();
            $entity->setCreatedTime(new \DateTime());
        }
        $entity->setModifiedTime(new \DateTime());
        $data = $form->getData();
        $translationsData = $data['locale'];
        unset($data['locale']);
        unset($data['footer']);

        $hydrator = new DoctrineObjectHydrator($this->getEntityManager());

        $hydrator->hydrate(
            $data,
            $entity
        );

        foreach($entity->getLocale() as $translation) {
            if (array_key_exists($translation->getLanguageId(), $translationsData)) {
                $hydrator->hydrate(
                    $translationsData[$translation->getLanguageId()],
                    $translation
                );
                unset($translationsData[$translation->getLanguageId()]);
            } else {
                $entity->removeLocale($translation);
                $this->getEntityManager()->remove($translation);
            }
        }

        foreach($translationsData as $transData){
            $translation = new StaticPageLocale();
            $hydrator->hydrate(
                $transData,
                $translation
            );
            $entity->addLocale($translation);
            $translation->setStaticPage($entity);
        }
        $this->getEntityManager()->persist($entity);
        return $entity;
    }

    public function removeEntity($entity)
    {
        $this->getEntityManager()->remove($entity);
    }
}