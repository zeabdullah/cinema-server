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

/**
 * Returns a tuple of 2 strings of comma-separated values:
 * 1. keys of `$dataAssoc` array
 * 2. a string of adjacent placeholder `?` symbols, for SQL statement params
 * @param array $dataAssoc
 * @return string[] `[string, string]` tuple
 */
function getJoinedSqlStrings(array $dataAssoc)
{
    $joinedCols = implode(',', array_keys($dataAssoc));
    $joinedValuePlaceholders = implode(',', array_fill(0, count($dataAssoc), '?'));

    return [$joinedCols, $joinedValuePlaceholders];
}