<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Account\CreateAccountController;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => self::API_COLL_READ
        ],
        'post' => [
            'controller' => CreateAccountController::class,
            'normalization_context' => self::API_ITEM_READ,
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' =>
                                    [
                                        'name' => ['type' => 'string'],
                                    ],
                            ],
                            'example' => [
                                'name' => 'Compte à vue',
                            ],
                        ],
                    ],
                ],
            ],
        ]
    ], itemOperations: [
        'get' => [
            'normalization_context' => self::API_ITEM_READ
        ],
    ]
)]
class Account
{
    const API_ITEM_READ = [
        'groups' => ['Account:read']
    ];

    const API_COLL_READ = [
        'groups' => ['Accounts:read']
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['Account:read', 'Accounts:read'])]
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['Account:read', 'Accounts:read'])]
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="accounts")
     */
    #[Groups(['Account:read'])]
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=AccountLine::class, mappedBy="account")
     */
    #[Groups(['Account:read'])]
    private $accountLines;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->accountLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|AccountLine[]
     */
    public function getAccountLines(): Collection
    {
        return $this->accountLines;
    }

    public function addAccountLine(AccountLine $accountLine): self
    {
        if (!$this->accountLines->contains($accountLine)) {
            $this->accountLines[] = $accountLine;
            $accountLine->setAccount($this);
        }

        return $this;
    }

    public function removeAccountLine(AccountLine $accountLine): self
    {
        if ($this->accountLines->removeElement($accountLine)) {
            // set the owning side to null (unless already changed)
            if ($accountLine->getAccount() === $this) {
                $accountLine->setAccount(null);
            }
        }

        return $this;
    }
}
