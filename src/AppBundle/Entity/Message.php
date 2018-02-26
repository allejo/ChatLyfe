<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 * @ORM\Table()
 */
class Message
{
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
    private $chat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DirectMessage", inversedBy="messages")
     * @ORM\JoinColumn(name="direct_message_id", referencedColumnName="id")
     */
    private $direct_message;

    public function __construct()
    {
        $this->status = 1;
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
     * @param \AppBundle\Entity\Channel $chat
     *
     * @return Message
     */
    public function setChat(\AppBundle\Entity\Channel $chat = null)
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * Get chat.
     *
     * @return \AppBundle\Entity\Channel
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * Set directMessage.
     *
     * @param \AppBundle\Entity\DirectMessage $directMessage
     *
     * @return Message
     */
    public function setDirectMessage(\AppBundle\Entity\DirectMessage $directMessage = null)
    {
        $this->direct_message = $directMessage;

        return $this;
    }

    /**
     * Get directMessage.
     *
     * @return \AppBundle\Entity\DirectMessage
     */
    public function getDirectMessage()
    {
        return $this->direct_message;
    }
}
