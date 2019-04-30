<?php

namespace Store\Services;

/**
 * @method int size(string $queue = null)
 * @method mixed push(string|object $job, mixed $data = '', $queue = null)
 * @method mixed pushOn(string $queue, string|object $job, mixed $data = '')
 * @method mixed pushRaw(string $payload, string $queue = null, array $options = [])
 * @method mixed later(\DateTimeInterface|\DateInterval|int $delay, string|object $job, mixed $data = '', string $queue = null)
 * @method mixed laterOn(string $queue, \DateTimeInterface|\DateInterval|int $delay, string|object $job, mixed $data = '')
 * @method mixed bulk(array $jobs, mixed $data = '', string $queue = null)
 * @method \Illuminate\Contracts\Queue\Job|null pop(string $queue = null)
 * @method string getConnectionName()
 * @method \Illuminate\Contracts\Queue\Queue setConnectionName(string $name)
 *
 * @see \Illuminate\Queue\QueueManager
 * @see \Illuminate\Queue\Queue
 */
class Queue
{
    public function __call($name, $arguments)
    {
       //
    }
}