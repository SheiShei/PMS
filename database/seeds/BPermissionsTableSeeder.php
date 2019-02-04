<?php

use Illuminate\Database\Seeder;
use App\BPermission;

class BPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tasks
        BPermission::create([
            'name' => 'View',
            'type' => 'task'
        ]);

        BPermission::create([
            'name' => 'Add',
            'type' => 'task'
        ]);

        BPermission::create([
            'name' => 'Modify',
            'type' => 'task'
        ]);

        BPermission::create([
            'name' => 'Delete',
            'type' => 'task'
        ]);

        BPermission::create([
            'name' => 'Comment',
            'type' => 'task'
        ]);


        // lists
        BPermission::create([
            'name' => 'Add',
            'type' => 'list'
        ]);

        BPermission::create([
            'name' => 'Modify',
            'type' => 'list'
        ]);

        BPermission::create([
            'name' => 'Delete',
            'type' => 'list'
        ]);


        // sprints
        BPermission::create([
            'name' => 'View',
            'type' => 'sprint'
        ]);

        BPermission::create([
            'name' => 'Add',
            'type' => 'sprint'
        ]);

        BPermission::create([
            'name' => 'Modify',
            'type' => 'sprint'
        ]);

        BPermission::create([
            'name' => 'Delete',
            'type' => 'sprint'
        ]);

        // user stories
        BPermission::create([
            'name' => 'View',
            'type' => 'us'
        ]);

        BPermission::create([
            'name' => 'Add',
            'type' => 'us'
        ]);

        BPermission::create([
            'name' => 'Modify',
            'type' => 'us'
        ]);

        BPermission::create([
            'name' => 'Delete',
            'type' => 'us'
        ]);
    }
}
