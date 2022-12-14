<?php

namespace Src\Property\App\PropertyFindAll;

use Src\Shared\Http\EasyBroker;
use Src\Property\Domain\Property;
use Src\Property\Domain\Operation;
use Src\Property\Domain\Commission;
use Src\Property\domain\Pagination;
use stdClass;

/** Busca todas las propiedades */
class PropertyFindAll
{
    /** Busca todas las propiedades
     * @param  int $page
     * @param  int $limit
     * @param  array $search
     * @param  string $nextPage
     * @return stdClass
     */
    public function findAll(int $page = 1, int $limit = 20, array $search = [], string $nextPage = ""): stdClass
    {
        $easybroker = (new EasyBroker(EASYBROKER_API_URL, EASYBROKER_API_KEY))->getAllProperties($page, $limit, $search, $nextPage);
        $propertyList = [];
        $operationList = [];
        foreach ($easybroker->content as $property) {
            foreach ($property->operations as $operation) {
                $operationList[] = new Operation(
                    $operation->type,
                    $operation->amount ?? null,
                    $operation->formatted_amount,
                    $operation->currency,
                    $operation->unit ?? null,
                    $operation->period ?? null,
                    new Commission(
                        $operation->commission->type,
                        $operation->commission->value ?? null,
                        $operation->commission->currency ?? null,
                    )
                );
            }
            $propertyList[] = new Property(
                $property->agent,
                $property->public_id,
                $property->title,
                $property->title_image_full ?? "",
                $property->title_image_thumb ?? "",
                $property->bedrooms,
                $property->bathrooms,
                $property->parking_spaces,
                $property->location,
                $property->property_type,
                $property->updated_at,
                $property->show_prices,
                $property->share_commission,
                $property->construction_size,
                $operationList
            );
        }
        $pagination = new Pagination(
            $easybroker->pagination->limit,
            $easybroker->pagination->page,
            $easybroker->pagination->total,
            $easybroker->pagination->next_page,
        );
        $response = new stdClass();
        $response->pagination = $pagination;
        $response->propertyList = $propertyList;
        return $response;
    }
}
