<script setup lang="ts">
import { type NavItem } from '@/types';

interface Props {
    items: NavItem[];
    class?: string;
}

defineProps<Props>();
</script>

<template>
    <nav class="nav-footer" :class="$props.class">
        <a
            v-for="item in items"
            :key="item.title"
            :href="item.href"
            target="_blank"
            rel="noopener noreferrer"
            class="nav-footer-item"
        >
            <component :is="item.icon" class="nav-footer-icon" />
            <span class="nav-footer-text">{{ item.title }}</span>
        </a>
    </nav>
</template>

<style scoped>
.nav-footer {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.nav-footer-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    margin: 0 0.5rem;
    color: var(--sidebar-foreground);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
    opacity: 0.7;
}

.nav-footer-item:hover {
    background: var(--sidebar-accent);
    color: var(--sidebar-primary);
    opacity: 1;
}

.nav-footer-icon {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.nav-footer-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
