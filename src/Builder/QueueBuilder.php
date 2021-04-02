<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Tagaizer\HyperfAmqp\Builder;

class QueueBuilder extends Builder
{
    protected $queue;

    protected $dlxQueue;

    protected $exclusive = false;

    protected $arguments = [
        'x-ha-policy' => ['S', 'all'],
    ];

    public function getQueue(): string
    {
        return $this->queue;
    }

    public function setQueue(string $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    public function getDlxQueue(): string
    {
        return $this->queue;
    }

    public function setDlxQueue(string $dlxQueue): self
    {
        $this->dlxQueue = $dlxQueue;
        return $this;
    }

    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    public function setExclusive(bool $exclusive): self
    {
        $this->exclusive = $exclusive;
        return $this;
    }
}
