<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatRepository")
 * @ORM\Table(name="Chat")
 */
class Chat
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="Chat_ID")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="Chat_Topic")
     */
    private $topic;

    /**
     * @ORM\Column(type="smallint", length=2, nullable=false, name="Status", options={"default" = 1, "unsigned" = true})
     */
    private $status;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set topic.
     *
     * @param string $topic
     *
     * @return Chat
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic.
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Chat
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}
