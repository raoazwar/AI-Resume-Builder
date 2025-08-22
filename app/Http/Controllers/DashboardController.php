<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();
        
        // Get real statistics
        $stats = $this->getDashboardStats($user);
        
        return Inertia::render('Dashboard', [
            'stats' => $stats
        ]);
    }
    
    private function getDashboardStats($user): array
    {
        $resumes = $user->resumes;
        
        // Calculate total resumes
        $totalResumes = $resumes->count();
        
        // Calculate AI optimized (for now, we'll consider resumes with analysis as optimized)
        // This can be enhanced later with actual AI optimization tracking
        $aiOptimized = $resumes->where('updated_at', '>', now()->subDays(7))->count();
        
        // Calculate total views from actual view records
        $totalViews = $resumes->sum(function($resume) {
            return $resume->views()->count();
        });
        
        // Calculate average score based on resume analysis
        $averageScore = $this->calculateAverageScore($resumes);
        
        // Get recent activity
        $recentActivity = $this->getRecentActivity($resumes);
        
        // Get template usage statistics
        $templateUsage = $this->getTemplateUsage($resumes);
        
        return [
            'totalResumes' => $totalResumes,
            'aiOptimized' => $aiOptimized,
            'totalViews' => $totalViews,
            'averageScore' => $averageScore,
            'recentActivity' => $recentActivity,
            'templateUsage' => $templateUsage,
            'lastUpdated' => $resumes->max('updated_at') ? $resumes->max('updated_at')->diffForHumans() : 'Never'
        ];
    }
    
    private function calculateAverageScore($resumes): int
    {
        if ($resumes->isEmpty()) {
            return 0;
        }
        
        $totalScore = 0;
        $resumeCount = 0;
        
        foreach ($resumes as $resume) {
            $analysis = $this->analyzeResume($resume);
            $totalScore += $analysis['overall_rating'];
            $resumeCount++;
        }
        
        return $resumeCount > 0 ? round($totalScore / $resumeCount) : 0;
    }
    
    private function analyzeResume($resume): array
    {
        $analysis = [
            'completeness_score' => 0,
            'keyword_optimization' => 0,
            'grammar_score' => 0,
            'overall_rating' => 0,
            'recommendations' => []
        ];
        
        // Calculate completeness score
        $totalFields = 0;
        $filledFields = 0;
        
        // Personal info - ensure it's an array
        $personalInfo = is_array($resume->personal_info) ? $resume->personal_info : [];
        $personalFields = ['full_name', 'email', 'phone', 'location', 'summary'];
        $totalFields += count($personalFields);
        $filledFields += count(array_filter($personalInfo, fn($value) => !empty($value)));
        
        // Education - ensure it's an array and has elements
        if (is_array($resume->education) && !empty($resume->education) && isset($resume->education[0])) {
            $totalFields += 4; // degree, institution, graduation_year, gpa
            $educationFirst = is_array($resume->education[0]) ? $resume->education[0] : [];
            $filledFields += count(array_filter($educationFirst, fn($value) => !empty($value)));
        }
        
        // Experience - ensure it's an array and has elements
        if (is_array($resume->experience) && !empty($resume->experience) && isset($resume->experience[0])) {
            $totalFields += 5; // job_title, company, start_date, end_date, description
            $experienceFirst = is_array($resume->experience[0]) ? $resume->experience[0] : [];
            $filledFields += count(array_filter($experienceFirst, fn($value) => !empty($value)));
        }
        
        // Skills - ensure it's an array and has elements
        if (is_array($resume->skills) && !empty($resume->skills) && isset($resume->skills[0])) {
            $totalFields += 2; // name, level
            $skillsFirst = is_array($resume->skills[0]) ? $resume->skills[0] : [];
            $filledFields += count(array_filter($skillsFirst, fn($value) => !empty($value)));
        }
        
        $analysis['completeness_score'] = $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;
        
        // Calculate overall rating
        $analysis['overall_rating'] = round($analysis['completeness_score'] * 0.7 + 30); // Base score + completeness
        
        return $analysis;
    }
    
    private function getRecentActivity($resumes): array
    {
        $activities = [];
        
        foreach ($resumes->take(5) as $resume) {
            $activities[] = [
                'id' => $resume->id,
                'action' => $resume->updated_at->diffInHours(now()) < 24 ? 'Resume Updated' : 'Resume Created',
                'resume_title' => $resume->title,
                'time_ago' => $resume->updated_at->diffForHumans()
            ];
        }
        
        return $activities;
    }
    
    private function getTemplateUsage($resumes): array
    {
        $templateCounts = $resumes->groupBy('template')->map->count();
        $totalResumes = $resumes->count();
        
        $usage = [];
        foreach ($templateCounts as $template => $count) {
            $usage[] = [
                'name' => ucfirst($template),
                'percentage' => $totalResumes > 0 ? round(($count / $totalResumes) * 100) : 0
            ];
        }
        
        // Sort by percentage descending
        usort($usage, fn($a, $b) => $b['percentage'] - $a['percentage']);
        
        return $usage;
    }
}
