<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *
 */

namespace ClientSide\Server;

/**
 * Class Exception
 * @package ClientSide\Server
 */
class Exception extends \Exception 
{

    /**
     * @param string $errors
     * @param int    $code
     */
    public function __construct($errors, $code = NULL)
    {
        if(is_array($errors))
            parent::__construct(implode(' - ', $errors), $code);
        else
            parent::__construct($errors, $code);
    }

}