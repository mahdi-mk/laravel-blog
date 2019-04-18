<?php

use Illuminate\Database\Seeder;
use App\User;
use App\article;
use App\category;

/**
 * Create roles and abilities
 */
class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Superadmin can do everything in the blog
        Bouncer::allow('superadmin')->everything();

        // editor can only delete users. he/she can't edit or create
        Bouncer::allow('editor')->to('delete', User::class);
        Bouncer::forbid('editor')->to('edit', User::class);

        // editor can manage articles and categories.
        Bouncer::allow('editor')->toManage(article::class);
        Bouncer::allow('editor')->toManage(category::class);

    }
}
