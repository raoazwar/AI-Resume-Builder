<script setup lang="ts">
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage();
</script>

<template>
    <nav class="nav-main">
        <Link
            v-for="item in items"
            :key="item.title"
            :href="item.href"
            :class="[
                'nav-main-item',
                { 'nav-main-item-active': item.href === page.url }
            ]"
        >
            <component :is="item.icon" class="nav-main-icon" />
            <span class="nav-main-text">{{ item.title }}</span>
        </Link>
    </nav>
</template>

<style scoped>
.nav-main {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.nav-main-item {
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

.nav-main-item:hover {
    background: var(--sidebar-accent);
    color: var(--sidebar-primary);
}

.nav-main-item-active {
    background: var(--sidebar-primary);
    color: var(--sidebar-primary-foreground);
}

.nav-main-icon {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.nav-main-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
