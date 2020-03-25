<?php

use Illuminate\Http\Response;

class AuthTest extends TestCase
{
    /***
     * Successful auth call
     */
    public function testAuthCallSuccess()
    {
        $this->post("/auth/login", ['username' => 'newuser', 'password' => 'brain_training_123']);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['token']);
    }

    /***
     * Test missing
     */
    public function testMissingValue()
    {
        $this->post('/auth/login', []);
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }

    /***
     * test invalid email
     */
    public function testInvalidEmail()
    {
        $this->post("/auth/login", ['username' => 'newuser', 'password' => 'secret']);
        $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }
}
