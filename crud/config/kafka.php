<?php

return [
    'brokers' => env('KAFKA_BROKERS', 'localhost:9092'),
    'topic' => [
        'default' => 'default_topic',
    ],
];
