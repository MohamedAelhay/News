<?php

use App\Folder;
use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (factory(Folder::class, 3)->create() as $folder)
        {
            $folder->uploads()->createMany([
                [
                    'name' => $folder->name . ' image',
                    'description' => $folder->description,
                    'path'=>'public/staff/kotNIgklO1bfaWIAP0QCpaBIhWQlDbS0o28HQB1k.jpeg',
                    'type'=>'image'
                ],[
                    'name' => $folder->name . ' video',
                    'description' => $folder->description,
                    'path'=>'public/staff/kotNIgklO1bfaWIAP0QCpaBIhWQlDbS0o28HQB1k.jpeg',
                    'type'=>'video'
                ],[
                    'name' => $folder->name . ' doc',
                    'description' => $folder->description,
                    'path'=>'public/staff/kotNIgklO1bfaWIAP0QCpaBIhWQlDbS0o28HQB1k.jpeg',
                    'type'=>'document'
                ]
            ]);
        };
    }
}
