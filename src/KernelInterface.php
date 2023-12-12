<?php

namespace Thor\Process;

use Thor\Common\Configuration\Configuration;

/**
 * Defines a Thor Kernel.
 *
 * @package          Thor
 * @copyright (2023) Sébastien Geldreich
 * @license          MIT
 */
interface KernelInterface extends Executable
{

    /**
     * This static function MUST return a new KernelInterface with specified configuration.
     *
     * The implementation is responsible on how the $config array is used.
     *
     * @param Configuration $config
     *
     * @return static
     */
    public static function createFromConfiguration(Configuration $config): static;

}
