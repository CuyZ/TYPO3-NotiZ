<?php
declare(strict_types=1);

/*
 * Copyright (C) 2020
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

use CuyZ\Notiz\Core\Definition\DefinitionService;

class InvalidDefinitionException extends NotizException
{
    const DEFINITION_ERROR_NO_ACCESS = 'The definition contains errors, it is not accessible. Please use method `%s::getValidationResult()`.';

    /**
     * @return self
     */
    public static function definitionErrorNoAccess(): self
    {
        return self::makeNewInstance(
            self::DEFINITION_ERROR_NO_ACCESS,
            1503854245,
            [DefinitionService::class]
        );
    }
}
