<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-03-23
 * Time: 22:04
 */

namespace PhilKra\Schema;


use PhilKra\Exception\Generator\SchemaFileNotFoundException;
use Swaggest\JsonSchema\RemoteRefProvider;

class RefProvider implements RemoteRefProvider
{

    /**
     * @param string $url
     * @return \stdClass|false json_decode of $url resource content
     */
    public function getSchemaData($url)
    {
        $urlParts = array_reverse(explode('/', $url));
        $pathParts = [];
        do {
            // There is a typo in the 'context.json' id ref from the source repo
            if ($urlParts[0] === 'doc') {
                $urlParts[0] = 'docs';
            }

            $pathParts[] = array_shift($urlParts);
            $file = implode('/', array_reverse($pathParts));

            if (file_exists($file)) {
                break;
            }
        } while (!empty($urlParts));

        if (!file_exists($file)) {
            throw new SchemaFileNotFoundException($url);
        }

        return json_decode(file_get_contents($file));
    }
}