<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="AI Resume Builder - Create Professional Resumes">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    
    <!-- Navigation -->
    <header class="absolute top-0 left-0 right-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white">AI Resume Builder</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="text-white hover:text-blue-200 transition-colors duration-200 font-medium"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-white hover:text-blue-200 transition-colors duration-200 font-medium"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="route('register')"
                            class="bg-white text-blue-600 px-6 py-2 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl"
                        >
                            Get Started
                        </Link>
                    </template>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="min-h-screen bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 flex items-center justify-center relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-6" style="margin-top:100px; padding-bottom:50px;">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Create Your
                <span class="block bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                    Professional Resume
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                Build standout resumes with AI-powered optimization, modern templates, and professional guidance
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <Link
                    :href="route('register')"
                    class="bg-white text-blue-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl"
                >
                    Start Building Now
                </Link>
                
                <Link
                    :href="route('login')"
                    class="border-2 border-white/30 text-white px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                >
                    View Templates
                </Link>
            </div>
            
            <!-- Features Preview -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">AI-Powered</h3>
                    <p class="text-blue-200">Smart suggestions and optimization</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Modern Templates</h3>
                    <p class="text-blue-200">Professional and customizable designs</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Export & Share</h3>
                    <p class="text-blue-200">PDF download and easy sharing</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose AI Resume Builder?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our platform combines cutting-edge AI technology with professional design to help you create resumes that stand out
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Lightning Fast</h3>
                    <p class="text-gray-600">Create professional resumes in minutes, not hours</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">ATS Optimized</h3>
                    <p class="text-gray-600">Pass through Applicant Tracking Systems with ease</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Loved by Users</h3>
                    <p class="text-gray-600">Join thousands of satisfied job seekers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-gray-900 to-gray-800">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Land Your Dream Job?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Start building your professional resume today and take the first step towards your career goals
            </p>
            <Link
                :href="route('register')"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl"
            >
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Get Started Free
            </Link>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">AI Resume Builder</span>
                </div>
                <p class="text-gray-400">© 2024 AI Resume Builder. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>
