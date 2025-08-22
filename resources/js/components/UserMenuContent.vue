<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import type { User } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { Setting, SwitchButton } from '@element-plus/icons-vue';

interface Props {
    user: User;
}

const handleLogout = () => {
    router.flushAll();
};

defineProps<Props>();
</script>

<template>
    <div class="user-menu-content">
        <!-- User Info Section -->
        <div class="user-menu-header">
            <UserInfo :user="user" :show-email="true" />
        </div>
        
        <el-divider />
        
        <!-- Menu Items -->
        <div class="user-menu-items">
            <Link 
                :href="route('profile.edit')" 
                class="user-menu-item"
                prefetch
            >
                <el-icon class="user-menu-icon">
                    <Setting />
                </el-icon>
                <span>Settings</span>
            </Link>
            
            <button 
                @click="handleLogout"
                class="user-menu-item user-menu-item-logout"
            >
                <el-icon class="user-menu-icon">
                    <SwitchButton />
                </el-icon>
                <span>Log out</span>
            </button>
        </div>
    </div>
</template>

<style scoped>
.user-menu-content {
    padding: 0.5rem 0;
    min-width: 200px;
}

.user-menu-header {
    padding: 0.75rem 1rem;
}

.user-menu-items {
    display: flex;
    flex-direction: column;
}

.user-menu-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: var(--foreground);
    transition: all 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 0.875rem;
}

.user-menu-item:hover {
    background: var(--accent);
    color: var(--primary);
}

.user-menu-item-logout {
    color: #ef4444;
}

.user-menu-item-logout:hover {
    background: #fef2f2;
    color: #dc2626;
}

.user-menu-icon {
    margin-right: 0.75rem;
    font-size: 1rem;
}
</style>
