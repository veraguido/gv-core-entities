<?php

namespace Gvera\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class UserStatus
 * @package Gvera\Models
 * @Entity @Table(name="user_roles")
 */
class UserRole
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected int $id;
    /** @Column(type="string", nullable=false, unique=true, length=20) */
    protected string $name;
    /** @Column(type="integer", unique=true, nullable=false) */
    protected $rolePriority;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Many Users have Many Stores.
     * @ManyToMany(targetEntity="UserRoleAction", inversedBy="user_role_actions", fetch="EAGER", cascade={"persist"})
     */
    protected Collection $userRoleActions;

    /**
     * UserRole constructor.
     */
    public function __construct()
    {
        $this->userRoleActions = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRolePriority()
    {
        return $this->rolePriority;
    }

    /**
     * @param mixed $rolePriority
     */
    public function setRolePriority($rolePriority)
    {
        $this->rolePriority = $rolePriority;
    }

    /**
     * @return Collection
     */
    public function getUserRoleActions(): Collection
    {
        return $this->userRoleActions;
    }

    /**
     * @param Collection $userRoleActions
     */
    public function setUserRoleActions(Collection $userRoleActions): void
    {
        $this->userRoleActions = $userRoleActions;
    }

    public function addRoleAction(UserRoleAction $roleAction)
    {
        if (null === $roleAction) {
            return;
        }

        if ($this->userRoleActions->contains($roleAction)) {
            return;
        }
        $this->userRoleActions->add($roleAction);
    }

    public function removeRoleAction(UserRoleAction $roleAction)
    {
        if (!$this->userRoleActions->contains($roleAction)) {
            return;
        }
        $this->userRoleActions->removeElement($roleAction);
    }
}
