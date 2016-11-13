<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Security;

use FOS\UserBundle\Model\User;
use Symfony\Component\Security\Core\User\UserInterface;

class ActualUser extends User implements ActualUserInterface
{
    /**
     * @var boolean
     */
    protected $actual = true;

    /**
     * @param boolean $actual
     * @return mixed
     */
    public function setActual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isActual()
    {
        return $this->actual;
    }

    /**
     * The equality comparison should neither be done by referential equality
     * nor by comparing identities (i.e. getId() === getId()).
     *
     * However, you do not need to compare every attribute, but only those that
     * are relevant for assessing whether re-authentication is required.
     *
     * Also implementation should consider that $user instance may implement
     * the extended user interface `AdvancedUserInterface`.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function isEqualTo(UserInterface $user)
    {
        return $user instanceof ActualUserInterface ? $user->isActual() : true;
    }
}