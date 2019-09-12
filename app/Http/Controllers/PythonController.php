<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PythonController extends Controller
{
    public function getData()
    {
        $macAddresses = [];
        // sudo runuser -l pi -c 'sudo arp-scan -l'
        $process = new Process([ 'sudo', 'arp-scan', '--interface=wlan0', '--localnet' ]);
        $process->run();
        
        if ( !$process->isSuccessful() ) {
            throw new ProcessFailedException($process);
        }
        $output = (string)$process->getOutput();
        
        $test = explode(PHP_EOL, $output);
        dd($output);
    	$exploded = explode('\n', $output);
        for($i = 0; $i < count($exploded); $i++) {
            $exploded[$i] = explode(' [', explode(' at ', $exploded[ $i ])[ 1 ]);
            $macAddresses[$i] = $exploded[$i][0];
        }
        dd($output);
    }
}
