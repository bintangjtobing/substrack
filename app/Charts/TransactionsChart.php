<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\ChartJs\Chart;

class TransactionsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Build the chart.
     *
     * @return void
     */
    public function build()
    {
        $this->options([
            'responsive' => true,
        ]);

        $this->labels($mergedData->pluck('date'))
            ->dataset('Sales', 'line', $mergedData->pluck('sales')->toArray())
            ->dataset('Purchases', 'line', $mergedData->pluck('purchases')->toArray());
    }
}
