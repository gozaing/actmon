<?php

class PostDummyTest extends \TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testDummy()
    {
        factory(\App\Post::class, 5)->create();
        $this->assertEquals(5, \App\Post::all()->count());
    }

    public function testRelationRecord()
    {
        factory(App\User::class)
            ->create()
            ->each(function($u) {
                $u->posts()->save(factory(\App\Post::class)->create([
                    'title' => 'aaa',
                    'body' => 'bbb'
                ]));
            });

        $this->assertEquals(2, \App\Post::all()->count());

    }

}