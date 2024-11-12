<?php
namespace App\Traits;

use Carbon\Carbon;

trait TimeFilterTrait
{

    public function applyTimeFilter($query, $selectDate, $dateColumn = 'created_at')
    {
        switch ($selectDate) {
            case 'today':
                $query->whereDate($dateColumn, Carbon::today());
                break;

            case 'week':
                $query->whereBetween($dateColumn, [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;

            case 'month':
                $query->whereMonth($dateColumn, Carbon::now()->month)
                      ->whereYear($dateColumn, Carbon::now()->year);
                break;

            case 'year':
                $query->whereYear($dateColumn, Carbon::now()->year);
                break;

            case 'all':
            default:
                break;
        }

        return $query;
    }

    public function dateRangeFilter($query,$startDate,$endDate,$dateColumn = 'created_at')
    {
        $query->whereDate($dateColumn,'>=',$startDate)
        ->whereDate($dateColumn,'<=',$endDate);
        
        return $query;

    }


}