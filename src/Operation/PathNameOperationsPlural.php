<?php
namespace App\Operation;

use ApiPlatform\Metadata\Operation\PathSegmentNameGeneratorInterface;

class PathNameOperationsPlural implements PathSegmentNameGeneratorInterface
{
    /**
     * Transforms a given string to a valid path name which can be pluralized (eg. for collections).
     *
     * @param string $name usually a ResourceMetadata shortname
     *
     * @return string A string that is a part of the route name
     */
public function getSegmentName(string $name, bool $collection = true): string
    {
        $name = $this->dashize($name);

        return $name;
    }

    private function dashize(string $string): string
    {
        return strtolower($string . "s");
    }
}
