<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Technology;
// use Illuminate\Support\Facades\DB;
use App\Models\Type;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        // DB::table('projects')->truncate();

        $types = Type::all();

        $type_ids = $types->pluck('id')->all();

        //versione contratta (vedi su per versione con 2 passaggi per $types_ids)
        $technology_ids = Technology::all()->pluck('id')->all();
        
        for($i = 0; $i < 10; $i++){
            $new_project = new Project();

            $name_project = $faker->sentence(5);

            $new_project->name_project = $name_project;
            $new_project->slug = Str::slug($name_project);
            $new_project->url_github = $faker->url();
            $new_project->description = $faker->text(400);
            $new_project->type_id = $faker->optional()->randomElement($type_ids);

            $new_project->save();

            
            $random_tech_ids = $faker->randomElements($technology_ids, null);
            $new_project->technologies()->attach($random_tech_ids);
        }



    }
}
