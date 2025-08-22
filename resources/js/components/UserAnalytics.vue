<template>
  <el-card class="analytics-card" shadow="hover">
    <template #header>
      <div class="card-header">
        <el-icon class="header-icon"><TrendCharts /></el-icon>
        <span>Your Analytics</span>
      </div>
    </template>
    
    <div class="analytics-content">
      <div class="stats-grid">
        <!-- Total Resumes -->
        <div class="stat-item total-stat">
          <div class="stat-icon">
            <el-icon class="stat-icon-svg"><Document /></el-icon>
          </div>
          <div class="stat-info">
            <p class="stat-label">Total Resumes</p>
            <p class="stat-value">{{ stats.totalResumes }}</p>
          </div>
        </div>

        <!-- Average Score -->
        <div class="stat-item score-stat">
          <div class="stat-icon">
            <el-icon class="stat-icon-svg"><Star /></el-icon>
          </div>
          <div class="stat-info">
            <p class="stat-label">Avg. Score</p>
            <p class="stat-value">{{ stats.averageScore }}%</p>
          </div>
        </div>

        <!-- Templates Used -->
        <div class="stat-item templates-stat">
          <div class="stat-icon">
            <el-icon class="stat-icon-svg"><Document /></el-icon>
          </div>
          <div class="stat-info">
            <p class="stat-label">Templates Used</p>
            <p class="stat-value">{{ stats.templateUsage.length }}</p>
          </div>
        </div>

        <!-- Last Updated -->
        <div class="stat-item updated-stat">
          <div class="stat-icon">
            <el-icon class="stat-icon-svg"><Clock /></el-icon>
          </div>
          <div class="stat-info">
            <p class="stat-label">Last Updated</p>
            <p class="stat-value">{{ stats.lastUpdated }}</p>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="recent-activity">
        <h4 class="section-title">Recent Activity</h4>
        <div class="activity-list">
          <div v-for="activity in recentActivity" :key="activity.id" class="activity-item">
            <div class="activity-icon">
              <el-icon class="activity-icon-svg"><Plus /></el-icon>
            </div>
            <div class="activity-content">
              <p class="activity-action">{{ activity.action }}</p>
              <p class="activity-resume">{{ activity.resume_title }}</p>
            </div>
            <div class="activity-time">
              {{ activity.time_ago }}
            </div>
          </div>
        </div>
      </div>

      <!-- Template Usage Chart -->
      <div class="template-usage">
        <h4 class="section-title">Template Usage</h4>
        <div class="template-list">
          <div v-for="template in templateUsage" :key="template.name" class="template-item">
            <span class="template-name">{{ template.name }}</span>
            <div class="template-bar">
              <div class="template-progress" :style="{ width: template.percentage + '%' }"></div>
            </div>
            <span class="template-percentage">{{ template.percentage }}%</span>
          </div>
        </div>
      </div>
    </div>
  </el-card>
</template>

<script setup lang="ts">
import { Document, Star, Clock, Plus, TrendCharts } from '@element-plus/icons-vue';
import { usePage } from '@inertiajs/vue3';
import { type DashboardStats } from '@/types/dashboard';

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

const recentActivity = stats.recentActivity || [];
const templateUsage = stats.templateUsage || [];
</script>

<style scoped>
.analytics-card {
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

.analytics-content {
  padding: 1.5rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.stat-item {
  display: flex;
  align-items: center;
  padding: 1rem;
  border-radius: 12px;
  background: var(--el-fill-color-light);
  border: 1px solid var(--el-border-color-light);
  transition: all 0.2s ease;
}

.stat-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Stat-specific themes */
.total-stat {
  background: linear-gradient(135deg, var(--el-color-primary-light-9) 0%, var(--el-color-primary-light-8) 100%);
  border-color: var(--el-color-primary-light-5);
}

.score-stat {
  background: linear-gradient(135deg, var(--el-color-success-light-9) 0%, var(--el-color-success-light-8) 100%);
  border-color: var(--el-color-success-light-5);
}

.templates-stat {
  background: linear-gradient(135deg, var(--el-color-warning-light-9) 0%, var(--el-color-warning-light-8) 100%);
  border-color: var(--el-color-warning-light-5);
}

.updated-stat {
  background: linear-gradient(135deg, var(--el-color-info-light-9) 0%, var(--el-color-info-light-8) 100%);
  border-color: var(--el-color-info-light-5);
}

.stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 1rem;
  background: rgba(255, 255, 255, 0.8);
}

.stat-icon-svg {
  font-size: 1.5rem;
  color: var(--el-text-color-primary);
}

.stat-info {
  flex: 1;
}

.stat-label {
  font-size: 0.875rem;
  color: var(--el-text-color-regular);
  margin: 0 0 0.25rem 0;
}

.stat-value {
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--el-text-color-primary);
  margin: 0;
}

.section-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--el-text-color-primary);
  margin: 0 0 1rem 0;
}

.activity-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-bottom: 2rem;
}

.activity-item {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  border-radius: 8px;
  background: var(--el-fill-color-light);
  border: 1px solid var(--el-border-color-lighter);
  transition: all 0.2s ease;
}

.activity-item:hover {
  background: var(--el-fill-color);
  border-color: var(--el-color-primary-light-5);
}

.activity-icon {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background: var(--el-color-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 0.75rem;
}

.activity-icon-svg {
  font-size: 1rem;
  color: white;
}

.activity-content {
  flex: 1;
}

.activity-action {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--el-text-color-primary);
  margin: 0 0 0.25rem 0;
}

.activity-resume {
  font-size: 0.75rem;
  color: var(--el-text-color-regular);
  margin: 0;
}

.activity-time {
  font-size: 0.75rem;
  color: var(--el-text-color-placeholder);
  font-weight: 500;
}

.template-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.template-item {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.template-name {
  font-size: 0.875rem;
  color: var(--el-text-color-primary);
  min-width: 80px;
  text-transform: capitalize;
}

.template-bar {
  flex: 1;
  height: 8px;
  background: var(--el-fill-color);
  border-radius: 4px;
  overflow: hidden;
}

.template-progress {
  height: 100%;
  background: linear-gradient(90deg, var(--el-color-primary) 0%, var(--el-color-primary-light-5) 100%);
  border-radius: 4px;
  transition: width 0.3s ease;
}

.template-percentage {
  font-size: 0.75rem;
  color: var(--el-text-color-regular);
  min-width: 40px;
  text-align: right;
}

/* Responsive Design */
@media (max-width: 768px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .template-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
  
  .template-name {
    min-width: auto;
  }
  
  .template-bar {
    width: 100%;
  }
}
</style>
