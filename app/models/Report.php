<?php

class Report {


	public function showMonthReport($table, $field)
	{
		$month = DB::table($table)
					->select(DB::raw('COUNT(id) as number, DAY(' . $field . ') as dateField'))
					
					->where(function($querySplit) use ($table) {
						
						if ($table == 'users')
						{
							$querySplit->where('users.role_id', 3);
						}

					})						
					
					->where(DB::raw('month(' . $field . ')'), '=', date('m'))
					->groupBy(DB::raw('day(' . $field . ')'))
					->get();

		return $this->transformToString($month, 'days');
	} 	
	
	public function showYearReport($table, $field)
	{
		$year = DB::table($table)
					->select(DB::raw('COUNT(id) as number, MONTH(' . $field . ') as dateField'))
					->where(DB::raw('year(' . $field . ')'), '=', date('Y'))
					->groupBy(DB::raw('month(' . $field . ')'))
					->get();

		return $this->transformToString($year, 'months');
	}	
	
	public function transformToString($values, $period)
	{
		$axis = 12;
		
		if ($period == 'days')
		{
			$axis = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		}

		$data = array_fill(1, $axis, 0);
		
		foreach ($values as $v)
		{
			$data[$v->dateField] = $v->number;
		}

		return "'" . implode("', '" , $data) . "'";
	}
	

	public function showDays()
	{
		return implode(", ", range(0, cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))));
	}	

	public function showMonths()
	{
		$months = array(
			trans('translate.january'),
			trans('translate.february'),
			trans('translate.march'),
			trans('translate.april'),
			trans('translate.may'),
			trans('translate.june'),
			trans('translate.july'),
			trans('translate.august'),
			trans('translate.september'),
			trans('translate.cctober'),
			trans('translate.november'),
			trans('translate.december')
		);
		
		return "'" . implode("', '" , $months) . "'";
	}
	
}