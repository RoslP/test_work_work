<?php

namespace App\Http\Controllers;

use App\Jobs\JobstTestingJob;

class TestJobController extends Controller
{
    public function test()
    {
        JobstTestingJob::dispatch();
    }
}
