<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKxVoJBb\appAppKernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKxVoJBb/appAppKernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKxVoJBb.legacy');

    return;
}

if (!\class_exists(appAppKernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKxVoJBb\appAppKernelDevDebugContainer::class, appAppKernelDevDebugContainer::class, false);
}

return new \ContainerKxVoJBb\appAppKernelDevDebugContainer([
    'container.build_hash' => 'KxVoJBb',
    'container.build_id' => 'afcf4c42',
    'container.build_time' => 1682674925,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKxVoJBb');
