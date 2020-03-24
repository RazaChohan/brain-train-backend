<?php

namespace Dal\Interfaces;


use Dal\Entities\User;

interface UserRepository
{
    /**
     * Check user authentication
     *
     * @param string $username
     *
     * @return User|null
     */
    public function getUserByUsername($username);
}
