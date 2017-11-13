<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DirectMessageRepository")
 * @ORM\Table(name="Direct_Message")
 */
class DirectMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="Msg_ID")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="direct_message")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="User_A", referencedColumnName="User_ID", nullable=false)
     */
    private $user_a;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="User_B", referencedColumnName="User_ID", nullable=false)
     */
    private $user_b;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add message.
     *
     * @param \AppBundle\Entity\Message $message
     *
     * @return DirectMessage
     */
    public function addMessage(\AppBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message.
     *
     * @param \AppBundle\Entity\Message $message
     */
    public function removeMessage(\AppBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set userA.
     *
     * @param \AppBundle\Entity\User $userA
     *
     * @return DirectMessage
     */
    public function setUserA(\AppBundle\Entity\User $userA)
    {
        $this->user_a = $userA;

        return $this;
    }

    /**
     * Get userA.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserA()
    {
        return $this->user_a;
    }

    /**
     * Set userB.
     *
     * @param \AppBundle\Entity\User $userB
     *
     * @return DirectMessage
     */
    public function setUserB(\AppBundle\Entity\User $userB)
    {
        $this->user_b = $userB;

        return $this;
    }

    /**
     * Get userB.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserB()
    {
        return $this->user_b;
    }
}
