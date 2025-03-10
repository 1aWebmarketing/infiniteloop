<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Item;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@email.de',
            'is_admin' => 1,
            'password' => bcrypt('password')
        ]);

        $adfinity = Project::create([
            'name' => 'adfinity',
            'logo' => 'projects/adfinity.png',
            'user_id' => $user->id,
            'description' => 'adfinity is a web application that allows users to create social ads for platforms like Facebook and Instagram.',
        ]);

        $item = Item::create([
            'title' => 'Item #1',
            'story' => '<h2 dir="auto">Beschreibung (Haupt User Story):</h2>
                <p dir="auto">[WAS WILLST DU MACHEN UM WAS ZU ERREICHEN?]</p>
                <h2 dir="auto">Akzeptanzkriterien:</h2>
                <p dir="auto">[WAS MUSS ERFOLGREICH PASSIEREN, DAMIT DIESE USER STORY ABGESCHLOSSEN WERDEN KANN]</p>
                <h2 dir="auto">Zus&auml;tzliche Informationen oder Abh&auml;ngigkeiten:</h2>
                <p>[MEHR INFORMATIONEN]</p>
                <h2 dir="auto">Vorgeschlagene Priorit&auml;t</h2>
                <p dir="auto">[NIEDRIG, MITTEL, HOCH]</p>',
            'project_id' => $adfinity->id,
            'user_id' => $user->id,
            'voting' => 2,
            'type' => 'FEATURE',
        ]);

        Comment::create([
            'item_id' => $item->id,
            'user_id' => $user->id,
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ]);

        $brian = Project::create([
            'name' => 'BRIAN',
            'logo' => '',
            'user_id' => $user->id,
            'description' => 'The software BRIAN for Deutsche Fachpflege Holding GmbH is an application that currently consists of two modules (LocationManagement and GoodsManagement) and a CRM that is currently under development.',
        ]);

        Item::create([
            'title' => 'Item #1',
            'story' => '<h2 dir="auto">Beschreibung (Haupt User Story):</h2>
                <p dir="auto">[WAS WILLST DU MACHEN UM WAS ZU ERREICHEN?]</p>
                <h2 dir="auto">Akzeptanzkriterien:</h2>
                <p dir="auto">[WAS MUSS ERFOLGREICH PASSIEREN, DAMIT DIESE USER STORY ABGESCHLOSSEN WERDEN KANN]</p>
                <h2 dir="auto">Zus&auml;tzliche Informationen oder Abh&auml;ngigkeiten:</h2>
                <p>[MEHR INFORMATIONEN]</p>
                <h2 dir="auto">Vorgeschlagene Priorit&auml;t</h2>
                <p dir="auto">[NIEDRIG, MITTEL, HOCH]</p>',
            'project_id' => $brian->id,
            'user_id' => $user->id,
            'voting' => 2,
            'type' => 'BUG',
        ]);

    }
}
