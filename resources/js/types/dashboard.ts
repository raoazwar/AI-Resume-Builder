export interface DashboardStats {
  totalResumes: number;
  aiOptimized: number;
  totalViews: number;
  averageScore: number;
  recentActivity: RecentActivity[];
  templateUsage: TemplateUsage[];
  lastUpdated: string;
}

export interface RecentActivity {
  id: number;
  action: string;
  resume_title: string;
  time_ago: string;
}

export interface TemplateUsage {
  name: string;
  percentage: number;
}


