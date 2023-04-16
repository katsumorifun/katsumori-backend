<?php

namespace Tests\Unit\Services\Guard;

use App\Services\Guard\AuthThrottle;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthThrottleTest extends TestCase
{
    protected Request|MockObject $requestMock;
    protected AuthThrottle $authThrottle;
    protected CacheRepository|MockObject $cacheMock;
    protected int $timeOut = 10 * 25;
    protected int $attemptCount = 13;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMocks();

        $this->authThrottle = new AuthThrottle($this->requestMock);
        $this->authThrottle->setAttemptCount($this->attemptCount);
        $this->authThrottle->setTimeOut($this->timeOut);
    }

    protected function createMocks()
    {
        $this->requestMock = $this->createMock(Request::class);

        $this->cacheMock = $this->createMock(CacheRepository::class);

        app()->instance('cache.store', $this->cacheMock);
    }

    public function test_check_empty_user()
    {
        $this->requestMock
            ->expects($this->any())
            ->method('ip')
            ->will($this->returnValue('127.0.0.1'));

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->with('AuthThrottle:127.0.0.1')
            ->willReturn(false);

        $result = $this->authThrottle->check();

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function test_check_block_user()
    {
        $this->requestMock
            ->expects($this->once())
            ->method('ip')
            ->willReturn('127.0.0.1');

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->with('AuthThrottle:127.0.0.1')
            ->willReturn(true);

        $this->cacheMock
            ->expects($this->exactly(2))
            ->method('get')
            ->willReturn(time() - $this->timeOut);

        $result = $this->authThrottle->check();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function test_check_unlocked_user()
    {
        $this->requestMock
            ->expects($this->exactly(1))
            ->method('ip')
            ->willReturn('127.0.0.1');

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->with('AuthThrottle:127.0.0.1')
            ->willReturn(true);

        $this->cacheMock
            ->expects($this->exactly(2))
            ->method('get')
            ->willReturn(time() + $this->timeOut);

        $result = $this->authThrottle->check();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function test_add_fail_count_null_cache()
    {
        $this->requestMock
            ->expects($this->once())
            ->method('ip')
            ->willReturn('127.0.0.1');

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->willReturn(false);

        $this->cacheMock
            ->expects($this->exactly(2))
            ->method('put')
            ->willReturn(false);

        $this->authThrottle->addFailCount();
    }

    public function test_add_fail_count_is_cache()
    {
        $this->requestMock
            ->expects($this->once())
            ->method('ip')
            ->willReturn('127.0.0.1');

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->with('AuthThrottle:127.0.0.1')
            ->willReturn(true);

        $this->cacheMock
            ->expects($this->once())
            ->method('increment')
            ->with('AuthThrottle:127.0.0.1');

        $this->authThrottle->addFailCount();
    }

    public function test_set_time_out()
    {
        $this->requestMock
            ->expects($this->once())
            ->method('ip')
            ->willReturn('127.0.0.1');

        $this->cacheMock
            ->expects($this->once())
            ->method('has')
            ->with('AuthThrottle:127.0.0.1')
            ->willReturn(true);

        $this->cacheMock
            ->expects($this->once())
            ->method('get')
            ->with('AuthThrottle:127.0.0.1:TimeOut')
            ->willReturn(true);

        $this->authThrottle->getTimeOut();
    }
}
