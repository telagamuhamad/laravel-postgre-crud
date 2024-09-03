<?php

namespace App\Services;

use RdKafka\Conf;
use RdKafka\Consumer;
use RdKafka\ConsumerConfig;
use RdKafka\ConsumerTopic;

class KafkaConsumer
{
    protected $consumer;
    protected $topic;

    public function __construct()
    {
        $config = new Conf();
        $config->set('metadata.broker.list', config('kafka.brokers'));
        $config->set('group.id', 'your_consumer_group'); // Ganti dengan group id yang sesuai
        
        $this->consumer = new Consumer($config);
        $this->topic = config('kafka.topic.default');
    }

    public function consume()
    {
        $consumerTopic = $this->consumer->newTopic($this->topic);
        $consumerTopic->consumeStart(0, RD_KAFKA_OFFSET_END);
        
        while (true) {
            $message = $consumerTopic->consume(0, 1000);
            if ($message->err) {
                // Handle error
                continue;
            }
            // Process message
            echo $message->payload;
        }
    }
}
