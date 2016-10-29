<?php

class ReportTest extends \PHPUnit_Framework_TestCase
{
    /** @var \App\Report */
    protected $report;
    protected function setUp(){
        $this->report = new \App\Report(
            new \Illuminate\Filesystem\Filesystem()
        );
    }

    public function testOutput()
    {
        $filesystemMock = Mockery::mock('Illuminate\Filesystem\Filesystem');
        $content = 'report';
        $filesystemMock->shouldReceive('put')->with('report.txt', $content)
            ->once()->andReturn(strlen($content));
        $report = new \App\Report($filesystemMock);
        $this->assertSame(6, $report->output());
    }

    public function tearDown()
    {
        // Mockオブジェクトの開放 Mockを利用する際は必ず書く
        Mockery::close();
    }
}