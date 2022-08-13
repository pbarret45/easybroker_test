<?php

namespace Src\Property\app\PropertyFindAll;

use Src\Shared\Http\EasyBroker;
use Src\Property\Domain\Property;
use Src\Property\Domain\Operation;
use Src\Property\Domain\Commission;

/** Busca todas las propiedades */
class PropertyFindAll
{
    /** Busca todas las propiedades
     * @param  int $page
     * @param  int $limit
     * @param  array $search
     * @return array
     */
    public function findAll(int $page = 1, int $limit = 20, array $search = []): array
    {
        $search = array(
            "updated_after"=> "2020-03-01T23:26:53.402Z",
            "updated_before"=> "2025-03-01T23:26:53.402Z",
            "operation_type"=> "sale",
            "min_price"=> 500000,
            "max_price"=> 3000000,
            "min_bedrooms"=> 1,
            "min_bathrooms"=> 1,
            "min_parking_spaces"=> 1,
            "min_construction_size"=> 100,
            "max_construction_size"=> 1000,
            "min_lot_size"=> 100,
            "max_lot_size"=> 1000,
            "statuses][" => "published"
        );
        $easybroker = (new EasyBroker(EASYBROKER_API_URL, EASYBROKER_API_KEY))->getAllProperties($page, $limit, $search);
        $propertyList = [];
        $operationList = [];
        foreach ($easybroker->content as $property) {
            foreach ($property->operations as $operation) {
                $operationList[] = new Operation(
                    $operation->type,
                    $operation->amount,
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
                $property->title_image_full,
                $property->title_image_thumb,
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
        return $propertyList;
    }
}
