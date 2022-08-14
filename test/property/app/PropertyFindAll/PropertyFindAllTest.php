<?php

namespace Test\Property\App\PropertyFindAll;

use PHPUnit\Framework\TestCase;
use Src\Shared\Http\EasyBroker;
use Src\Property\Domain\Property;
use Src\Property\Domain\Operation;
use Src\Property\Domain\Commission;
use Src\Property\domain\Pagination;

/** Busca todas las propiedades */
class PropertyFindAllTest extends TestCase
{
    public function testFindAll(): void
    {
        \define('EASYBROKER_API_URL', "https://api.stagingeb.com/v1/");
        \define('EASYBROKER_API_KEY', "l7u502p8v46ba3ppgvj5y2aad50lb9");
        $easybroker = (new EasyBroker(EASYBROKER_API_URL, EASYBROKER_API_KEY))->getAllProperties(1, 1, [], "");
        $this->assertIsObject($easybroker);
        $this->assertIsArray($easybroker->content);
        $this->assertIsObject($easybroker->pagination);
        $this->assertNotNull($easybroker->pagination->next_page);
        $this->assertTrue(count($easybroker->content) > 0, "Lista de propiedades vacia.");
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
            break;
        }
        $pagination = new Pagination(
            $easybroker->pagination->limit,
            $easybroker->pagination->page,
            $easybroker->pagination->total,
            $easybroker->pagination->next_page,
        );
        $this->assertInstanceOf(Pagination::class, $pagination);
        $this->assertInstanceOf(Property::class, $propertyList[0]);
    }
}
