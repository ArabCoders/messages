<?php
/**
 * This file is part of The {@package arabcoders\messages}.
 *
 * (c) 2013-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\messages;

use arabcoders\messages\
{
    Interfaces\HandlerInterface,
    Interfaces\MessageInterface
};

/**
 * This class Handles informational messages &
 * redirection, it can triggers HTTP response codes.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Message implements MessageInterface
{
    /**
     * @var HandlerInterface Instance
     */
    protected $handler;

    /**
     * @var array language phrases.
     */
    protected $lang = [
        'FORWARD' => 'Click <a href="%s">here</a> if you are not forwarded in few secounds',
        'INFO'    => 'Information',
        'ERROR'   => 'Error',
    ];

    /**
     * @var string title
     */
    protected $title = 'INFO';

    /**
     * @var string text
     */
    protected $message;

    /**
     * @var string url
     */
    protected $url;

    /**
     * @var string|int
     */
    protected $codeNumber;

    /**
     * @var string forward text.
     */
    protected $forwardText;

    /**
     * @var int forward in.
     */
    protected $time = 10;

    /**
     * @var array http protocal code
     */
    protected $header = [ ];

    public function __construct( HandlerInterface $handler, array $options = [ ] )
    {
        $this->handler = $handler;

        if ( array_key_exists( 'translate', $options ) && is_callable( $options['translate'] ) )
        {
            foreach ( $this->lang as $key => $value )
            {

                $this->lang[$key] = $options['translate']( $key, $value );
            }
        }
    }

    public function setMessage( string $message, array $options = [ ] ): MessageInterface
    {
        $this->message = $message;

        return $this;
    }

    public function setTitle( string $title, array $options = [ ] ): MessageInterface
    {
        $this->title = $title;

        return $this;
    }

    public function setCodeNumber( $code, array $options = [ ] ): MessageInterface
    {
        $this->codeNumber = $code;

        return $this;
    }

    public function setUrl( string $url, array $options = [ ] ): MessageInterface
    {
        $this->url = $url;

        $this->forwardText = sprintf( $this->lang['FORWARD'], $url );

        return $this;
    }

    public function setTime( int $time, array $options = [ ] ): MessageInterface
    {
        $this->time = $time;

        return $this;
    }

    public function setNotFound( array $options = [ ] ): MessageInterface
    {
        return $this->setHeader( 404, 'Not Found' );
    }

    public function setMovedTemp( array $options = [ ] ): MessageInterface
    {
        return $this->setHeader( 302, 'Moved Temporary' );
    }

    public function setMovedPerm( array $options = [ ] ): MessageInterface
    {
        return $this->setHeader( 301, 'Moved Permanently' );
    }

    public function setHeader( int $code, string $text, array $options = [ ] ): MessageInterface
    {
        $this->header = [
            'code' => $code,
            'text' => $text
        ];

        return $this;
    }

    public function redirect( $url, array $options = [ ] )
    {
        if ( !headers_sent() )
        {
            header( sprintf( 'Location: %s', $url ) );
        }
        else
        {
            echo sprintf( '<meta http-equiv="refresh" content="%d; url=%s">', 0, $url );
        }

        exit;
    }

    public function output( array $options = [ ] ): string
    {
        if ( !empty( $this->header ) && !headers_sent() )
        {
            header( $_SERVER['SERVER_PROTOCOL'] . ' ' . $this->header['code'] . ' ' . $this->header['text'] );
        }

        $defaults = [
            'URL'     => $this->url,
            'TIME'    => $this->time,
            'MSGCODE' => $this->codeNumber,
            'FORWARD' => ( $this->url ) ? sprintf( $this->lang['FORWARD'], $this->url ) : '',
        ];

        $options = array_merge_recursive( $defaults, $options );

        return $this->handler->output( $this->title, $this->message, $options );
    }
}