<?php

namespace App\Http\Controllers;

use App\Log;
use Auth;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created Log in storage.
     * saveLogData(input,result,name) is a statically called function inside Log model used for storing log data into db.
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        if ($request->ajax() && isset($request->input) && isset($request->result)) {
            $log = Log::saveLogData($request->input, $request->result, $request->name);
            if ($log !== null) {
                $log->created_at_read = $log->created_at->diffForHumans();
                return ['status' => 1, 'log' => $log->only(['created_at_read', 'input', 'result','log_name'])];
            }
        }
        return ['status' => 0];
    }

}
