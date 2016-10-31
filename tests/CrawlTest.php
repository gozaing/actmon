<?php

class CrawlTest extends \TestCase
{

    public function testCrawlIndex()
    {
        $this->visit('/');
    }

    public function testCrawlCallIndex()
    {
        $this->call('GET', '/', ['message' => 'actmon']);
        $this->assertResponseOk();
    }

    public function testCrawlGetIndex()
    {
        $this->get('/')->assertResponseOk();
    }

//    public function testCrawlCallActionIndex()
//    {
//        $this->action('GET', 'HomeController@index');
//        $this->assertResponseOk();
//    }
//    public function testCrawlCallRouteIndex()
//    {
//        $this->route('GET', 'login');
//        $this->assertResponseOk();
//    }
//    public function testSubmitFormResponse()
//    {
//    }
}