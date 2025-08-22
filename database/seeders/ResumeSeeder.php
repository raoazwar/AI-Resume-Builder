<?php

namespace Database\Seeders;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
        
        // Create sample resumes
        $resumes = [
            [
                'title' => 'Software Developer Resume',
                'template' => 'modern',
                'personal_info' => [
                    'full_name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'phone' => '+1-555-0123',
                    'location' => 'San Francisco, CA',
                    'summary' => 'Experienced software developer with 5+ years in web development.'
                ],
                'education' => [
                    [
                        'degree' => 'Bachelor of Science in Computer Science',
                        'institution' => 'University of California',
                        'graduation_year' => '2019',
                        'gpa' => '3.8'
                    ]
                ],
                'experience' => [
                    [
                        'job_title' => 'Senior Software Developer',
                        'company' => 'Tech Corp',
                        'start_date' => '2021-01',
                        'end_date' => 'present',
                        'description' => 'Led development of multiple web applications using React and Node.js.'
                    ]
                ],
                'skills' => [
                    ['name' => 'JavaScript', 'level' => 'Expert'],
                    ['name' => 'React', 'level' => 'Advanced'],
                    ['name' => 'Node.js', 'level' => 'Advanced'],
                    ['name' => 'Python', 'level' => 'Intermediate']
                ]
            ],
            [
                'title' => 'Marketing Manager Resume',
                'template' => 'corporate',
                'personal_info' => [
                    'full_name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'phone' => '+1-555-0456',
                    'location' => 'New York, NY',
                    'summary' => 'Strategic marketing professional with expertise in digital marketing and brand management.'
                ],
                'education' => [
                    [
                        'degree' => 'Master of Business Administration',
                        'institution' => 'New York University',
                        'graduation_year' => '2020',
                        'gpa' => '3.9'
                    ]
                ],
                'experience' => [
                    [
                        'job_title' => 'Marketing Manager',
                        'company' => 'Global Marketing Inc',
                        'start_date' => '2020-06',
                        'end_date' => 'present',
                        'description' => 'Manage digital marketing campaigns and brand strategy for Fortune 500 clients.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Digital Marketing', 'level' => 'Expert'],
                    ['name' => 'Brand Strategy', 'level' => 'Advanced'],
                    ['name' => 'Social Media', 'level' => 'Advanced'],
                    ['name' => 'Analytics', 'level' => 'Intermediate']
                ]
            ],
            [
                'title' => 'Product Designer Resume',
                'template' => 'creative',
                'personal_info' => [
                    'full_name' => 'Mike Johnson',
                    'email' => 'mike.johnson@example.com',
                    'phone' => '+1-555-0789',
                    'location' => 'Austin, TX',
                    'summary' => 'Creative product designer focused on user experience and visual design.'
                ],
                'education' => [
                    [
                        'degree' => 'Bachelor of Fine Arts in Design',
                        'institution' => 'Parsons School of Design',
                        'graduation_year' => '2018',
                        'gpa' => '3.7'
                    ]
                ],
                'experience' => [
                    [
                        'job_title' => 'Product Designer',
                        'company' => 'Design Studio',
                        'start_date' => '2018-08',
                        'end_date' => 'present',
                        'description' => 'Design user interfaces and user experiences for mobile and web applications.'
                    ]
                ],
                'skills' => [
                    ['name' => 'UI/UX Design', 'level' => 'Expert'],
                    ['name' => 'Figma', 'level' => 'Advanced'],
                    ['name' => 'Sketch', 'level' => 'Advanced'],
                    ['name' => 'Prototyping', 'level' => 'Expert']
                ]
            ]
        ];
        
        foreach ($resumes as $resumeData) {
            $resume = $user->resumes()->create($resumeData);
            
            // Add some sample views for each resume
            for ($i = 0; $i < rand(5, 20); $i++) {
                $resume->views()->create([
                    'ip_address' => '192.168.1.' . rand(1, 255),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'viewed_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}


