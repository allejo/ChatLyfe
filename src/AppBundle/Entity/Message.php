<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 * @ORM\Table(name="Message")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="Msg_ID")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false, name="Message")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=false, name="Timestamp")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="smallint", nullable=false, name="Status", options={"default" = 1})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="Author_ID", referencedColumnName="User_ID", nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Chat", inversedBy="messages")
     * @ORM\JoinColumn(name="Chat_ID", referencedColumnName="Chat_ID")
     */
    private $chat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DirectMessage", inversedBy="messages")
     * @ORM\JoinColumn(name="Direct_Message_ID", referencedColumnName="Msg_ID")
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
     * @param \AppBundle\Entity\Chat $chat
     *
     * @return Message
     */
    public function setChat(\AppBundle\Entity\Chat $chat = null)
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * Get chat.
     *
     * @return \AppBundle\Entity\Chat
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
