<?php

if (!function_exists('build_time_range')) {
    function build_time_range($start = '08:00', $duration = 8, $step = 30){
        $expression = (string) 'PT' . $step . 'M';

        if($duration <= 0){
            return false;
        }

        $pre_setup = new \DateTime($start);
        $outputStart = $pre_setup->sub(new DateInterval($expression));
        $times = ($duration * (60 / $step)); // 24 hours * 30 mins in an hour
        for ($i = 0; $i < $times; $i++) {
            $result[] = $outputStart->add(new \DateInterval($expression))->format('H:i');
        }
        return $result;
    }
}
