<?php

return [
    'enable' => env('LOG_SLACK_ENABLE', false),
    'webhookUrl' => env('LOG_SLACK_WEBHOOK_URL', ''),
    'projectName' => env('LOG_PROJECT_NAME', ''),
];
