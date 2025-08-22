<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface BreadcrumbItemType {
    title: string;
    href?: string;
}

defineProps<{
    breadcrumbs: BreadcrumbItemType[];
}>();
</script>

<template>
    <el-breadcrumb separator="/" class="breadcrumbs">
        <el-breadcrumb-item 
            v-for="(item, index) in breadcrumbs" 
            :key="index"
        >
            <template v-if="index === breadcrumbs.length - 1">
                <span class="breadcrumb-current">{{ item.title }}</span>
            </template>
            <template v-else>
                <Link 
                    :href="item.href ?? '#'" 
                    class="breadcrumb-link"
                >
                    {{ item.title }}
                </Link>
            </template>
        </el-breadcrumb-item>
    </el-breadcrumb>
</template>

<style scoped>
.breadcrumbs {
    font-size: 0.875rem;
}

.breadcrumb-link {
    color: var(--muted-foreground);
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb-link:hover {
    color: var(--primary);
}

.breadcrumb-current {
    color: var(--foreground);
    font-weight: 500;
}
</style>
