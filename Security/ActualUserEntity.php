<?php

/*
 * This file is part of the IlyaActualUserBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ilya\ActualUserBundle\Security;

use Doctrine\ORM\Mapping as ORM;

trait ActualUserEntity
{
    /**
     * @var boolean
     *
     * @ORM\Column(type = "boolean", options = {"default": true})
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
}