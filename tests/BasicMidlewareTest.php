<?php

class BasicMiddlewareTest extends \TestCase
{
    /** @var App\Http\Middleware\BasicMiddleware */
    protected $middleware;

    /** @var Illuminate\Http\Request */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->middleware = new \App\Http\Middleware\BasicMiddleware;
        $this->request = new \Illuminate\Http\Request;
    }

    public function testHandleFails()
    {
        $this->middleware->handle($this->request, function () {});
    }

    public function testFailedHandle()
    {
        $respons = $this->middleware->handle($this->request, function() {});
        $this->assertEquals(true, $respons->isRedirection());
    }

    public function testHandlePass()
    {
        $this->request['id'] = 1;
        $response = $this->middleware->handle($this->request, function() {
            return 'OK';
        });

        $this->assertEquals('OK', $response);
    }
}
