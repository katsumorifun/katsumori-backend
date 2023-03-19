<?php

namespace Tests\Feature\Services\Guard;

use App\Services\Guard\AuthThrottle as Throttle;
use Illuminate\Http\Request;
use \Tests\TestCase;

class AuthThrottleTest extends TestCase
{
    protected Request $request;
    protected Throttle $authThrottle;
    protected int $count = 10;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('auth.throttle.attempt_count', $this->count);
        config()->set('auth.throttle.time_out', 60 * 25);

        $this->request = $this->createMock(Request::class);
        $this->request
            ->expects($this->any())
            ->method('ip')
            ->will($this->returnValue('127.0.0.1'));

        $this->authThrottle = new Throttle($this->request);
    }

    public function test_check_is_true()
    {
        $result = $this->authThrottle->check();

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function test_get_time_out_return_int()
    {
        $time = $this->authThrottle->getTimeOut();

        $this->assertIsInt($time);
    }

    public function test_check_is_false()
    {
        for ($count = 1; $count <= $this->count; $count++ ) {
            $this->authThrottle->addFailCount();
        }

        $result = $this->authThrottle->check();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }


}
