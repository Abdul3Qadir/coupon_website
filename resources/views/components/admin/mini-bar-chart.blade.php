@props(['data', 'height' => 220])
<canvas id="offersChart" data-chart='@json($data)' height="{{ $height }}"></canvas>