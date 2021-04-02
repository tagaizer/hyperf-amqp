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
namespace Tagaizer\HyperfAmqp\Message;

use Tagaizer\HyperfAmqp\Builder\QueueBuilder;

interface RpcMessageInterface extends MessageInterface
{
    public function getQueueBuilder(): QueueBuilder;
}
