<?php

namespace Src\Shared\Http;

use Src\Shared\Http\Http;
use stdClass;

/** Clase que maneja las llamadas del api de EasyBroker */
class EasyBroker extends Http
{    
    /** Obtiene todas las propiedades
     * @param  int $page
     * @param  int $limit
     * @param  array $search
     * @return stdClass
     */
    public function getAllProperties(int $page, int $limit, array $search): stdClass
    {
        $url = \http_build_query(
            array(
                'page' => $page,
                'limit' => $limit,
                'search' => $search
            ),
            ""
        );
        return $this->getApiNew("properties?" . $url);
    }
}
