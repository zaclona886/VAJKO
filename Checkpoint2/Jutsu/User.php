<?php

class User
{
    public function __construct(private int $id = 0,private int $jutsu_id = 0, private ?string $name = null)
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getJutsuId(): int
    {
        return $this->jutsu_id;
    }

    /**
     * @param int $jutsu_id
     */
    public function setJutsuId(int $jutsu_id): void
    {
        $this->jutsu_id = $jutsu_id;
    }
}