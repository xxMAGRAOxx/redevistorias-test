<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *
 */

namespace ClientSide;

use ClientSide\Server\Config\SysConfig;
use ClientSide\Server\Connect;
use ClientSide\Server\Exception;

/**
 * Class Movies
 * @package magrao-swapi
 */
class Movies extends Connect
{
    /**
     *
     * @return bool
     * @throws Exception
     */

    /**
     *
     * @return String
     * @throws Exception
     */
    public function get()
    {
        $request = new Server\Request(Server\Config\SysConfig::$BASE_CONNECT_URI . SysConfig::$BASE_MOVIES, $this->verbose);

        $request->create();

        // $request->setPost($this->data);

        try
        {
            $request->execute();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode());
        }

        return $request->getResponse();
    }

}