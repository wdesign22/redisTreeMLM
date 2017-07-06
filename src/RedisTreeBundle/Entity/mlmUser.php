<?php

namespace RedisTreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * mlmUser
 *
 * @ORM\Table(name="mlm_user")
 * @ORM\Entity(repositoryClass="RedisTreeBundle\Repository\mlmUserRepository")
 */
class mlmUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="ancestor", type="integer")
     */
    private $ancestor;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return mlmUser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ancestor
     *
     * @param integer $ancestor
     *
     * @return mlmUser
     */
    public function setAncestor($ancestor)
    {
        $this->ancestor = $ancestor;

        return $this;
    }

    /**
     * Get ancestor
     *
     * @return int
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }
}

