<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPpM2m9J\appAppKernelProdContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPpM2m9J/appAppKernelProdContainer.php') {
    touch(__DIR__.'/ContainerPpM2m9J.legacy');

    return;
}

if (!\class_exists(appAppKernelProdContainer::class, false)) {
    \class_alias(\ContainerPpM2m9J\appAppKernelProdContainer::class, appAppKernelProdContainer::class, false);
}

return new \ContainerPpM2m9J\appAppKernelProdContainer([
    'container.build_hash' => 'PpM2m9J',
    'container.build_id' => '54a2d921',
    'container.build_time' => 1681747869,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPpM2m9J');