<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatroomJoinRepository")
 * @ORM\Table(name="Chatroom_Join")
 */
class ChatroomJoin
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="Join_ID")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false, name="Join_Time", options={"default" = 0})
     */
    private $join_time;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="End_Time")
     */
    private $part_time;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="User_ID", referencedColumnName="User_ID", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Chat")
     * @ORM\JoinColumn(name="Chat_ID", referencedColumnName="Chat_ID", nullable=false)
     */
    private $chat;

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
     * Set joinTime.
     *
     * @param \DateTime $joinTime
     *
     * @return ChatroomJoin
     */
    public function setJoinTime($joinTime)
    {
        $this->join_time = $joinTime;

        return $this;
    }

    /**
     * Get joinTime.
     *
     * @return \DateTime
     */
    public function getJoinTime()
    {
        return $this->join_time;
    }

    /**
     * Set partTime.
     *
     * @param \DateTime $partTime
     *
     * @return ChatroomJoin
     */
    public function setPartTime($partTime)
    {
        $this->part_time = $partTime;

        return $this;
    }

    /**
     * Get partTime.
     *
     * @return \DateTime
     */
    public function getPartTime()
    {
        return $this->part_time;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ChatroomJoin
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set chat.
     *
     * @param \AppBundle\Entity\Chat $chat
     *
     * @return ChatroomJoin
     */
    public function setChat(\AppBundle\Entity\Chat $chat)
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
}
