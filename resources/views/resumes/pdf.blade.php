<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background: white;
        }
        
        /* Modern Template Styles */
        .modern-template .header {
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            margin: -20px -20px 30px -20px;
            border-radius: 0;
        }
        
        .modern-template .name {
            font-size: 32px;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .modern-template .contact-info {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
        }
        
        .modern-template .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .modern-template .skill-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 16px;
            border-radius: 25px;
            font-size: 13px;
            border: none;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        
        /* Minimalist Template Styles */
        .minimalist-template .header {
            text-align: left;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 25px;
            margin-bottom: 40px;
            background: none;
            color: #1f2937;
        }
        
        .minimalist-template .name {
            font-size: 36px;
            font-weight: 300;
            color: #1f2937;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        
        .minimalist-template .contact-info {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 15px;
            font-weight: 300;
        }
        
        .minimalist-template .section-title {
            font-size: 18px;
            font-weight: 400;
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 25px;
            text-transform: none;
            letter-spacing: 0;
        }
        
        .minimalist-template .skill-item {
            background: #f9fafb;
            color: #374151;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            border: 1px solid #e5e7eb;
        }
        
        /* Corporate Template Styles */
        .corporate-template .header {
            text-align: center;
            border-bottom: 4px solid #374151;
            padding-bottom: 25px;
            margin-bottom: 30px;
            background: #f8fafc;
            color: #1f2937;
        }
        
        .corporate-template .name {
            font-size: 30px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 12px;
            font-family: 'Times New Roman', serif;
        }
        
        .corporate-template .contact-info {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .corporate-template .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #374151;
            border-bottom: 2px solid #d1d5db;
            padding-bottom: 8px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Times New Roman', serif;
        }
        
        .corporate-template .skill-item {
            background: #e5e7eb;
            color: #374151;
            padding: 6px 12px;
            border-radius: 3px;
            font-size: 12px;
            border: 1px solid #d1d5db;
            font-weight: 500;
        }
        
        /* Creative Template Styles */
        .creative-template .header {
            text-align: center;
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #3b82f6 100%);
            color: white;
            padding: 35px 20px;
            margin: -20px -20px 30px -20px;
            border-radius: 0;
            position: relative;
            overflow: hidden;
        }
        
        .creative-template .header::before {
            content: '';
            position: absolute;
            top: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: #fbbf24;
            transform: rotate(45deg);
            opacity: 0.8;
        }
        
        .creative-template .name {
            font-size: 34px;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .creative-template .contact-info {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
        }
        
        .creative-template .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #ec4899;
            border-bottom: 3px solid #ec4899;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .creative-template .skill-item {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            color: white;
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 13px;
            border: none;
            box-shadow: 0 3px 10px rgba(236, 72, 153, 0.3);
            margin: 5px;
        }
        
        /* Common Styles */
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .name {
            font-size: 28px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        
        .contact-info {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }
        
        .summary {
            font-size: 16px;
            color: #374151;
            text-align: center;
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.8;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            border-bottom: 2px solid #dbeafe;
            padding-bottom: 8px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .experience-item, .education-item {
            margin-bottom: 20px;
        }
        
        .job-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .company {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        
        .dates {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 10px;
        }
        
        .description {
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
        }
        
        .degree {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .institution {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .skill-item {
            background: #f3f4f6;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #374151;
            border: 1px solid #e5e7eb;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body class="{{ $resume->template ?? 'modern' }}-template">
    <!-- Header Section -->
    <div class="header">
        <div class="name">{{ $resume->personal_info['full_name'] ?? 'Your Name' }}</div>
        <div class="contact-info">
            @if(isset($resume->personal_info['email']))
                {{ $resume->personal_info['email'] }}
            @endif
            @if(isset($resume->personal_info['phone']))
                @if(isset($resume->personal_info['email'])) • @endif
                {{ $resume->personal_info['phone'] }}
            @endif
            @if(isset($resume->personal_info['location']))
                @if(isset($resume->personal_info['email']) || isset($resume->personal_info['phone'])) • @endif
                {{ $resume->personal_info['location'] }}
            @endif
        </div>
        @if(isset($resume->personal_info['linkedin']))
            <div class="contact-info">{{ $resume->personal_info['linkedin'] }}</div>
        @endif
        @if(isset($resume->personal_info['website']))
            <div class="contact-info">{{ $resume->personal_info['website'] }}</div>
        @endif
    </div>

    <!-- Professional Summary -->
    @if(isset($resume->personal_info['summary']) && !empty($resume->personal_info['summary']))
        <div class="summary">
            {{ $resume->personal_info['summary'] }}
        </div>
    @endif

    <!-- Work Experience -->
    @if(isset($resume->experience) && count($resume->experience) > 0)
        <div class="section">
            <div class="section-title">Professional Experience</div>
            @foreach($resume->experience as $experience)
                <div class="experience-item">
                    <div class="job-title">{{ $experience['title'] ?? 'Job Title' }}</div>
                    <div class="company">{{ $experience['company'] ?? 'Company' }}</div>
                    <div class="dates">
                        {{ $experience['start_date'] ?? 'Start Date' }}
                        @if(isset($experience['end_date']) && !empty($experience['end_date']))
                            - {{ $experience['end_date'] }}
                        @else
                            - Present
                        @endif
                    </div>
                    @if(isset($experience['description']) && !empty($experience['description']))
                        <div class="description">{{ $experience['description'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Education -->
    @if(isset($resume->education) && count($resume->education) > 0)
        <div class="section">
            <div class="section-title">Education</div>
            @foreach($resume->education as $education)
                <div class="education-item">
                    <div class="degree">{{ $education['degree'] ?? 'Degree' }}</div>
                    <div class="institution">{{ $education['institution'] ?? 'Institution' }}</div>
                    @if(isset($education['field']) && !empty($education['field']))
                        <div class="company">{{ $education['field'] }}</div>
                    @endif
                    <div class="dates">
                        @if(isset($education['graduation_date']) && !empty($education['graduation_date']))
                            {{ $education['graduation_date'] }}
                        @endif
                        @if(isset($education['gpa']) && !empty($education['gpa']))
                            • GPA: {{ $education['gpa'] }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Skills -->
    @if(isset($resume->skills) && count($resume->skills) > 0)
        <div class="section">
            <div class="section-title">Skills</div>
            <div class="skills-grid">
                @foreach($resume->skills as $skill)
                    @if(is_array($skill))
                        @if(!empty($skill['name']))
                            <div class="skill-item">
                                {{ $skill['name'] }}
                                @if(isset($skill['level']) && !empty($skill['level']))
                                    ({{ ucfirst($skill['level']) }})
                                @endif
                            </div>
                        @endif
                    @elseif(is_string($skill) && !empty($skill))
                        <div class="skill-item">{{ $skill }}</div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Certifications -->
    @if(isset($resume->certifications) && count($resume->certifications) > 0)
        <div class="section">
            <div class="section-title">Certifications</div>
            @foreach($resume->certifications as $certification)
                <div class="experience-item">
                    <div class="job-title">{{ $certification['name'] ?? 'Certification Name' }}</div>
                    <div class="company">{{ $certification['issuer'] ?? 'Issuing Organization' }}</div>
                    @if(isset($certification['date']) && !empty($certification['date']))
                        <div class="dates">{{ $certification['date'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Additional Sections -->
    @if(isset($resume->additional_sections) && count($resume->additional_sections) > 0)
        @foreach($resume->additional_sections as $section)
            <div class="section">
                <div class="section-title">{{ $section['title'] ?? 'Additional Section' }}</div>
                @if(isset($section['items']) && count($section['items']) > 0)
                    @foreach($section['items'] as $item)
                        <div class="experience-item">
                            <div class="job-title">{{ $item['name'] ?? 'Item Name' }}</div>
                            @if(isset($item['date']) && !empty($item['date']))
                                <div class="dates">{{ $item['date'] }}</div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</body>
</html>
