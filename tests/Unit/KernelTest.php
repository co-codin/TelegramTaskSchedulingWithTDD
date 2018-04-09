<?php

use Carbon\Carbon;
use App\Scheduler\Event;
use App\Scheduler\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
  /** @test */
  public function can_get_events()
  {
    $kernel = new Kernel;

    $this->assertEquals([], $kernel->getEvents());
  }

  /** @test */
  public function can_add_event()
  {
    $event = $this->getMockForAbstractClass(Event::class);

    $kernel = new Kernel;
    $kernel->add($event);

    $this->assertCount(1, $kernel->getEvents());
  }

  /** @test */
  public function cant_add_event()
  {
    $this->expectException(TypeError::class);

    $kernel = new Kernel;
    $kernel->add('non event');
  }

  /** @test */
  public function can_set_date()
  {
    $kernel = new Kernel;

    $kernel->setDate(Carbon::now());

    $this->assertInstanceOf(Carbon::class, $kernel->getDate());
  }

  /** @test */
  public function has_default_date()
  {
    $kernel = new Kernel;

    $this->assertInstanceOf(Carbon::class, $kernel->getDate());
  }
}