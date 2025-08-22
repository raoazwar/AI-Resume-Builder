# AI Resume Builder

A modern, AI-powered resume building application built with Laravel, Vue.js, and Tailwind CSS. Create professional resumes with intelligent suggestions, multiple templates, and PDF export capabilities.

## 🚀 Features

- **AI-Powered Optimization**: Get intelligent suggestions for resume improvement
- **Multiple Templates**: Choose from various professional resume templates
- **Real-time Preview**: See changes as you type with live preview
- **PDF Export**: Generate high-quality PDF resumes
- **User Authentication**: Secure login and registration system
- **Resume Management**: Create, edit, and organize multiple resumes
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile
- **PWA Support**: Progressive Web App with offline capabilities
- **Social Login**: Google and GitHub authentication support
- **Feedback System**: Collect and manage user feedback

## 🛠️ Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Vue.js 3 + TypeScript
- **Styling**: Tailwind CSS
- **Database**: SQLite (configurable for MySQL/PostgreSQL)
- **PDF Generation**: DomPDF
- **Authentication**: Laravel Breeze + Socialite
- **Testing**: Pest PHP
- **Build Tool**: Vite

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- Git

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/raoazwar/AI-Resume-Builder.git
   cd AI-Resume-Builder
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔧 Configuration

### Environment Variables

Update your `.env` file with the following configurations:

```env
APP_NAME="AI Resume Builder"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=http://localhost:8000/auth/github/callback
```

### Social Login Setup

1. **Google OAuth**: Create credentials at [Google Cloud Console](https://console.cloud.google.com/)
2. **GitHub OAuth**: Create OAuth App at [GitHub Developer Settings](https://github.com/settings/developers)

## 📱 Usage

### Creating a Resume

1. **Login/Register** to your account
2. **Click "Create Resume"** from the dashboard
3. **Fill in your details**:
   - Personal Information
   - Work Experience
   - Education
   - Skills
   - Projects
4. **Choose a template** that fits your style
5. **Preview and edit** your resume in real-time
6. **Export to PDF** when satisfied

### AI Optimization

- Get suggestions for better wording
- Receive tips for ATS optimization
- Improve readability scores
- Tailor content for specific job descriptions

## 🧪 Testing

Run the test suite using Pest:

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ResumeTest.php
```

## 🚀 Deployment

### Production Deployment

1. **Set environment variables** for production
2. **Optimize Laravel**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. **Build production assets**:
   ```bash
   npm run build
   ```
4. **Configure web server** (Apache/Nginx)
5. **Set up SSL certificate**

### Docker Deployment

```bash
# Build and run with Docker Compose
docker-compose up -d

# Or build custom image
docker build -t ai-resume-builder .
docker run -p 8000:8000 ai-resume-builder
```

## 📁 Project Structure

```
resume-builder/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   ├── Models/             # Eloquent models
│   ├── Policies/           # Authorization policies
│   └── Notifications/      # Email notifications
├── database/
│   ├── migrations/         # Database migrations
│   ├── seeders/           # Database seeders
│   └── factories/         # Model factories
├── resources/
│   ├── js/                # Vue.js components and pages
│   ├── css/               # Tailwind CSS styles
│   └── views/             # Blade templates
├── routes/                 # Application routes
├── tests/                  # Test files
└── public/                 # Public assets and PWA files
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework for web artisans
- [Vue.js](https://vuejs.org/) - The Progressive JavaScript Framework
- [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework
- [DomPDF](https://github.com/dompdf/dompdf) - HTML to PDF converter

## 📞 Support

If you have any questions or need help:

- Create an [issue](https://github.com/raoazwar/AI-Resume-Builder/issues)
- Check the [documentation](https://github.com/raoazwar/AI-Resume-Builder/wiki)
- Contact: [r.azwar42@gmail.com]

---

**Made with ❤️ by Rao Azwar**

*Star this repository if it helped you! ⭐*
