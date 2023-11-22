<?php

return [
    'definitions' => [
        \app\domain\image\domain\IImages::class => \app\domain\image\infrastructure\ImagesRepository::class,
        \app\domain\image\domain\IImageProvider::class => \app\domain\image\infrastructure\PicsumImageProvider::class,
        \app\domain\image\presentation\AdminGuard::class => function() {
            return new \app\domain\image\presentation\AdminGuard(getenv('ADMIN_TOKEN'));
        },
    ]
];
