<?php

use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
//use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserServiceTest extends \TestCase
{
//    use DatabaseMigrations;

    /** @var UserService */
    protected $service;

    public function setUp()
    {
        parent::setUp();
//        $user = factory(\App\User::class)->make();
//        $mock = Mockery::mock(new \App\User());
//        $mock->shouldReceive('all')->andReturn(
//            (new Collection())->add($user)
//        );
//        $this->service = new UserService($mock);
        $this->service = new UserService(new \StubUserRepository());
    }

//    public function testDatabaseDependencyUsers()
//    {
//        // モデルファクトリでレコードを挿入します
//        Factory(\App\User::class)->create();
//        $this->assertInstanceOf(Collection::class, $this->service->getUsers());
//    }

    public function testGetUsers()
    {
        $this->assertInstanceOf(Collection::class, $this->service->getUsers());
    }

}

class StubUserRepository implements \App\Repositories\UserRepositoryInterface
{
    /**
     * @return array
     */
    public function all()
    {
        $user = factory(\App\DataAccess\Eloquent\User::class)->make();
        return (new \Illuminate\Database\Eloquent\Collection()) ->add($user);
    }
}