<?php
declare(strict_types=1);

/*
 * Copyright (C)
 * Nathan Boiron <nathan.boiron@gmail.com>
 * Romain Canon <romain.hydrocanon@gmail.com>
 *
 * This file is part of the TYPO3 NotiZ project.
 * It is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License, either
 * version 3 of the License, or any later version.
 *
 * For the full copyright and license information, see:
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace CuyZ\Notiz\Core\Exception;

class DuplicateEntryException extends NotizException
{
    const PROPERTY_ENTRY_DUPLICATION = 'The property `%s` for the event `%s` already has the entry named `%s`.';

    const TAG_SERVICE_IDENTIFIER_DUPLICATION = 'The identifier `%s` is already used by the property `%s` (trying to assign it to the property `%s`).';

    const SLOT_CONTAINER_DUPLICATION = 'A slot with the identifier `%s` was already added to the container.';

    const MARKER_ALREADY_DEFINED = 'Trying to override an existing marker named `%s` to the slot `%s`.';

    /**
     * @param string $name
     * @param string $eventClassName
     * @param string $propertyType
     * @return self
     */
    public static function propertyEntryDuplication(string $name, string $eventClassName, string $propertyType): self
    {
        return self::makeNewInstance(
            self::PROPERTY_ENTRY_DUPLICATION,
            1504104622,
            [$propertyType, $eventClassName, $name]
        );
    }

    /**
     * @param string $identifier
     * @param string $propertyType
     * @param string $assignedPropertyType
     * @return self
     */
    public static function tagServiceIdentifierDuplication(string $identifier, string $propertyType, string $assignedPropertyType): self
    {
        return self::makeNewInstance(
            self::TAG_SERVICE_IDENTIFIER_DUPLICATION,
            1504168501,
            [$identifier, $propertyType, $assignedPropertyType]
        );
    }

    /**
     * @param string $name
     * @return self
     */
    public static function slotContainerDuplication(string $name): self
    {
        return self::makeNewInstance(
            self::SLOT_CONTAINER_DUPLICATION,
            1517344431,
            [$name]
        );
    }

    /**
     * @param string $marker
     * @param string $slot
     * @return self
     */
    public static function markerAlreadyDefined(string $marker, string $slot): self
    {
        return self::makeNewInstance(
            self::MARKER_ALREADY_DEFINED,
            1517410553,
            [$marker, $slot]
        );
    }
}
