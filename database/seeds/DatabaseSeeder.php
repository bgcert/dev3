<?php

use Illuminate\Database\Seeder;

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
        factory('App\User', 10)->create()->each(function ($u) {
        	if ($u->role_id == 2) {
        		$u->company()->save(factory('App\Company')->make());
        	}
	    });

	    factory('App\Theme', 30)->create();
	    factory('App\Event', 50)->create();

	    factory('App\Venue', 40)->create()->each(function ($v) {
	    	for ($i=0; $i < rand(1, 10) ; $i++) { 
	    		$v->venue_images()->save(factory('App\VenueImage')->make());
	    	}
	    });

	    //factory('App\VenueImage', 100)->create();
	    factory('App\Order', 60)->create();
    }
}