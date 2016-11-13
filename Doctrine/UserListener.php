<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Doctrine;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Ilya\ActualUserBundle\Security\ActualUserInterface;

/**
 * Doctrine listener updating the actual flag field.
 */
class UserListener extends AbstractUserListener
{
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
        if ($object instanceof ActualUserInterface && $args->hasChangedField('roles')) {
            $object->setActual(false);
            $this->recomputeChangeSet($args->getObjectManager(), $object);
        }
    }
}
