<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thor\Process\Dispatcher;

final class DispatcherTest extends TestCase
{

    function testInstance(): void
    {
        $dispatcher = new Dispatcher();
        $this->assertInstanceOf(Dispatcher::class, $dispatcher);
    }

    function testTrigger(): void
    {
        $dispatcher = new Dispatcher();
        $isTrue = false;
        $dispatcher->on('start', function () use (&$isTrue) {
            $isTrue = true;
        });
        $dispatcher->trigger('start');
        $this->assertTrue($isTrue);
    }

    function testLoop(): void
    {
        $dispatcher = new Dispatcher();
        $loop = 10;
        $count = 4;
        $dispatcher->on('start', function () use (&$count) {
            $count = 0;
        });
        $dispatcher->on('loop', function () use (&$count) {
            $count++;
        });
        $test = fn ($a, $b) => $this->assertSame($a, $b);
        $dispatcher->on('end', function () use ($test, &$count, $loop) {
            $test($loop, $count);
        });

        $dispatcher->trigger('start');
        for ($i = 0 ; $i < $loop ; $i++) {
            $dispatcher->trigger('loop');
        }
        $dispatcher->trigger('end');
    }

}
