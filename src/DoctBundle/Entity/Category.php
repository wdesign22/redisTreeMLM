<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 28.06.17
 * Time: 20:52
 */

namespace DoctBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Category
 * @package DoctBundle\Entity\
 * @ORM\Entity
 * @ORM\Table(name="Category")
 */

class Category
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Get id
     *
     * @return integer
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
     * @return Category
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
}
