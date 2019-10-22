<?php

/*
 * This file is part of the Shoutter package.
 *
 * (c) Victor Monserrat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Shoutter\Tweets\Infrastructure\Models;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Shoutter\Tweets\Application\Models\TweetView;
use Shoutter\Tweets\Infrastructure\Controllers\GetUserTweetsWithUsername;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName="Tweet",
 *     attributes={"pagination_enabled"=false},
 *     normalizationContext={"groups"={"tweet:read"}},
 *     denormalizationContext={"groups"={"tweet:write"}},
 *     collectionOperations={
 *         "get",
 *         "get_with_username"={
 *             "method"="GET",
 *             "path"="/users/{username}/tweets",
 *             "controller"=GetUserTweetsWithUsername::class,
 *             "openapi_context"={
 *                 "parameters"={
 *                     {"in"="path", "name"="username", "required"=true, "schema"={"type"="string"}},
 *                     {"in"="query", "name"="limit", "description"="The number of items to return [1, 10]", "required"=true, "schema"={"type"="integer", "minimum"=1, "maximum"=10, "default"=10}},
 *                 },
 *             },
 *             "defaults"={"_api_receive"=false},
 *         },
 *     },
 *     itemOperations={"get"},
 * )
 */
final class ApiTweetView extends TweetView
{
    /**
     * @var string
     *
     * @Groups({"tweet:read"})
     * @ApiProperty(identifier=true)
     */
    public $id;

    /**
     * @var string
     *
     * @Assert\NotNull
     * @Groups({"tweet:read", "tweet:write"})
     * @ApiProperty
     */
    public $content;

    public static function with(string $id, string $content): TweetView
    {
        $view = new self();
        $view->id = $id;
        $view->content = $content;

        return $view;
    }
}
