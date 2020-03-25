<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /***
     * Get auth token
     *
     * @return string
     */
    public function getToken()
    {
        $this->post("/auth/login", ['username' => 'newuser', 'password' => 'brain_training_123']);
        $responseBody = json_decode($this->response->getContent());
        return isset($responseBody->token) ? $responseBody->token : '';
    }
}
