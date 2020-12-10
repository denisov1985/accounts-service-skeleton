<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\CreateUserRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\CreateUser;
use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Queries\FindUserById;
use Somnambulist\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Domain\Utils\IdentityGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CreateController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\CreateController
 */
class CreateController extends ApiController
{

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $this->command()->dispatch(
            new CreateUser(
                $id = IdentityGenerator::random(),
                new AccountId($request->get('account_id')),
                $request->get('email'),
                $request->get('password'),
                $request->get('name'),
                $request->getRequest()->request->all('roles'),
                $request->getRequest()->request->all('permissions'),
            )
        );

        return $this->created(
            new ObjectType($this->query()->execute(new FindUserById($id)), UserViewTransformer::class)
        );
    }
}