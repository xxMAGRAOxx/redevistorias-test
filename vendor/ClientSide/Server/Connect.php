<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *
 *
 */

namespace ClientSide\Server;

/**
 * Class Connect
 * Nothing to do here for while.
 * @package BBM\Server
 */
class Connect
{
    public $verbose;

    protected $data;

    public $environment;

    public function verbose($status = false)
    {
        $this->verbose = $status;

        if($status)
        {
            echo "<pre>";
            var_dump("VERBOSE ACTIVATED!");
        }
    }

    public function filter($filter)
    {
        if($this->verbose)
            var_dump("FILTER VALIDATION: ", $filter);

        if(!in_array($filter, Config\SysConfig::$ACCEPTED_FILTERS))
            throw new Exception('Filtro nao aceito');

        if($this->verbose)
            var_dump("FILTER ADDED: ", $filter);

        $this->data['filter'] = $filter;
    }

}