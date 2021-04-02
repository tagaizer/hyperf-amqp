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

use Tagaizer\HyperfAmqp\Listener\BeforeMainServerStartListener;
use Tagaizer\HyperfAmqp\Listener\MainWorkerStartListener;
use Tagaizer\HyperfAmqp\Packer\Packer;
use Hyperf\Utils\Packer\JsonPacker;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Producer::class => Producer::class,
                Packer::class => JsonPacker::class,
                Consumer::class => ConsumerFactory::class,
            ],
            'listeners' => [
                BeforeMainServerStartListener::class => 99,
                MainWorkerStartListener::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for amqp.',
                    'source' => __DIR__ . '/../publish/amqp.php',
                    'destination' => BASE_PATH . '/config/autoload/amqp.php',
                ],
            ],
        ];
    }
}
