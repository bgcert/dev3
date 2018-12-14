<?php

namespace App\Repositories\Event;

interface EventRepositoryInterface
{
	public function show($id);
	public function upcoming();
	public function filtered($city, $slug, $orderby);
	public function related($category_id);
	public function byCompany($company_id);
}