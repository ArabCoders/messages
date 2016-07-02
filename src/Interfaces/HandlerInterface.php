<?php
/**
 * This file is part of The {@package arabcoders\messages}.
 *
 * (c) 2013-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\messages\Interfaces;

/**
 * Handler Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface HandlerInterface
{
    /**
     * Output message.
     *
     * @param string $title
     * @param string $text
     * @param array  $options
     *
     * @return string
     */
    public function output( string $title, string $text, array $options = [ ] ): string;
}