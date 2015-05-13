<?php
//so accidentally interpreted question as "how many sundays occured between given dates? woops..."

/*print_r(['31 day month 1900']);
print_r([newMonthStartDay(1,1,1900)]);
print_r([newMonthStartDay(1,2,1900)]);
print_r([newMonthStartDay(1,3,1900)]);
print_r([newMonthStartDay(1,4,1900)]);
print_r([newMonthStartDay(1,5,1900)]);
print_r([newMonthStartDay(1,6,1900)]);

print_r(['28 day month 1900']);
print_r([newMonthStartDay(2,1,1900)]);
print_r([newMonthStartDay(2,2,1900)]);
print_r([newMonthStartDay(2,3,1900)]);
print_r([newMonthStartDay(2,4,1900)]);
print_r([newMonthStartDay(2,5,1900)]);
print_r([newMonthStartDay(2,6,1900)]);

print_r(['28 day month 1901']);
print_r([newMonthStartDay(2,1,1901)]);
print_r([newMonthStartDay(2,2,1901)]);
print_r([newMonthStartDay(2,3,1901)]);
print_r([newMonthStartDay(2,4,1901)]);
print_r([newMonthStartDay(2,5,1901)]);
print_r([newMonthStartDay(2,6,1901)]);

print_r(['30 day month 1900']);
print_r([newMonthStartDay(4,1,1900)]);
print_r([newMonthStartDay(4,2,1900)]);
print_r([newMonthStartDay(4,3,1900)]);
print_r([newMonthStartDay(4,4,1900)]);
print_r([newMonthStartDay(4,5,1900)]);
print_r([newMonthStartDay(4,6,1900)]);

print_r(['29 day month 2000']);
print_r([newMonthStartDay(2,1,2000)]);
print_r([newMonthStartDay(2,2,2000)]);
print_r([newMonthStartDay(2,3,2000)]);
print_r([newMonthStartDay(2,4,2000)]);
print_r([newMonthStartDay(2,5,2000)]);
print_r([newMonthStartDay(2,6,2000)]);
*/

/*print_r([getSundayCount(1,1,1900)]);
print_r([getSundayCount(2,1,1900)]);
print_r([getSundayCount(3,1,1900)]);
print_r([getSundayCount(4,1,1900)]);
print_r([getSundayCount(5,1,1900)]);
print_r([getSundayCount(6,1,1900)]);
print_r([getSundayCount(7,1,1900)]);
print_r([getSundayCount(8,1,1900)]);
print_r([getSundayCount(9,1,1900)]);
print_r([getSundayCount(10,1,1900)]);
print_r([getSundayCount(11,1,1900)]);
print_r([getSundayCount(12,1,1900)]);

print_r([getSundayCount(1,5,1900)]);
print_r([getSundayCount(2,5,1900)]);
print_r([getSundayCount(3,5,1900)]);
print_r([getSundayCount(4,5,1900)]);
print_r([getSundayCount(5,5,1900)]);
print_r([getSundayCount(6,5,1900)]);
print_r([getSundayCount(7,5,1900)]);
print_r([getSundayCount(8,5,1900)]);
print_r([getSundayCount(9,5,1900)]);
print_r([getSundayCount(10,5,1900)]);
print_r([getSundayCount(11,5,1900)]);
print_r([getSundayCount(12,5,1900)]);
*/
// day corresponds to weekday
// 0 = Sun
// 1 = Mon
// 2 = Tues
// 3 = Weds
// 4 = Thurs
// 5 = Fri
// 6 = Sat
$day = 2; 
$count = 0;

for ($year = 1901; $year <= 2000; $year++) {
	for ($month = 1; $month <= 12; $month++) {
		$count += $day === 0 ? 1 : 0;
		$day = newMonthStartDay($month, $day, $year);
	}
}

print_r(['this many sundays: ', $count]);

function getWeekday($day)
{
	switch ($day) {
		case 0:
			return 'Sunday';
			break;
		case 1:
			return 'Monday';
			break;
		case 2:
			return 'Tuesday';
			break;
		case 3:
			return 'Wednesday';
			break;
		case 4:
			return 'Thursday';
			break;
		case 5:
			return 'Friday';
			break;
		case 6:
			return 'Saturday';
			break;
	}
}

function getMonth($month)
{
	switch ($month) {
	case 1:
		return 'Jan';
		break;
	case 2:
		return 'Feb';
		break;
	case 3:
		return 'Mar';
		break;
	case 4:
		return 'Apr';
		break;
	case 5:
		return 'May';
		break;
	case 6:
		return 'Jun';
		break;
	case 7:
		return 'Jul';
		break;
	case 8:
		return 'Aug';
		break;
	case 9:
		return 'Sep';
		break;
	case 10:
		return 'Oct';
		break;
	case 11:
		return 'Nov';
		break;
	case 12:
		return 'Dec';
		break;
	}
}

function newMonthStartDay($month, $day, $year)
{
	return (dayCount($month, $year)+$day)%7;
}

function getSundayCount($month, $day, $year)
{
	$daysInMonth = dayCount($month, $year);

		if (($day === 5 && $daysInMonth === 31) || 
			(($day === 6) && ($daysInMonth === 30 || $daysInMonth === 31)) ||
			(($day === 0) && ($daysInMonth === 29 || $daysInMonth === 30 || $daysInMonth === 31))
		) {
			return 5;
		} else {
			return 4;
		} 
}

function dayCount($month, $year)
{
	switch ($month) {
	case 1:
	case 3:
	case 5:
	case 7:
	case 8:
	case 10:
	case 12:
		return 31;
		break;
	case 4:
	case 6:
	case 9:
	case 11:
		return 30;
		break;
	case 2:
		if ($year % 4 === 0) {
			if ($year % 100 === 0) {
				return $year % 400 === 0 ? 29 : 28;
			} 

			return 29;
		}

		return 28;
		break;
	}
}
