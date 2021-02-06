<?php declare(strict_types=1);

namespace App\Accounts\Domain\Commands;

use Somnambulist\Components\Domain\Commands\AbstractCommand;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class CreateAccount
 *
 * @package    App\Accounts\Domain\Commands
 * @subpackage App\Accounts\Domain\Commands\CreateAccount
 */
class CreateAccount extends AbstractCommand
{

    private Uuid   $id;
    private string $name;

    public function __construct(Uuid $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
