<?php

function sanitize(string $input): string
{
    return htmlspecialchars(trim($input));
}

function getRequestBodyAsJson(): mixed
{
    return json_decode(file_get_contents('php://input'));
}

function propertiesExist(object $object, array $properties): bool
{
    foreach ($properties as $prop) {
        if (!property_exists($object, $prop)) {
            return false;
        }
    }
    // if it never returned false, that means all properties exist on the object
    return true;
}