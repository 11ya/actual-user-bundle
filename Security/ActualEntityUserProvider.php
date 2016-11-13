<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Security;


use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\Security\Core\User\UserInterface;

class ActualEntityUserProvider extends EntityUserProvider
{
    protected $registry;
    protected $managerName;

    public function refreshUser(UserInterface $user)
    {
        $user = parent::refreshUser($user);

        if ($user instanceof ActualUserInterface AND !$user->isActual()) {
            $this->updateUser($user);
        }

        return $user;
    }

    protected function updateUser(ActualUserInterface $user)
    {
        $user->setActual(true);
        $this->registry->getManager($this->managerName)->flush($user);
        $user->setActual(false);
    }
}