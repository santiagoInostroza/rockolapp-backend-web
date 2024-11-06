<?php

namespace Tests\Unit;

use App\Events\TestEvent;
use PHPUnit\Framework\TestCase;
use Illuminate\Broadcasting\PrivateChannel;

class TestEventTest extends TestCase
{
    public function testBroadcastOn()
    {
        // Crear una instancia del evento
        $event = new TestEvent();

        // Obtener el canal de transmisión
        $channel = $event->broadcastOn();

        // Afirmar que el canal es el esperado
        $this->assertInstanceOf(PrivateChannel::class, $channel);
        $this->assertEquals('testChannel', $channel->name);
    }
}
