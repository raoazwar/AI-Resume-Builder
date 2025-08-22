<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { type DashboardStats } from '@/types/dashboard';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import UserFeedback from '@/components/UserFeedback.vue';
import UserAnalytics from '@/components/UserAnalytics.vue';
import { 
    Plus, 
    Document, 
    Setting, 
    User, 
    ArrowRight,
    Star,
    TrendCharts
} from '@element-plus/icons-vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

// Get real data from the backend
const page = usePage();
const stats: DashboardStats = (page.props.stats as DashboardStats) || {
    totalResumes: 0,
    aiOptimized: 0,
    totalViews: 0,
    averageScore: 0,
    recentActivity: [],
    templateUsage: [],
    lastUpdated: 'Never'
};
</script>

<template>
    <Head title="AI Resume Builder - Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="dashboard-container">
            <!-- Hero Section -->
            <el-card class="hero-section" shadow="never">
                <div class="hero-content">
                    <div class="hero-header">
                        <div class="hero-icon">
                            <el-icon class="hero-icon-svg"><Star /></el-icon>
                        </div>
                        <div class="hero-text">
                            <h1 class="hero-title">Welcome to AI Resume Builder</h1>
                            <p class="hero-subtitle">Create professional resumes with AI-powered optimization</p>
                        </div>
                    </div>
                    <div class="hero-actions">
                        <el-button 
                            type="primary" 
                            size="large"
                            @click="$inertia.visit(route('resumes.create'))"
                            class="hero-btn primary"
                        >
                            <el-icon class="mr-2"><Plus /></el-icon>
                            Create New Resume
                        </el-button>
                        <el-button 
                            type="info" 
                            size="large"
                            @click="$inertia.visit(route('resumes.index'))"
                            class="hero-btn secondary"
                        >
                            View My Resumes
                        </el-button>
                    </div>
                </div>
            </el-card>

            <!-- Quick Actions Grid -->
            <div class="actions-grid">
                <!-- Create Resume -->
                <el-card class="action-card create-card" shadow="hover">
                    <div class="action-content">
                        <div class="action-icon create">
                            <el-icon class="action-icon-svg"><Plus /></el-icon>
                        </div>
                        <h3 class="action-title">Create Resume</h3>
                        <p class="action-description">Start building your professional resume with our modern templates</p>
                        <el-button 
                            type="primary" 
                            text
                            @click="$inertia.visit(route('resumes.create'))"
                            class="action-link"
                        >
                            Get Started
                            <el-icon class="ml-2"><ArrowRight /></el-icon>
                        </el-button>
                    </div>
                </el-card>

                <!-- My Resumes -->
                <el-card class="action-card resumes-card" shadow="hover">
                    <div class="action-content">
                        <div class="action-icon resumes">
                            <el-icon class="action-icon-svg"><Document /></el-icon>
                        </div>
                        <h3 class="action-title">My Resumes</h3>
                        <p class="action-description">View, edit, and manage all your professional resumes</p>
                        <el-button 
                            type="success" 
                            text
                            @click="$inertia.visit(route('resumes.index'))"
                            class="action-link"
                        >
                            View All
                            <el-icon class="ml-2"><ArrowRight /></el-icon>
                        </el-button>
                    </div>
                </el-card>

                <!-- AI Optimization -->
                <el-card class="action-card ai-card" shadow="hover">
                    <div class="action-content">
                        <div class="action-icon ai">
                            <el-icon class="action-icon-svg"><Star /></el-icon>
                        </div>
                        <h3 class="action-title">AI Optimization</h3>
                        <p class="action-description">Get AI-powered suggestions to improve your resume</p>
                        <el-button 
                            type="warning" 
                            text
                            @click="$inertia.visit(route('resumes.create'))"
                            class="action-link"
                        >
                            Optimize Now
                            <el-icon class="ml-2"><ArrowRight /></el-icon>
                        </el-button>
                    </div>
                </el-card>

                <!-- Settings -->
                <el-card class="action-card settings-card" shadow="hover">
                    <div class="action-content">
                        <div class="action-icon settings">
                            <el-icon class="action-icon-svg"><Setting /></el-icon>
                        </div>
                        <h3 class="action-title">Settings</h3>
                        <p class="action-description">Customize your profile and application preferences</p>
                        <el-button 
                            type="info" 
                            text
                            @click="$inertia.visit(route('settings.appearance'))"
                            class="action-link"
                        >
                            Configure
                            <el-icon class="ml-2"><ArrowRight /></el-icon>
                        </el-button>
                    </div>
                </el-card>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <el-row :gutter="24">
                    <el-col :span="6" :xs="24" :sm="12" :md="6">
                        <el-card class="stat-card total-card" shadow="hover">
                            <div class="stat-content">
                                <div class="stat-icon total">
                                    <el-icon class="stat-icon-svg"><Document /></el-icon>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-number">{{ stats.totalResumes }}</h3>
                                    <p class="stat-label">Total Resumes</p>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                    
                    <el-col :span="6" :xs="24" :sm="12" :md="6">
                        <el-card class="stat-card optimized-card" shadow="hover">
                            <div class="stat-content">
                                <div class="stat-icon optimized">
                                    <el-icon class="stat-icon-svg"><Star /></el-icon>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-number">{{ stats.aiOptimized }}</h3>
                                    <p class="stat-label">AI Optimized</p>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                    
                    <el-col :span="6" :xs="24" :sm="12" :md="6">
                        <el-card class="stat-card views-card" shadow="hover">
                            <div class="stat-content">
                                <div class="stat-icon views">
                                    <el-icon class="stat-icon-svg"><TrendCharts /></el-icon>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-number">{{ stats.totalViews }}</h3>
                                    <p class="stat-label">Total Views</p>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                    
                    <el-col :span="6" :xs="24" :sm="12" :md="6">
                        <el-card class="stat-card score-card" shadow="hover">
                            <div class="stat-content">
                                <div class="stat-icon score">
                                    <el-icon class="stat-icon-svg"><Star /></el-icon>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-number">{{ stats.averageScore }}%</h3>
                                    <p class="stat-label">Avg. Score</p>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
            </div>

            <!-- Recent Activity -->
            <el-card class="recent-activity" shadow="hover">
                <template #header>
                    <div class="card-header">
                        <el-icon class="header-icon"><TrendCharts /></el-icon>
                        <span>Recent Activity</span>
                    </div>
                </template>
                
                <div class="activity-list">
                    <div v-for="activity in stats.recentActivity" :key="activity.id" class="activity-item">
                        <div class="activity-icon create">
                            <el-icon><Document /></el-icon>
                        </div>
                        <div class="activity-content">
                            <h4 class="activity-title">{{ activity.action }}</h4>
                            <p class="activity-description">{{ activity.resume_title }} - {{ activity.time_ago }}</p>
                        </div>
                        <div class="activity-time">{{ activity.time_ago }}</div>
                    </div>
                    
                    <div v-if="stats.recentActivity.length === 0" class="activity-item">
                        <div class="activity-icon create">
                            <el-icon><Plus /></el-icon>
                        </div>
                        <div class="activity-content">
                            <h4 class="activity-title">No Recent Activity</h4>
                            <p class="activity-description">Create your first resume to get started!</p>
                        </div>
                        <div class="activity-time">-</div>
                    </div>
                </div>
            </el-card>

            <!-- User Components -->
            <div class="user-components">
                <UserAnalytics />
                <UserFeedback />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.dashboard-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
    background-size: 400% 400%;
    animation: gradientShift 8s ease infinite;
    border: none;
    border-radius: 24px;
    overflow: hidden;
    color: white;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    position: relative;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    pointer-events: none;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.hero-content {
    padding: 3rem;
    position: relative;
    z-index: 1;
}

.hero-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
}

.hero-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.25);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(15px);
    margin-right: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.hero-icon-svg {
    font-size: 2.5rem;
    color: white;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.hero-text {
    flex: 1;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    line-height: 1.2;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.95;
    line-height: 1.5;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-btn {
    height: 52px;
    padding: 0 2rem;
    font-weight: 700;
    border-radius: 16px;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.hero-btn.primary {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    color: #1e293b;
    border: none;
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
}

.hero-btn.primary:hover {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(255, 255, 255, 0.4);
}

.hero-btn.secondary {
    background: rgba(255, 255, 255, 0.15);
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: white;
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.hero-btn.secondary:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

/* Actions Grid */
.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.action-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--el-bg-color);
    border: 1px solid var(--el-border-color-light);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    position: relative;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.action-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: var(--el-color-primary-light-5);
}

.action-card:hover::before {
    opacity: 1;
}

.action-card:hover .action-icon {
    transform: scale(1.15);
}

/* Card-specific themes */
.create-card {
    background: linear-gradient(135deg, var(--el-color-primary-light-9) 0%, var(--el-color-primary-light-8) 100%);
    border-color: var(--el-color-primary-light-5);
}

.resumes-card {
    background: linear-gradient(135deg, var(--el-color-success-light-9) 0%, var(--el-color-success-light-8) 100%);
    border-color: var(--el-color-success-light-5);
}

.ai-card {
    background: linear-gradient(135deg, var(--el-color-warning-light-9) 0%, var(--el-color-warning-light-8) 100%);
    border-color: var(--el-color-warning-light-5);
}

.settings-card {
    background: linear-gradient(135deg, var(--el-color-info-light-9) 0%, var(--el-color-info-light-8) 100%);
    border-color: var(--el-color-info-light-5);
}

.action-content {
    padding: 1.5rem;
    text-align: center;
}

.action-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: transform 0.3s ease;
}

.action-icon.create {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

.action-icon.resumes {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.action-icon.ai {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
}

.action-icon.settings {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
    box-shadow: 0 8px 25px rgba(6, 182, 212, 0.3);
}

.action-icon-svg {
    font-size: 2rem;
    color: white;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.action-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--el-text-color-primary);
    margin-bottom: 0.75rem;
}

.action-description {
    color: var(--el-text-color-regular);
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.action-link {
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.action-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.action-link:hover::before {
    left: 100%;
}

/* Enhanced action card button colors */
.action-card .el-button--primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.action-card .el-button--primary:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.action-card .el-button--success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.action-card .el-button--success:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
}

.action-card .el-button--warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.action-card .el-button--warning:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
}

.action-card .el-button--info {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
}

.action-card .el-button--info:hover {
    background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
}

/* Stats Section */
.stats-section {
    margin: 2rem 0;
}

.stat-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    background: var(--el-bg-color);
    border: 1px solid var(--el-border-color-light);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
}

/* Card-specific themes for stats */
.total-card {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 50%, #93c5fd 100%);
    border-color: #3b82f6;
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
}

.optimized-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%);
    border-color: #f59e0b;
    box-shadow: 0 4px 20px rgba(245, 158, 11, 0.15);
}

.views-card {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 50%, #6ee7b7 100%);
    border-color: #10b981;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.15);
}

.score-card {
    background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 50%, #67e8f9 100%);
    border-color: #06b6d4;
    box-shadow: 0 4px 20px rgba(6, 182, 212, 0.15);
}

.stat-content {
    display: flex;
    align-items: center;
    padding: 1.5rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.stat-icon.total {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
}

.stat-icon.optimized {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
}

.stat-icon.views {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
}

.stat-icon.score {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
    box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
}

.stat-icon-svg {
    font-size: 1.5rem;
    color: white;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.stat-info {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--el-text-color-primary);
    margin: 0 0 0.25rem 0;
    line-height: 1;
}

.stat-label {
    color: var(--el-text-color-regular);
    margin: 0;
    font-size: 0.875rem;
}

/* Recent Activity */
.recent-activity {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    background: var(--el-bg-color);
    border: 1px solid var(--el-border-color-light);
}

.card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--el-text-color-primary);
}

.header-icon {
    font-size: 1.25rem;
    color: var(--el-color-primary);
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    background: var(--el-fill-color-light);
    border: 1px solid var(--el-border-color-lighter);
    transition: all 0.2s ease;
}

.activity-item:hover {
    background: var(--el-fill-color);
    border-color: var(--el-color-primary-light-5);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.activity-icon.create {
    background: var(--el-color-primary);
    color: white;
}

.activity-icon.optimize {
    background: var(--el-color-warning);
    color: white;
}

.activity-icon.edit {
    background: var(--el-color-success);
    color: white;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: var(--el-text-color-primary);
    margin: 0 0 0.25rem 0;
    font-size: 0.875rem;
}

.activity-description {
    color: var(--el-text-color-regular);
    margin: 0;
    font-size: 0.75rem;
}

.activity-time {
    color: var(--el-text-color-placeholder);
    font-size: 0.75rem;
    font-weight: 500;
}

/* User Components */
.user-components {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content {
        padding: 2rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-actions {
        flex-direction: column;
    }
    
    .hero-btn {
        width: 100%;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .user-components {
        grid-template-columns: 1fr;
    }
    
    .stat-content {
        flex-direction: column;
        text-align: center;
    }
    
    .stat-icon {
        margin: 0 0 1rem 0;
    }
}
</style>
