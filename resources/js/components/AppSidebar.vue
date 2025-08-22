<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { 
    House, 
    Document, 
    Plus, 
    Setting, 
    User, 
    Star, 
    Reading,
    Menu,
    Close
} from '@element-plus/icons-vue';
import AppLogo from './AppLogo.vue';
import { ref, computed, inject } from 'vue';

const emit = defineEmits<{
    'toggle-collapse': []
}>();

const isCollapsed = ref(false);
const isMobile = ref(false);

const page = usePage();
const currentRoute = computed(() => page.url);

// Try to get sidebar state from parent
const sidebarState = inject<{
    isCollapsed: { value: boolean };
    toggle: () => void;
} | null>('sidebarState', null);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: House,
    },
    {
        title: 'Resumes',
        href: '/resumes',
        icon: Document,
    },
    {
        title: 'Create Resume',
        href: '/resumes/create',
        icon: Plus,
    },
];

const settingsNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile',
        icon: User,
    },
    {
        title: 'Settings',
        href: '/settings/appearance',
        icon: Setting,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Star,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: Reading,
    },
];

const toggleCollapse = () => {
    isCollapsed.value = !isCollapsed.value;
    emit('toggle-collapse');
    
    // Also update parent state if available
    if (sidebarState) {
        sidebarState.toggle();
    }
};

const isActive = (href: string) => {
    return currentRoute.value.startsWith(href);
};
</script>

<template>
    <div class="sidebar-container">
        <!-- Mobile Overlay -->
        <div 
            v-if="isMobile" 
            class="sidebar-overlay"
            @click="isMobile = false"
        />
        
        <!-- Sidebar -->
        <div 
            :class="[
                'sidebar-modern',
                'sidebar',
                { 'sidebar-collapsed': isCollapsed, 'sidebar-mobile': isMobile }
            ]"
        >
            <!-- Header -->
            <div class="sidebar-header">
                <div class="logo-container">
                    <Link :href="route('dashboard')" class="logo-link">
                        <AppLogo />
                    </Link>
                </div>
                <button 
                    @click="toggleCollapse"
                    class="collapse-btn"
                    :title="isCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'"
                >
                    <Menu v-if="!isCollapsed" class="w-4 h-4" />
                    <Close v-else class="w-4 h-4" />
                </button>
            </div>

            <!-- Navigation -->
            <div class="sidebar-content">
                <!-- Main Navigation -->
                <div class="nav-section">
                    <h3 class="nav-section-title">Main</h3>
                    <nav class="nav-list">
                        <Link
                            v-for="item in mainNavItems"
                            :key="item.href"
                            :href="item.href"
                            :class="[
                                'nav-item',
                                { 'nav-item-active': isActive(item.href) }
                            ]"
                        >
                            <component :is="item.icon" class="nav-icon" />
                            <span v-if="!isCollapsed" class="nav-text">{{ item.title }}</span>
                        </Link>
                    </nav>
                </div>

                <!-- Settings Navigation -->
                <div class="nav-section">
                    <h3 class="nav-section-title">Settings</h3>
                    <nav class="nav-list">
                        <Link
                            v-for="item in settingsNavItems"
                            :key="item.href"
                            :href="item.href"
                            :class="[
                                'nav-item',
                                { 'nav-item-active': isActive(item.href) }
                            ]"
                        >
                            <component :is="item.icon" class="nav-icon" />
                            <span v-if="!isCollapsed" class="nav-text">{{ item.title }}</span>
                        </Link>
                    </nav>
                </div>
            </div>

            <!-- Footer -->
            <div class="sidebar-footer">
                <div class="nav-section">
                    <h3 class="nav-section-title">Resources</h3>
                    <nav class="nav-list">
                        <a
                            v-for="item in footerNavItems"
                            :key="item.href"
                            :href="item.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="nav-item nav-item-external"
                        >
                            <component :is="item.icon" class="nav-icon" />
                            <span v-if="!isCollapsed" class="nav-text">{{ item.title }}</span>
                        </a>
                    </nav>
                </div>
                
                <!-- User Section -->
                <div class="user-section">
                    <NavUser />
                </div>
            </div>
        </div>

        <!-- Mobile Toggle Button -->
        <button 
            @click="isMobile = true"
            class="mobile-toggle-btn"
            title="Open Sidebar"
        >
            <Menu class="w-5 h-5" />
        </button>
    </div>
</template>

<style scoped>
.sidebar-container {
    position: relative;
    height: 100%;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 280px;
    background: linear-gradient(180deg, var(--sidebar-background) 0%, var(--sidebar-accent) 100%);
    border-right: 1px solid var(--sidebar-border);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    z-index: 50;
    overflow-y: auto;
}

.sidebar-collapsed {
    width: 80px;
}

.sidebar-mobile {
    transform: translateX(0);
}

.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem 1rem;
    border-bottom: 1px solid var(--sidebar-border);
}

.logo-container {
    flex: 1;
}

.logo-link {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.collapse-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: none;
    background: var(--sidebar-accent);
    color: var(--sidebar-foreground);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.collapse-btn:hover {
    background: var(--sidebar-primary);
    color: var(--sidebar-primary-foreground);
}

.sidebar-content {
    flex: 1;
    padding: 1rem 0;
    overflow-y: auto;
}

.nav-section {
    margin-bottom: 2rem;
}

.nav-section-title {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--muted-foreground);
    padding: 0 1rem;
    margin-bottom: 0.75rem;
}

.nav-list {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    margin: 0 0.5rem;
    color: var(--sidebar-foreground);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
}

.nav-item:hover {
    background: var(--sidebar-accent);
    color: var(--sidebar-primary);
}

.nav-item-active {
    background: var(--sidebar-primary);
    color: var(--sidebar-primary-foreground);
}

.nav-item-external {
    opacity: 0.7;
}

.nav-item-external:hover {
    opacity: 1;
}

.nav-icon {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.nav-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.sidebar-footer {
    padding: 1rem 0;
    border-top: 1px solid var(--sidebar-border);
}

.user-section {
    padding: 0 1rem;
    margin-top: 1rem;
}

.mobile-toggle-btn {
    display: none;
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 40;
    width: 48px;
    height: 48px;
    border: none;
    background: var(--primary);
    color: white;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.2s ease;
}

.mobile-toggle-btn:hover {
    background: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 40;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        width: 280px;
    }
    
    .sidebar-mobile {
        transform: translateX(0);
    }
    
    .mobile-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .sidebar-collapsed {
        width: 280px;
    }
}

@media (min-width: 769px) {
    .sidebar {
        transform: translateX(0);
    }
    
    .sidebar-collapsed {
        width: 80px;
    }
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
    .sidebar {
        background: linear-gradient(180deg, var(--sidebar-background) 0%, var(--sidebar-accent) 100%);
    }
}
</style>
