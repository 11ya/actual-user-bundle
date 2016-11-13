<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Security;


use FOS\UserBundle\Security\UserProvider;
use Symfony\Component\Security\Core\User\UserInterface;

class ActualUserProvider extends UserProvider
{
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
        $this->userManager->updateUser($user);
        $user->setActual(false);
    }
}