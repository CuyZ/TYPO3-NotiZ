<?php

/*
 * Copyright (C) 2017
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

namespace CuyZ\Notiz\Definition\Tree\EventGroup\Event\Connection;

use CuyZ\Notiz\Event\Runner\EventRunner;

interface Connection
{
    const TYPE_SIGNAL = Signal::class;
    const TYPE_HOOK = Hook::class;

    /**
     * Registers the event connection.
     *
     * @param EventRunner $eventRunner
     * @return void
     */
    public function register(EventRunner $eventRunner);
}
