<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Security;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActualUserInterface extends EquatableInterface, UserInterface
{
    /**
     * @param boolean $actual
     * @return mixed
     */
    public function setActual($actual);

    /**
     * @return boolean
     */
    public function isActual();
}