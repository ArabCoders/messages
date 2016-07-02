<?php
/**
 * This file is part of The {@package arabcoders\messages}.
 *
 * (c) 2013-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\messages\Handler;

use \Twig_Environment;
use arabcoders\messages\
{
    Interfaces\HandlerInterface
};

/**
 * Handler: Twig
 *
 * @see    \Twig_Environment
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Twig implements HandlerInterface
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * Constructor.
     *
     * @param Twig_Environment $twig
     * @param string           $template
     * @param array            $options
     */
    public function __construct( Twig_Environment $twig, string $template, array $options = [ ] )
    {
        $this->twig = $twig;

        $this->template = $template;
    }

    public function output( string $title, string $text, array $options = [ ] ): string
    {
        $arr = [
            'TITLE'   => $title,
            'TEXT'    => $text,
            'URL'     => ( !empty( $options['URL'] ) ) ? $options['URL'] : '',
            'TIME'    => ( !empty( $options['TIME'] ) ) ? $options['TIME'] : '',
            'FORWARD' => ( !empty( $options['FORWARD'] ) ) ? $options['FORWARD'] : '',
            'MSGCODE' => ( !empty( $options['MSGCODE'] ) ) ? $options['MSGCODE'] : '',
        ];

        return $this->twig->render( $this->template, $arr );
    }
}