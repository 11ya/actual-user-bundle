<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Doctrine;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\PersistentCollection;
use Ilya\ActualUserBundle\Security\ActualUserInterface;

/**
 * Doctrine listener updating the actual flag field.
 */
class UserGroupListener extends AbstractUserListener
{
    protected $groupClass;

    /**
     * UserGroupListener constructor.
     * @param $groupClass
     */
    public function __construct($groupClass = null)
    {
        $this->groupClass = $groupClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            'preUpdate',
        );
    }

    /**
     * Pre update listener based on doctrine common.
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof ActualUserInterface) {
            $om = $args->getObjectManager();

            /**
             * @var PersistentCollection $collection
             */
            foreach ($om->getUnitOfWork()->getScheduledCollectionUpdates() as $collection) {
                if ($mapping = $collection->getMapping() AND $mapping['fieldName'] == 'groups') {
                    $object->setActual(false);
                    $this->recomputeChangeSet($om, $object);
                }
            }
        }

        if (get_class($object) == $this->groupClass && $args->hasChangedField('roles')) {
            foreach ($object->getUsers() as $user) {
                if ($user instanceof ActualUserInterface) {
                    $user->setActual(false);
                    $this->recomputeChangeSet($args->getObjectManager(), $user);
                }
            }
        }
    }
}
