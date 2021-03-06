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

namespace CuyZ\Notiz\Domain\Channel\Slack;

use CuyZ\Notiz\Core\Channel\AbstractChannel;
use CuyZ\Notiz\Domain\Notification\Slack\Application\EntitySlack\Service\EntitySlackBotMapper;
use CuyZ\Notiz\Domain\Notification\Slack\Application\EntitySlack\Service\EntitySlackChannelMapper;
use CuyZ\Notiz\Domain\Notification\Slack\Application\EntitySlack\Service\EntitySlackMessageBuilder;
use CuyZ\Notiz\Domain\Notification\Slack\SlackNotification;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Typo3SlackChannel extends AbstractChannel
{
    /**
     * @var array
     */
    protected static $supportedNotifications = [
        SlackNotification::class,
    ];

    /**
     * @var EntitySlackMessageBuilder
     */
    protected $messageBuilder;

    /**
     * @var EntitySlackBotMapper
     */
    protected $botMapper;

    /**
     * @var EntitySlackChannelMapper
     */
    protected $channelMapper;

    /**
     * @var SlackNotification
     */
    protected $notification;

    /**
     * Manual dependency injection.
     */
    final protected function initialize()
    {
        $this->messageBuilder = $this->objectManager->get(
            EntitySlackMessageBuilder::class,
            $this->payload
        );

        $this->botMapper = $this->objectManager->get(
            EntitySlackBotMapper::class,
            $this->payload
        );

        $this->channelMapper = $this->objectManager->get(
            EntitySlackChannelMapper::class,
            $this->payload
        );

        $this->notification = $this->payload->getNotification();
    }

    /**
     * Send the Slack notification.
     */
    protected function process()
    {
        $bot = $this->botMapper->getBot();
        $channels = $this->channelMapper->getChannels();

        foreach ($channels as $channel) {
            $webhookUrl = $channel->getWebhookUrl();

            $iconKey = $bot->hasEmojiAvatar()
                ? 'icon_emoji'
                : 'icon_url';

            $data = [
                'channel' => $channel->getTarget(),
                'text' => $this->messageBuilder->getMessage(),
                'username' => $bot->getName(),
                $iconKey => $bot->getAvatar(),
            ];

            $this->callSlack($webhookUrl, $data);
        }
    }

    /**
     * @param string $webhookUrl
     * @param array $data
     */
    protected function callSlack(string $webhookUrl, array $data)
    {
        /** @var RequestFactory $factory */
        $factory = GeneralUtility::makeInstance(RequestFactory::class);

        $data = json_encode($data);

        $factory->request(
            $webhookUrl,
            'POST',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen($data),
                ],
                'body' => $data,
            ]
        );
    }
}
