<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="py-6">
      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          My Resumes
        </h2>
        <Link
          :href="route('resumes.create')"
          class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
          Create New Resume
        </Link>
      </div>
      
      <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div v-if="resumes.length === 0" class="text-center py-12">
              <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <h3 class="text-lg font-medium text-gray-900 mb-2">No resumes yet</h3>
              <p class="text-gray-500 mb-6">Get started by creating your first professional resume.</p>
              <Link
                :href="route('resumes.create')"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
              >
                Create Resume
              </Link>
            </div>

            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div
                v-for="resume in resumes"
                :key="resume.id"
                class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200"
              >
                <div class="flex items-start justify-between mb-4">
                  <h3 class="text-lg font-semibold text-gray-900">{{ resume.title }}</h3>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ resume.template }}
                  </span>
                </div>
                
                <div class="text-sm text-gray-600 mb-4">
                  <p>Created: {{ formatDate(resume.created_at) }}</p>
                  <p>Updated: {{ formatDate(resume.updated_at) }}</p>
                </div>

                <div class="flex space-x-2">
                  <Link
                    :href="route('resumes.show', resume.id)"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  >
                    View
                  </Link>
                  <Link
                    :href="route('resumes.edit', resume.id)"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  >
                    Edit
                  </Link>
                  <button
                    @click="exportResume(resume.id)"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  >
                    Export
                  </button>
                  <button
                    @click="confirmDelete(resume.id, resume.title)"
                    :disabled="deletingResumeId === resume.id"
                    :aria-label="`Delete resume: ${resume.title}`"
                    title="Delete this resume permanently"
                    class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 hover:border-red-400 hover:text-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    <svg v-if="deletingResumeId === resume.id" class="animate-spin -ml-1 mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg v-else class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    {{ deletingResumeId === resume.id ? 'Deleting...' : 'Delete' }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'
import { ElMessageBox, ElMessage } from 'element-plus'
import { ref } from 'vue'
import AppLayout from '@/layouts/app/AppSidebarLayout.vue'
import type { BreadcrumbItemType } from '@/types'

const breadcrumbs: BreadcrumbItemType[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
  {
    title: 'My Resumes',
    href: '/resumes',
  },
]

interface Resume {
  id: number
  title: string
  template: string
  created_at: string
  updated_at: string
}

interface Props {
  resumes: Resume[]
}

defineProps<Props>()

const formatDate = (dateString: string) => {
  return new Date(dateString).toLocaleDateString()
}

const exportResume = async (resumeId: number) => {
  try {
    const response = await fetch(route('resumes.export', resumeId), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      },
    })
    
    if (response.ok) {
      const data = await response.json()
      alert(data.message)
    }
  } catch (error) {
    console.error('Export failed:', error)
    alert('Export failed. Please try again.')
  }
}

// Track which resume is being deleted
const deletingResumeId = ref<number | null>(null)

const confirmDelete = async (resumeId: number, resumeTitle: string) => {
  try {
    await ElMessageBox.confirm(
      `Are you sure you want to delete "${resumeTitle}"?\n\nThis action will permanently remove the resume and all associated data. This cannot be undone.`,
      'Delete Resume',
      {
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        type: 'warning',
        confirmButtonClass: 'el-button--danger',
        cancelButtonClass: 'el-button--default',
        dangerouslyUseHTMLString: false,
        customClass: 'delete-resume-confirmation',
        closeOnClickModal: false,
        closeOnPressEscape: true,
        showClose: true
      }
    )
    
    // If user confirms, proceed with deletion
    await deleteResume(resumeId)
  } catch (error) {
    // User cancelled the deletion
    if (error !== 'cancel') {
      ElMessage.error('An error occurred while trying to delete the resume.')
    }
  }
}

const deleteResume = async (resumeId: number) => {
  try {
    deletingResumeId.value = resumeId
    
    router.delete(route('resumes.destroy', resumeId), {
      onSuccess: () => {
        ElMessage.success('Resume deleted successfully!')
        deletingResumeId.value = null
      },
      onError: (errors) => {
        ElMessage.error('Failed to delete resume. Please try again.')
        deletingResumeId.value = null
      }
    })
  } catch (error) {
    console.error('Delete failed:', error)
    ElMessage.error('Delete failed. Please try again.')
    deletingResumeId.value = null
  }
}
</script>

<style scoped>
/* Custom styling for delete confirmation dialog */
:deep(.delete-resume-confirmation) {
  border-radius: 8px;
}

:deep(.delete-resume-confirmation .el-message-box__header) {
  border-bottom: 1px solid #e5e7eb;
  padding-bottom: 16px;
}

:deep(.delete-resume-confirmation .el-message-box__content) {
  padding: 20px 0;
  line-height: 1.6;
}

:deep(.delete-resume-confirmation .el-message-box__btns) {
  padding-top: 16px;
  border-top: 1px solid #e5e7eb;
}

:deep(.delete-resume-confirmation .el-button--danger) {
  background-color: #dc2626;
  border-color: #dc2626;
}

:deep(.delete-resume-confirmation .el-button--danger:hover) {
  background-color: #b91c1c;
  border-color: #b91c1c;
}

/* Loading state styling */
.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Disabled state styling */
.disabled\:opacity-50:disabled {
  opacity: 0.5;
}

.disabled\:cursor-not-allowed:disabled {
  cursor: not-allowed;
}
</style>
