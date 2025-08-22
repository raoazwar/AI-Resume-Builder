<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Notifications\ResumeCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class ResumeController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    public function index(): Response
    {
        $resumes = Auth::user()->resumes()->latest()->get();
        
        return Inertia::render('Resumes/Index', [
            'resumes' => $resumes
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Resumes/Create');
    }

    public function store(Request $request)
    {
        // Debug: Log the incoming request data
        Log::info('Resume creation request received:', [
            'method' => $request->method(),
            'url' => $request->url(),
            'user_agent' => $request->userAgent(),
            'is_inertia' => $request->header('X-Inertia'),
            'skills' => $request->input('skills'),
            'skills_type' => gettype($request->input('skills')),
            'all_data' => $request->all()
        ]);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'template' => 'required|string|in:modern,minimalist,corporate,creative',
            'personal_info' => 'required|array',
            'personal_info.full_name' => 'required|string|max:255',
            'personal_info.email' => 'required|email|max:255',
            'personal_info.phone' => 'required|string|max:20',
            'personal_info.location' => 'required|string|max:255',
            'personal_info.linkedin' => 'nullable|url|max:255',
            'personal_info.website' => 'nullable|url|max:255',
            'personal_info.summary' => 'nullable|string',
            'education' => 'required|array',
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.field' => 'required|string|max:255',
            'education.*.graduation_date' => 'required|string|max:10',
            'education.*.gpa' => 'nullable|string|max:10',
            'experience' => 'required|array',
            'experience.*.company' => 'required|string|max:255',
            'experience.*.title' => 'required|string|max:255',
            'experience.*.start_date' => 'required|string|max:10',
            'experience.*.end_date' => 'required|string|max:10',
            'experience.*.description' => 'required|string',
            'skills' => 'required|array',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.level' => 'required|string|in:beginner,intermediate,advanced,expert',
            'certifications' => 'nullable|array',
            'social_links' => 'nullable|array',
            'additional_sections' => 'nullable|array',
        ]);

        // Debug: Log the validated data
        Log::info('Resume creation validated:', [
            'skills' => $validated['skills'],
            'skills_type' => gettype($validated['skills'])
        ]);

        // Filter out empty skills before saving
        if (isset($validated['skills']) && is_array($validated['skills'])) {
            $validated['skills'] = array_filter($validated['skills'], function($skill) {
                return is_array($skill) && !empty($skill['name']) && !empty($skill['level']);
            });
        }

        // Debug: Log the filtered skills
        Log::info('Skills after filtering:', [
            'filtered_skills' => $validated['skills']
        ]);

        // Debug: Check if user is authenticated and has the relationship
        Log::info('User info:', [
            'user_id' => Auth::id(),
            'user_exists' => Auth::check(),
            'user_has_resumes_relationship' => method_exists(Auth::user(), 'resumes')
        ]);

        try {
            $resume = Auth::user()->resumes()->create($validated);
            Log::info('Resume created successfully:', [
                'resume_id' => $resume->id,
                'resume_title' => $resume->title
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating resume:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }

        // Send notification (temporarily commented out to debug)
        try {
            Auth::user()->notify(new ResumeCreatedNotification($resume));
        } catch (\Exception $e) {
            Log::error('Error sending notification:', [
                'error' => $e->getMessage()
            ]);
            // Don't fail the resume creation if notification fails
        }

        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return redirect()->route('resumes.show', $resume)->with('success', 'Resume created successfully!');
        }

        // Return JSON for API requests
        return response()->json([
            'message' => 'Resume created successfully',
            'resume' => $resume
        ], 201);
    }

    public function show(Resume $resume): Response
    {
        $this->authorize('view', $resume);
        
        // Track the view
        $this->trackResumeView($resume);
        
        return Inertia::render('Resumes/Show', [
            'resume' => $resume
        ]);
    }

    public function edit(Resume $resume): Response
    {
        $this->authorize('update', $resume);
        
        return Inertia::render('Resumes/Edit', [
            'resume' => $resume
        ]);
    }

    public function update(Request $request, Resume $resume)
    {
        $this->authorize('update', $resume);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'template' => 'required|string|in:modern,minimalist,corporate,creative',
            'personal_info' => 'required|array',
            'personal_info.full_name' => 'required|string|max:255',
            'personal_info.email' => 'required|email|max:255',
            'personal_info.phone' => 'required|string|max:20',
            'personal_info.location' => 'required|string|max:255',
            'personal_info.linkedin' => 'nullable|url|max:255',
            'personal_info.website' => 'nullable|url|max:255',
            'personal_info.summary' => 'nullable|string',
            'education' => 'required|array',
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.field' => 'required|string|max:255',
            'education.*.graduation_date' => 'required|string|max:10',
            'education.*.gpa' => 'nullable|string|max:10',
            'experience' => 'required|array',
            'experience.*.company' => 'required|string|max:255',
            'experience.*.title' => 'required|string|max:255',
            'experience.*.start_date' => 'required|string|max:10',
            'experience.*.end_date' => 'required|string|max:10',
            'experience.*.description' => 'required|string',
            'skills' => 'required|array',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.level' => 'required|string|in:beginner,intermediate,advanced,expert',
            'certifications' => 'nullable|array',
            'social_links' => 'nullable|array',
            'additional_sections' => 'nullable|array',
        ]);

        // Filter out empty skills before updating
        if (isset($validated['skills']) && is_array($validated['skills'])) {
            $validated['skills'] = array_filter($validated['skills'], function($skill) {
                return is_array($skill) && !empty($skill['name']) && !empty($skill['level']);
            });
        }

        $resume->update($validated);

        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return redirect()->route('resumes.show', $resume)->with('success', 'Resume updated successfully!');
        }

        // Return JSON for API requests
        return response()->json([
            'message' => 'Resume updated successfully',
            'resume' => $resume
        ]);
    }

    public function destroy(Resume $resume, Request $request)
    {
        $this->authorize('delete', $resume);
        
        $resume->delete();

        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully!');
        }

        // Return JSON for API requests
        return response()->json([
            'message' => 'Resume deleted successfully'
        ]);
    }

    public function export(Resume $resume, Request $request)
    {
        $this->authorize('view', $resume);
        
        $format = $request->get('format', 'pdf');
        
        if ($format === 'pdf') {
            return $this->exportAsPdf($resume);
        }
        
        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return back()->with('error', "Export format {$format} not supported yet");
        }
        
        return response()->json([
            'message' => "Export format {$format} not supported yet",
            'download_url' => '#'
        ], 400);
    }
    
    private function exportAsPdf(Resume $resume)
    {
        // Debug: Log the skills data to see what's actually stored
        \Log::info('Resume skills data:', [
            'resume_id' => $resume->id,
            'skills' => $resume->skills,
            'skills_type' => gettype($resume->skills),
            'skills_count' => is_array($resume->skills) ? count($resume->skills) : 'not array'
        ]);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('resumes.pdf', compact('resume'));
        
        return $pdf->download($resume->title . '_resume.pdf');
    }

    public function optimize(Resume $resume, Request $request)
    {
        $this->authorize('update', $resume);
        
        $type = $request->input('type', 'general');
        
        // AI optimization suggestions (placeholder for now)
        $suggestions = $this->generateAISuggestions($resume, $type);
        
        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return back()->with('suggestions', $suggestions)->with('type', $type);
        }
        
        return response()->json([
            'message' => 'AI optimization suggestions generated successfully!',
            'suggestions' => $suggestions,
            'type' => $type
        ]);
    }

    public function analyze(Resume $resume, Request $request)
    {
        $this->authorize('view', $resume);
        
        $analysis = $this->analyzeResume($resume);
        
        // Check if this is an Inertia request
        if ($request->header('X-Inertia')) {
            return back()->with('analysis', $analysis);
        }
        
        return response()->json([
            'message' => 'Resume analysis completed successfully!',
            'analysis' => $analysis
        ]);
    }

    private function generateAISuggestions(Resume $resume, string $type): array
    {
        // Placeholder for AI integration
        $suggestions = [];
        
        switch ($type) {
            case 'keywords':
                $suggestions = [
                    'Add industry-specific keywords like: "agile methodology", "project management", "data analysis"',
                    'Include action verbs: "developed", "implemented", "managed", "optimized"',
                    'Add technical skills relevant to your target role'
                ];
                break;
            case 'grammar':
                $suggestions = [
                    'Check for consistent verb tense usage',
                    'Ensure proper punctuation in bullet points',
                    'Review sentence structure for clarity'
                ];
                break;
            case 'tone':
                $suggestions = [
                    'Use more confident and assertive language',
                    'Quantify achievements with specific numbers',
                    'Focus on results rather than just responsibilities'
                ];
                break;
            default:
                $suggestions = [
                    'Review overall content structure',
                    'Ensure all sections are properly filled',
                    'Check for consistency in formatting'
                ];
        }
        
        return $suggestions;
    }

    private function analyzeResume(Resume $resume): array
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
        
        // Generate recommendations
        if ($analysis['completeness_score'] < 80) {
            $analysis['recommendations'][] = 'Complete all required fields to improve your resume score';
        }
        if (empty($resume->skills) || count($resume->skills) < 3) {
            $analysis['recommendations'][] = 'Add more skills to showcase your capabilities';
        }
        if (empty($resume->experience)) {
            $analysis['recommendations'][] = 'Include work experience to demonstrate your professional background';
        }
        
        return $analysis;
    }
    
    private function trackResumeView(Resume $resume): void
    {
        $resume->views()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_at' => now(),
        ]);
    }
}
