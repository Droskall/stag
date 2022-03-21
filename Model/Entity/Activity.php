<?php

namespace Model\Entity;

class Activity {

    private ?int $id;
    private string $type;
    private string $name;
    private string $description;
    private string $locattion;
    private string $email;
    private string $phone;
    private string $schedules;
    private string $link;
    private string $image;


    /**
     * @param string $type
     * @param string $name
     * @param string $description
     * @param string $locattion
     * @param string $email
     * @param string $phone
     * @param string $schedules
     * @param string $link
     * @param string $image
     */
    public function __construct(string $type, string $name, string $description, string $locattion, string $email,
                                string $phone, string $schedules, string $link, string $image, int $id) {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->locattion = $locattion;
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
     * @return string
     */
    public function getType(): string
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
    public function getName(): string
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
    public function getDescription(): string
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
    public function getLocattion(): string
    {
        return $this->locattion;
    }

    /**
     * @param string $locattion
     */
    public function setLocattion(string $locattion): void
    {
        $this->locattion = $locattion;
    }

    /**
     * @return string
     */
    public function getEmail(): string
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
    public function getPhone(): string
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
    public function getSchedules(): string
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
    public function getLink(): string
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
    public function getImage(): string
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
