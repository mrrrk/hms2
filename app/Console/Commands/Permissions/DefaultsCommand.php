<?php

namespace App\Console\Commands\Permissions;

use HMS\Entities\Role;
use Illuminate\Console\Command;
use HMS\Repositories\RoleRepository;
use Illuminate\Support\Facades\Artisan;
use Doctrine\ORM\EntityManagerInterface;
use LaravelDoctrine\ACL\Permissions\Permission;

class DefaultsCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:defaults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restores roles and permissions to the default set. You should probably run migrations beforehand and the seeder afterwards';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * The permissions to set up
     * @var array
     */
    private $permissions = [];

    private $roles = [];

    public function __construct(EntityManagerInterface $entityManager, RoleRepository $roleRepository)
    {
        parent::__construct($entityManager, $roleRepository);

        $permissions = config('roles.permissions');

        foreach ($permissions as $permission) {
             $this->permissions[$permission] = '';
        }

        $this->roles = config('roles.roles');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Artisan::call('doctrine:migrations:refresh');
        // $this->info('Database reset and migrations run');

        $this->createPermissionEntities();
        $this->info('Permissions created');

        $this->createRoles();
        $this->info('Roles created');

        $this->entityManager->flush();

        // Artisan::call('db:seed');
        // $this->info('Database seeded');
    }

    /**
     * Creates permissions based on array
     * @return void
     */
    private function createPermissionEntities()
    {
        foreach ($this->permissions as $permission => &$entity) {
            $entity = new Permission($permission);
            $this->entityManager->persist($entity);
        }
    }

    /**
     * Creates roles and assigns permissions
     * @return void
     */
    private function createRoles()
    {
        foreach ($this->roles as $roleName => $role) {
            $roleEntity = new Role($roleName, $role['name'], $role['description']);
            if (count($role['permissions']) == 1 and $role['permissions'][0] == '*') {
                foreach ($this->permissions as $permission) {
                    $roleEntity->addPermission($permission);
                }
            } else {
                foreach ($role['permissions'] as $permission) {
                    $roleEntity->addPermission($this->permissions[$permission]);
                }
            }
            $this->entityManager->persist($roleEntity);
            unset($roleEntity);
        }
    }
}
