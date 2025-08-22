<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { type User } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { ArrowDown } from '@element-plus/icons-vue';
import UserMenuContent from './UserMenuContent.vue';

const page = usePage();
const user = page.props.auth.user as User;
</script>

<template>
    <div class="nav-user-container">
        <el-dropdown 
            trigger="click" 
            placement="top-end"
            class="user-dropdown"
        >
            <div class="user-trigger">
                <UserInfo :user="user" />
                <el-icon class="dropdown-arrow">
                    <ArrowDown />
                </el-icon>
            </div>
            
            <template #dropdown>
                <el-dropdown-menu class="user-dropdown-menu">
                    <UserMenuContent :user="user" />
                </el-dropdown-menu>
            </template>
        </el-dropdown>
    </div>
</template>

<style scoped>
.nav-user-container {
    width: 100%;
}

.user-dropdown {
    width: 100%;
}

.user-trigger {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: transparent;
}

.user-trigger:hover {
    background: var(--el-fill-color-light);
}

.dropdown-arrow {
    font-size: 1rem;
    color: var(--el-text-color-regular);
    transition: transform 0.2s ease;
}

.user-dropdown-menu {
    min-width: 200px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .user-trigger {
        padding: 1rem;
    }
}
</style>
