<?php

namespace App\Services;

use RdKafka\Producer;
use RdKafka\ProducerTopic;

class KafkaProducer
{
    protected $producer;
    protected $topic;

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
        $this->topic = config('kafka.topic.default');
    }

    
    /**
     * Send a message to the configured Kafka topic
     *
     * @param string $message
     * @return void
     */
    public function send($message)
    {
        $producerTopic = $this->producer->newTopic($this->topic);
        $producerTopic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        $this->producer->flush(10000);
    }
}
