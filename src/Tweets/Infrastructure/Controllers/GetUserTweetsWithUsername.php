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

namespace Shoutter\Tweets\Infrastructure\Controllers;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use Shoutter\Common\Infrastructure\Services\QueryBusInterface;
use Shoutter\Tweets\Application\Exceptions\InvalidQueryLimit;
use Shoutter\Tweets\Application\Queries\ShoutTweetsWithUserName;
use Shoutter\Tweets\Infrastructure\Models\ApiTweetView;
use Shoutter\Users\Domain\Exceptions\NotFoundUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

final class GetUserTweetsWithUsername
{
    /** @var QueryBusInterface */
    private $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @throws ValidationException
     * @throws InvalidQueryLimit
     * @throws NotFoundUser
     *
     * @return ApiTweetView[]
     */
    public function __invoke(string $username, Request $request)
    {
        $limit = $request->query->get('limit');

        if ($limit === null) {
            throw new ValidationException(new ConstraintViolationList([
                new ConstraintViolation('This value should not be null.', null, [], null, 'limit', null),
            ]));
        }

        try {
            $tweetViews = $this->queryBus->dispatch(new ShoutTweetsWithUserName($username, (int) $limit));
        } catch (HandlerFailedException $exception) {
            throw $exception->getPrevious();
        }

        return $tweetViews;
    }
}
