<?php

namespace ByTIC\FormBuilder\Tests\Consumers\Dto;

use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;
use ByTIC\FormBuilder\Consumers\Dto\ConsumersList;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelFields\ModelFieldsRecords;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelWithFields\ModelWithFieldsRecords;
use Nip\Config\Config;
use PHPUnit\Framework\TestCase;

class ConsumersListTest extends TestCase
{
    public function test_from_config_basic()
    {
        $configArray = [
            'consumer1' => ModelWithFieldsRecords::class,
            'consumer2' => ModelFieldsRecords::class,
        ];
        $config = new Config($configArray);
        $list = ConsumersList::staticFromConfig($config);
        $listAll = $list->all();
        self::assertCount(2, $listAll);

        $first = $listAll['consumer1'];
        self::assertInstanceOf(ConsumerConfig::class, $first);
        self::assertSame('consumer1', $first->getName());
        self::assertSame(ModelWithFieldsRecords::class, $first->getRepositoryClass());
    }

    public function test_from_config_advanced()
    {
        $configArray = [
            'consumer1' => ['repository' => ModelWithFieldsRecords::class],
        ];
        $config = new Config($configArray);
        $list = ConsumersList::staticFromConfig($config);
        $listAll = $list->all();
        self::assertCount(1, $listAll);

        $first = $listAll['consumer1'];
        self::assertInstanceOf(ConsumerConfig::class, $first);
        self::assertSame('consumer1', $first->getName());
        self::assertSame(ModelWithFieldsRecords::class, $first->getRepositoryClass());
    }
}
