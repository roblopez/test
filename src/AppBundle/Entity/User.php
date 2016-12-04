<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="firstname", type="string", length=50, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="El nombre debe ser una cadena de carácteres."
     * )
     * @Assert\NotNull(
     *     message="El nombre no puede estar vacío."
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "El nombre debe tener almenos {{ limit }} carácteres.",
     *      maxMessage = "El nombre debe tener como máximo {{ limit }} carácteres."
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9 ]*$/",
     *     match=true,
     *     message="El nombre solo puede contener letras y números. Sin tíldes"
     * )
     */
    protected $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=120, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="El apellido debe ser una cadena de carácteres."
     * )
     * @Assert\NotNull(
     *     message="El apellido no puede estar vacío."
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 120,
     *      minMessage = "El apellido debe tener almenos {{ limit }} carácteres.",
     *      maxMessage = "El apellido debe tener como máximo {{ limit }} carácteres."
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9 ]*$/",
     *     match=true,
     *     message="El apellido solo puede contener letras y números. Sin tíldes"
     * )
     */
    protected $lastname;

    /**
     * @ORM\Column(name="hash", type="string", length=255, nullable=true)
     */
    protected $hash;

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return User
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
}