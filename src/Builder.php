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
namespace Tagaizer\HyperfAmqp;

use Tagaizer\HyperfAmqp\Message\MessageInterface;
use Tagaizer\HyperfAmqp\Pool\AmqpConnectionPool;
use Tagaizer\HyperfAmqp\Pool\PoolFactory;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use Psr\Container\ContainerInterface;

class Builder
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var PoolFactory
     */
    protected $poolFactory;

    public function __construct(ContainerInterface $container, PoolFactory $poolFactory)
    {
        $this->container = $container;
        $this->poolFactory = $poolFactory;
    }

    /**
     * @throws AMQPProtocolChannelException when the channel operation is failed
     */
    public function declare(MessageInterface $message, ?AMQPChannel $channel = null, bool $release = false): void
    {
        try {
            if (! $channel) {
                $pool = $this->getConnectionPool($message->getPoolName());
                /** @var \Tagaizer\HyperfAmqp\Connection $connection */
                $connection = $pool->get();
                $channel = $connection->getChannel();
            }

            $builder = $message->getExchangeBuilder();

            $channel->exchange_declare($builder->getExchange(), $builder->getType(), $builder->isPassive(), $builder->isDurable(), $builder->isAutoDelete(), $builder->isInternal(), $builder->isNowait(), $builder->getArguments(), $builder->getTicket());
        } finally {
            if (isset($connection) && $release) {
                $connection->release();
            }
        }
    }

    protected function getConnectionPool(string $poolName): AmqpConnectionPool
    {
        return $this->poolFactory->getPool($poolName);
    }
}
