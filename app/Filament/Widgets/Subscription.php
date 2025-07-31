<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Blog; // ✅ make sure this is your actual model name
use Filament\Widgets\ChartWidget;

class Subscription extends ChartWidget
{
    protected static ?string $heading = 'Blog Posts per Month';
public function getColumnSpan(): int|string|array
{
    return 12;
}


    protected function getData(): array
    {
        $now = Carbon::now();
        $postsPerMonth = [];

        // Generate post count for each month
        for ($month = 1; $month <= 12; $month++) {
            $count = Blog::whereYear('created_at', $now->year)
                         ->whereMonth('created_at', $month)
                         ->count();
            $postsPerMonth[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Blog Posts Created',
                    'data' => $postsPerMonth,
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // You can also use 'bar' or 'pie'
    }
}
