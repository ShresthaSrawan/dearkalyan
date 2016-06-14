<?php

use Illuminate\Database\Seeder;
use App\PostType;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('post_types')->truncate();
    	
        $posttypes = ['Article','Image','Video','Gallery', 'Quote', 'Text'];
        foreach ($posttypes as $type) {
        	$ptype = new PostType;
        	$ptype->name = $type;
        	$ptype->slug = str_slug($type);
        	$ptype->save();
        }
    }
}
