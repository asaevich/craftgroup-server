<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Migration extends AbstractMigration
{
    public function change(): void
    {
        $users = $this->table('users');
        $users->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('photo', 'mediumblob')
            ->addColumn('key', 'uuid')
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['key'], ['unique' => true])
            ->create();
    }
}
