<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="py-6">
      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ resume.title }}
        </h2>
        <div class="flex space-x-2">
          <Link
            :href="route('resumes.edit', resume.id)"
            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Edit
          </Link>
          <button
            @click="exportResume('pdf')"
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Export PDF
          </button>
          <button
            @click="exportResume('docx')"
            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Export DOCX
          </button>
        </div>
      </div>
      
      <div class="max-w-4xl mx-auto">
        <!-- Resume Preview -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
          <div class="p-8">
            <!-- Header -->
            <div class="text-center mb-8">
              <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ resume.personal_info.full_name }}
              </h1>
              <p class="text-lg text-gray-600 mb-4">
                {{ resume.personal_info.summary }}
              </p>
              <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-600">
                <span v-if="resume.personal_info.email">{{ resume.personal_info.email }}</span>
                <span v-if="resume.personal_info.phone">{{ resume.personal_info.phone }}</span>
                <span v-if="resume.personal_info.location">{{ resume.personal_info.location }}</span>
              </div>
            </div>

            <!-- Work Experience -->
            <div v-if="resume.experience && resume.experience.length > 0" class="mb-8">
              <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                Work Experience
              </h2>
              <div class="space-y-6">
                <div
                  v-for="(experience, index) in resume.experience"
                  :key="index"
                  class="border-l-4 border-blue-500 pl-4"
                >
                  <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">
                      {{ experience.job_title }}
                    </h3>
                    <span class="text-sm text-gray-600">
                      {{ formatDate(experience.start_date) }} - {{ experience.end_date ? formatDate(experience.end_date) : 'Present' }}
                    </span>
                  </div>
                  <p class="text-md font-medium text-gray-700 mb-2">
                    {{ experience.company }}
                  </p>
                  <p class="text-gray-600 whitespace-pre-line">{{ experience.description }}</p>
                </div>
              </div>
            </div>

            <!-- Education -->
            <div v-if="resume.education && resume.education.length > 0" class="mb-8">
              <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                Education
              </h2>
              <div class="space-y-4">
                <div
                  v-for="(education, index) in resume.education"
                  :key="index"
                  class="flex justify-between items-start"
                >
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                      {{ education.degree }}
                    </h3>
                    <p class="text-md text-gray-700">{{ education.institution }}</p>
                  </div>
                  <div class="text-right">
                    <p class="text-sm text-gray-600">{{ education.graduation_year }}</p>
                    <p v-if="education.gpa" class="text-sm text-gray-600">GPA: {{ education.gpa }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Skills -->
            <div v-if="resume.skills && resume.skills.length > 0" class="mb-8">
              <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                Skills
              </h2>
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="(skill, index) in resume.skills"
                  :key="index"
                  class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800"
                >
                  {{ skill.name }}
                  <span class="ml-2 text-xs text-blue-600">({{ skill.level }})</span>
                </span>
              </div>
            </div>

            <!-- Certifications -->
            <div v-if="resume.certifications && resume.certifications.length > 0" class="mb-8">
              <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                Certifications
              </h2>
              <div class="space-y-2">
                <div
                  v-for="(cert, index) in resume.certifications"
                  :key="index"
                  class="flex justify-between items-center"
                >
                  <span class="text-gray-700">{{ cert.name }}</span>
                  <span class="text-sm text-gray-600">{{ cert.issuer }} - {{ cert.date }}</span>
                </div>
              </div>
            </div>

            <!-- Social Links -->
            <div v-if="resume.social_links && resume.social_links.length > 0" class="mb-8">
              <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                Social Links
              </h2>
              <div class="flex flex-wrap gap-4">
                <a
                  v-for="(link, index) in resume.social_links"
                  :key="index"
                  :href="link.url"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="text-blue-600 hover:text-blue-800 underline"
                >
                  {{ link.platform }}
                </a>
              </div>
            </div>

            <!-- Additional Sections -->
            <div v-if="resume.additional_sections && resume.additional_sections.length > 0">
              <div
                v-for="(section, index) in resume.additional_sections"
                :key="index"
                class="mb-8"
              >
                <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                  {{ section.title }}
                </h2>
                <div class="space-y-2">
                  <div
                    v-for="(item, itemIndex) in section.items"
                    :key="itemIndex"
                    class="flex justify-between items-start"
                  >
                    <span class="text-gray-700">{{ item.name }}</span>
                    <span v-if="item.date" class="text-sm text-gray-600">{{ item.date }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- AI Optimization -->
        <div class="mt-8">
          <AIOptimization :resume-id="resume.id" />
        </div>

        <!-- Job-Specific Tailoring -->
        <div class="mt-8">
          <JobTailoring :resume-id="resume.id" />
        </div>

        <!-- Actions -->
        <div class="flex justify-center space-x-4 mt-6">
          <Link
            :href="route('resumes.index')"
            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Back to Resumes
          </Link>
          <Link
            :href="route('resumes.edit', resume.id)"
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Edit Resume
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/app/AppSidebarLayout.vue'
import type { BreadcrumbItemType } from '@/types'
import AIOptimization from '@/components/AIOptimization.vue'
import JobTailoring from '@/components/JobTailoring.vue'

const breadcrumbs: BreadcrumbItemType[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
  {
    title: 'My Resumes',
    href: '/resumes',
  },
  {
    title: 'View Resume',
    href: '#',
  },
]

interface Resume {
  id: number
  title: string
  template: string
  personal_info: {
    full_name: string
    email: string
    phone: string
    location: string
    summary: string
  }
  education: Array<{
    degree: string
    institution: string
    graduation_year: number
    gpa?: string
  }>
  experience: Array<{
    job_title: string
    company: string
    start_date: string
    end_date?: string
    description: string
  }>
  skills: Array<{
    name: string
    level: string
  }>
  certifications?: Array<{
    name: string
    issuer: string
    date: string
  }>
  social_links?: Array<{
    platform: string
    url: string
  }>
  additional_sections?: Array<{
    title: string
    items: Array<{
      name: string
      date?: string
    }>
  }>
}

interface Props {
  resume: Resume
}

const props = defineProps<Props>()

const formatDate = (dateString: string) => {
  if (!dateString) return ''
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long' })
}

const exportResume = async (format: string) => {
  try {
    const response = await fetch(route('resumes.export', props.resume.id), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      },
      body: JSON.stringify({ format })
    })
    
    if (response.ok) {
      // Handle PDF download
      if (format === 'pdf') {
        const blob = await response.blob()
        const url = window.URL.createObjectURL(blob)
        const a = document.createElement('a')
        a.href = url
        a.download = `${props.resume.title}_resume.pdf`
        document.body.appendChild(a)
        a.click()
        window.URL.revokeObjectURL(url)
        document.body.removeChild(a)
      } else {
        const data = await response.json()
        alert(data.message)
      }
    } else {
      console.error('Export failed with status:', response.status)
      alert('Export failed. Please try again.')
    }
  } catch (error) {
    console.error('Export failed:', error)
    alert('Export failed. Please try again.')
  }
}
</script>
