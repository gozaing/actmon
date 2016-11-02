<?php

class DummyTest extends TestCase
{
    public function testDummy()
    {
        $user = factory(\App\DataAccess\Eloquent\User::class)->make();
        $this->assertInternalType('array', $user->toArray());
    }

    public function testDummyNameSpecified()
    {
        $user = factory(\App\DataAccess\Eloquent\User::class)->make(['name' => 'Laravel5']);
        $this->assertSame('Laravel5', $user->name);
    }
}