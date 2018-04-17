<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 * @ORM\Table()
 */
class Message
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_PENDING = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $timestamp;

    /**
     * @ORM\Column(type="smallint", nullable=false, options={"default" = 1})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Channel", inversedBy="messages")
     * @ORM\JoinColumn(name="chat_id", referencedColumnName="id")
     */
    private $channel;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="direct_message_id", referencedColumnName="id")
     */
    private $direct_message;

    public function __construct()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->timestamp = new \DateTime();
    }

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
     * Set message.
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set timestamp.
     *
     * @param \DateTime $timestamp
     *
     * @return Message
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp.
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Message
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

    /**
     * Set author.
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Message
     */
    public function setAuthor(\AppBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set chat.
     *
     * @param \AppBundle\Entity\Channel $channel
     *
     * @return Message
     */
    public function setChannel(\AppBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get chat.
     *
     * @return \AppBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set directMessage.
     *
     * @param \AppBundle\Entity\User $directMessage
     *
     * @return Message
     */
    public function setDirectMessage(\AppBundle\Entity\User $directMessage = null)
    {
        $this->direct_message = $directMessage;

        return $this;
    }

    /**
     * Get directMessage.
     *
     * @return \AppBundle\Entity\User
     */
    public function getDirectMessage()
    {
        return $this->direct_message;
    }
}
