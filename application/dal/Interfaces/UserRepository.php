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

    /****
     * Get user score history
     *
     * @param $userID
     * @return mixed
     */
    public function getUserScoreHistory($userID);
}
