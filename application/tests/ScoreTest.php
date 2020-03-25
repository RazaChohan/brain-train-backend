<?php

use Illuminate\Http\Response;

class ScoreTest extends TestCase
{
    /***
     * Test get score
     */
    public function testGetScoreSuccess()
    {
        $authToken = $this->getToken();
        $this->get("/score" . "?token=$authToken");
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['data' => ['history']]);
    }
    /***
     * Test get score
     */
    public function testGetScoreWithCategoriesSuccess()
    {
        $authToken = $this->getToken();
        $this->get("/score" . "?token=$authToken&getLastSessionCategories=true");
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['data' => ['history', 'last_session_categories']]);
    }
    /***
     * Test get score
     */
    public function testGetScoreWithoutCategoriesSuccess()
    {
        $authToken = $this->getToken();
        $this->get("/score" . "?token=$authToken&getLastSessionCategories=false");
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['data' => ['history']]);
    }
    /***
     * Test unauthorized call
     */
    public function testUnAuthorized()
    {
        $this->get('/score');
        $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }

}
