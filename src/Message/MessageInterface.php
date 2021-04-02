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

use Tagaizer\HyperfAmqp\Builder\ExchangeBuilder;

interface MessageInterface
{
    /**
     * Pool name for amqp.
     */
    public function getPoolName(): string;

    public function setType(string $type);

    public function getType(): string;

    public function setExchange(string $exchange);

    public function getExchange(): string;

    public function setRoutingKey($routingKey);

    public function getRoutingKey():string;

    public function setDlxExchange(string $dlxExchange);

    public function getDlxExchange():string;

    public function setDlxRoutingKey($DlxRoutingKey);

    public function getDlxRoutingKey();

    public function getExchangeBuilder(): ExchangeBuilder;

    /**
     * Serialize the message body to a string.
     */
    public function serialize(): string;

    /**
     * Unserialize the message body.
     */
    public function unserialize(string $data);
}
