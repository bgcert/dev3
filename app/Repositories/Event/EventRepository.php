<?php

namespace App\Repositories\Event;

use App\Event;
use Cache;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class EventRepository implements EventRepositoryInterface
{
	private $event;

	public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function show($id)
    {
    	$key = 'event_' . $id;
    	$result = Cache::remember($key, 60, function () use ($id) {
        	return $this->event->where('id', $id)->with('city', 'teachers', 'theme.company', 'theme.category', 'theme.comments.user')->first();
        });

        return $result;
    }

    public function related($category_id)
    {
    	$key = 'related_events_to_category_' . $category_id;

    	$result = Cache::remember($key, 60, function () use ($category_id) {
		    return $this->event
    				->where('active', 1)
    				->whereDate('start_date', '>', Carbon::today())
    				->whereHas('theme', function ($query) use ($category_id)
                        {
        	               $query->where('category_id', $category_id);
                        }
                    )
    				->with('city', 'theme.category', 'theme.company', 'visitCount')
    				->limit(4)
    				->get();
		});

		return $result;
    }

    public function upcoming()
    {
    	$result = Cache::remember('users', 60, function () {
		    return $this->event->where('active', 1)
    				->whereDate('start_date', '>', Carbon::today())
    				->whereHas('theme')
    				->with('city', 'theme.category', 'theme.company', 'visitCount')
    				->get();
		});

		return $result;
    }

    public function byCompany($company_id)
    {
    	$key = 'events_by_company_' . $company_id;

    	$result = Cache::remember($key, 60, function () use ($company_id){
	    	$themes = \App\Theme::with('category')->where('company_id', $company_id)->get();
			$theme_id_list = $themes->pluck('id')->toArray();

			$events = $this->event
						->where('active', 1)
						->whereDate('start_date', '>', Carbon::today())
						->whereIn('theme_id', $theme_id_list)
						->with('theme')
						->get();

			return $events->groupBy(function($item) {
						return Date::parse($item->start_date)->format('F, Y');
					});
		});

		return $result;
    }

    // Not done!!!
    public function scopeByCategory($query, $slug)
    {
    	$cat = \App\Category::where('slug', $slug)->first();
    	return $query->whereHas('theme', function ($q) use ($cat) {
							    $q->where('category_id', $cat->id);
						});
    }

    public function filtered($city = null, $slug = null, $orderby = null)
    {
    	// If filters not set
    	if ($city == null && $slug == null && $orderby == null) {
    		return $this->upcoming();
    	}

    	// Getting the collection
    	$result = $this->event->where('active', 1)
    				->whereDate('start_date', '>', Carbon::today())
    				->whereHas('theme')
    				->with('city', 'theme.category', 'theme.company', 'visitCount');

    	if ($slug) $result->byCategory($slug);
    	if ($city) $result->where('city_id', $city);

    	if ($orderby) {
    		if ($orderby == 1) $order = 'start_date';
    		if ($orderby == 2) $order = 'price';
    		$result->orderBy($order, 'asc');
    	} else {
    		$result->orderBy('start_date', 'asc');
    	}
    	return $result->get();
    }

    public function popular($query, $id)
    {
    	return $query
    				->where('active', 1)
    				->whereDate('start_date', '>', Carbon::today())
    				// ->whereHas('theme')
    				->whereHas('theme', function ($query) use ($id)
                        {
        	               $query->where('category_id', $id);
                        }
                    )
    				->with('city', 'theme.category', 'theme.company', 'visitCount')
    				->limit(4);
    }
}