<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User', 40)->create()->each(function ($u) {
        	if ($u->role_id == 2) {
        		$u->company()->save(factory('App\Company')->make());
        	}
	    });

	    factory('App\Category', 12)->create();

	    factory('App\Theme', 40)->create()->each(function ($t) {
	    	for ($i=0; $i < rand(1, 30); $i++) {
	    		$user_id = \App\User::all()->random()->id;
        		$body = Str::random(32);
        		$t->comment($body, $user_id);
        	}
	    });

	    factory('App\Teacher', 40)->create();

	    factory('App\Event', 70)->create()->each(function ($e) {
	    	for ($i=0; $i < rand(1, 3); $i++) {
	    		$teachers = \App\Teacher::where('company_id', $e->theme->company->id)->get();
	    		if ($teachers->count() > 0) {
	    			$teacher_id = $teachers->random()->id;
	    			$e->teachers()->attach($teacher_id);
	    		}
        	}
	    });

	    factory('App\Venue', 40)->create()->each(function ($v) {
	    	for ($i=0; $i < rand(1, 10) ; $i++) {
	    		$v->venue_images()->save(factory('App\VenueImage')->make());
	    	}

	    	for ($i=0; $i < rand(1, 10) ; $i++) {
	    		$user_id = \App\User::all()->random()->id;
        		$body = Str::random(32);
        		$v->comment($body, $user_id); // Comments should be improved!!!
        	}
	    });

	    //factory('App\VenueImage', 100)->create();
	    factory('App\Order', 60)->create();
	    //factory('App\Comment', 120)->create();
    }
}