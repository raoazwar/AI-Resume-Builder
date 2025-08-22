<script setup lang="ts">
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';
import { ref, provide } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const isSidebarCollapsed = ref(false);

const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value;
};

// Provide sidebar state to child components
provide('sidebarState', {
    isCollapsed: isSidebarCollapsed,
    toggle: toggleSidebar
});
</script>

<template>
    <div class="app-layout">
        <AppSidebar @toggle-collapse="toggleSidebar" />
        <div 
            class="main-content"
            :class="{ 'sidebar-collapsed': isSidebarCollapsed }"
        >
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <main class="content-area">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
.app-layout {
    display: flex;
    min-height: 100vh;
}

.main-content {
    flex: 1;
    margin-left: 280px;
    transition: margin-left 0.3s ease;
    min-height: 100vh;
    background: var(--background);
}

.main-content.sidebar-collapsed {
    margin-left: 80px;
}

.content-area {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }
    
    .main-content.sidebar-collapsed {
        margin-left: 0;
    }
    
    .content-area {
        padding: 1rem;
    }
}
</style>
