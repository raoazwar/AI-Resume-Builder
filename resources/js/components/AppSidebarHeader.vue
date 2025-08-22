<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import type { BreadcrumbItemType } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header class="sidebar-header">
        <div class="header-content">
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
    </header>
</template>

<style scoped>
.sidebar-header {
    display: flex;
    height: 4rem;
    align-items: center;
    gap: 0.5rem;
    border-bottom: 1px solid var(--sidebar-border);
    padding: 0 1.5rem;
    background: var(--background);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    width: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar-header {
        padding: 0 1rem;
    }
}
</style>
