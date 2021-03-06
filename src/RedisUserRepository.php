<?php

namespace S25\Auth;


use Illuminate\Cache\RedisStore;
use Psr\SimpleCache\InvalidArgumentException;

class RedisUserRepository implements UserRepositoryInterface
{
    /** @var RedisStore */
    private $redis;

    private const TTL = 60 * 60;

    public function __construct(RedisStore $redis)
    {
        $this->redis = $redis;
    }

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     */
    public function find(string $id): ?User
    {
        return $this->redis->get($id);
    }

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     */
    public function save(User $user): void
    {
        $this->redis->put($user->getAuthIdentifier(), $user, self::TTL);
    }

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     */
    public function remove(string $id): void
    {
        $this->redis->put($id, null, 0);
    }
}
