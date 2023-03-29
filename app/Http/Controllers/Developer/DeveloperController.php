<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Candidate\Candidate;
use App\Models\Developer\Developer;

class DeveloperController extends Controller
{
    public function index(): array
    {
        set_time_limit(5000);
        $candidates = Candidate::all()->toArray();
        $developers = Developer::all()->toArray();
        $candidateFounded = [];
        foreach($developers as $key => $developer) {
            foreach ($candidates as $candidate) {
                if ($developer['email'] === $candidate['email']) {
                    $candidateFounded[] = $candidate;
                }
            }
            if ( ! empty($candidateFounded) ) {
                $developers[$key] = array_merge($developer, ['candidateId' => reset($candidateFounded)['id']]);
                $candidateFounded = [];
            }
            $candidateFounded = [];
        }
        return $developers;
    }

    public function indexImproved(): array
    {
        $candidates = Candidate::all()->toArray();
        $developers = Developer::all()->toArray();
        $newCandidateArray = [];
        foreach ($candidates as $candidate) {
            $newCandidateArray[$candidate['email']] = $candidate['id'];
        }
        foreach ($developers as &$developer) {
            if (isset($newCandidateArray[$developer['email']])) {
                $developer['candidateId'] = $newCandidateArray[$developer['email']];
            }
        }
        return $developers;
    }
}
