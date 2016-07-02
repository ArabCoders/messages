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
 * Compatible Interface for {@see arabcoders\messages\Message}
 *
 * @package    arabcoders\messages
 * @author     Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface MessageInterface
{
    /**
     * Class Constructor
     *
     * @param HandlerInterface $handler
     * @param array            $options
     *
     */
    public function __construct( HandlerInterface $handler, array $options = [ ] );

    /**
     * Set Message text
     *
     * @param string $message
     * @param array  $options
     *
     * @return MessageInterface
     */
    public function setMessage( string $message, array $options = [ ] ): MessageInterface;

    /**
     * Set Message Title
     *
     * @param string $title
     * @param array  $options
     *
     * @return MessageInterface
     */
    public function setTitle( string $title, array $options = [ ] ):MessageInterface;

    /**
     * Set Message Code Number.
     *
     * @param string|int $code
     * @param array      $options
     *
     * @return MessageInterface
     */
    public function setCodeNumber( $code, array $options = [ ] ): MessageInterface;

    /**
     * Set Message Forward Link
     *
     * @param string $url
     * @param array  $options
     *
     * @return MessageInterface
     */
    public function setUrl( string $url, array $options = [ ] ): MessageInterface;

    /**
     * Set Message Forward Time
     *
     * @param int   $time in secounds.
     * @param array $options
     *
     * @return MessageInterface
     */
    public function setTime( int $time, array $options = [ ] ): MessageInterface;

    /**
     * set 404 Header
     *
     * @param array $options
     *
     * @return MessageInterface
     */
    public function setNotFound( array $options = [ ] ): MessageInterface;

    /**
     * set 302 Header
     *
     * @param array $options
     *
     * @return MessageInterface
     */
    public function setMovedTemp( array $options = [ ] ): MessageInterface;

    /**
     * set 404 Header
     *
     * @param array $options
     *
     * @return MessageInterface
     */
    public function setMovedPerm( array $options = [ ] ): MessageInterface;

    /**
     * set Header
     *
     * @param int    $code
     * @param string $text
     * @param array  $options
     *
     * @return MessageInterface
     */
    public function setHeader( int $code, string $text, array $options = [ ] ): MessageInterface;

    /**
     * Redirect
     *
     * @param string $url
     * @param array  $options
     *
     * @return void
     */
    public function redirect( $url, array $options = [ ] );

    /**
     * Output message
     *
     * @param array $options
     *
     * @return string
     */
    public function output( array $options = [ ] ): string;
}