<?php

namespace Model\Entity;

class Activity {

    private ?int $id;
    private ?string $category;
    private ?string $type;
    private ?string $name;
    private ?string $description;
    private ?string $location;
    private ?string $email;
    private ?string $phone;
    private ?string $schedules;
    private ?string $link;
    private ?string $image;


    /**
     * @param int|null $id
     * @param string|null $type
     * @param string|null $name
     * @param string|null $description
     * @param string|null $location
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $schedules
     * @param string|null $link
     * @param string|null $image
     */
    public function __construct(
        int $id = null, string $category = null, string $type = null, string $name = null,
        string $description = null, string $location = null, string $email = null,
        string $phone = null, string $schedules = null, string $link = null,
        string $image = null
    ) {
        $this->id = $id;
        $this->category = $category;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->email = $email;
        $this->phone = $phone;
        $this->schedules = $schedules;
        $this->link = $link;
        $this->image = $image;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->id = $category;
    }


    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSchedules(): ?string
    {
        return $this->schedules;
    }

    /**
     * @param string $schedules
     */
    public function setSchedules(string $schedules): void
    {
        $this->schedules = $schedules;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

}
