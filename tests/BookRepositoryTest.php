<?php

class BookRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \App\Repositories\BookRepository */
    protected $repository;

    protected function setup()
    {
        $this->repository = new \App\Repositories\BookRepository;
    }

    public function testReturnResultBasic()
    {
        $this->assertInternalType('array', $this->repository->getReferenceBooks());

        foreach ($this->repository->getReferenceBooks() as $book) {
            $this->assertArrayHasKey('title', $book);
        }
    }

    public function testReturnBook()
    {
        $result = $this->repository->getReferenceBook(1);
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('id', $result);
        $this->assertNull($this->repository->getReferenceBook(10));
    }

    /**
     * @expectedException \Exception
     */
    public function testReturnBookException()
    {
        $this->repository->getReferenceBook();
    }

    /**
     * @test
     */
    public function 値の返却テスト()
    {
        $this->assertInternalType('array', $this->repository->getReferenceBooks());
    }

    /**
     * @dataProvider addBookData
     * @param array
     */
    public function testSetBooks(array $params)
    {
        $this->repository->setReferenceBook($params);
        $books = $this->repository->getReferenceBooks();
        foreach ($books as $book) {
            $this->assertArrayHasKey('title', $book);
            $this->assertArrayHasKey('id', $book);

        }
    }

    /**
     * 書籍データを追加
     * @return array
     */
    public function addBookData()
    {
        return [
            [
                [
                    'id' => 2,
                    'title' => 'AngularJSリファレンス'
                ],
            ]
        ];
    }

    public function testReturnBookDepend()
    {
        $result = $this->repository->getReferenceBook(1);
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('id', $result);
        $this->assertNull($this->repository->getReferenceBook(10));

        return $result;
    }

    /**
     * @depends testReturnBookDepend
     * @test
     */
    public function 依存を利用したテスト($params)
    {
        $this->assertSame($params['title'], 'Laravelリファレンス');
    }

    /**
     * @test
     */
    public function protectedメソッドに対してフィフレクションを利用したテスト()
    {
        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionMethod = $reflectionClass->getMethod('getText');
        $reflectionMethod->setAccessible(true);
        $this->assertEquals('Laravel5', $reflectionMethod->invoke($this->repository));
    }

    /**
     * @test
     */
    public function protectedメソッドに対してClosureを利用したテスト()
    {
        $value = \Closure::bind(function () {
            $repository = new \App\Repositories\BookRepository;
            return $repository->getText();
        }, null, App\Repositories\BookRepository::class)->__invoke();
        $this->assertEquals('Laravel5', $value);
    }
}