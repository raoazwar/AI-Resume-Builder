<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">
          <svg class="w-5 h-5 inline mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6" />
          </svg>
          Job-Specific Tailoring
        </h3>
        <button
          @click="isOpen = !isOpen"
          class="text-sm text-green-600 hover:text-green-800 font-medium"
        >
          {{ isOpen ? 'Hide' : 'Show' }}
        </button>
      </div>

      <div v-if="isOpen" class="space-y-4">
        <!-- Industry Selection -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Target Industry</label>
          <select
            v-model="selectedIndustry"
            @change="generateRecommendations"
            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
          >
            <option value="">Select an industry</option>
            <option v-for="industry in industries" :key="industry.value" :value="industry.value">
              {{ industry.label }}
            </option>
          </select>
        </div>

        <!-- Job Role Selection -->
        <div v-if="selectedIndustry">
          <label class="block text-sm font-medium text-gray-700 mb-2">Target Role</label>
          <select
            v-model="selectedRole"
            @change="generateRecommendations"
            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
          >
            <option value="">Select a role</option>
            <option v-for="role in availableRoles" :key="role.value" :value="role.value">
              {{ role.label }}
            </option>
          </select>
        </div>

        <!-- Recommendations -->
        <div v-if="recommendations.length > 0" class="mt-6">
          <h4 class="text-md font-medium text-gray-900 mb-3">
            Tailored Recommendations for {{ selectedIndustryLabel }} - {{ selectedRoleLabel }}
          </h4>
          
          <div class="space-y-4">
            <!-- Keywords Section -->
            <div v-if="recommendations.keywords" class="p-4 bg-green-50 rounded-lg border border-green-200">
              <h5 class="font-medium text-green-900 mb-2">Recommended Keywords</h5>
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="keyword in recommendations.keywords"
                  :key="keyword"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                >
                  {{ keyword }}
                </span>
              </div>
            </div>

            <!-- Skills Section -->
            <div v-if="recommendations.skills" class="p-4 bg-blue-50 rounded-lg border border-blue-200">
              <h5 class="font-medium text-blue-900 mb-2">Recommended Skills</h5>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div
                  v-for="skill in recommendations.skills"
                  :key="skill.name"
                  class="flex items-center justify-between p-2 bg-white rounded border"
                >
                  <span class="text-sm text-blue-800">{{ skill.name }}</span>
                  <span class="text-xs text-blue-600">{{ skill.importance }}</span>
                </div>
              </div>
            </div>

            <!-- Content Tips -->
            <div v-if="recommendations.contentTips" class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
              <h5 class="font-medium text-yellow-900 mb-2">Content Tips</h5>
              <ul class="space-y-2">
                <li
                  v-for="tip in recommendations.contentTips"
                  :key="tip"
                  class="text-sm text-yellow-800 flex items-start"
                >
                  <svg class="w-4 h-4 text-yellow-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                  </svg>
                  {{ tip }}
                </li>
              </ul>
            </div>

            <!-- Experience Focus -->
            <div v-if="recommendations.experienceFocus" class="p-4 bg-purple-50 rounded-lg border border-purple-200">
              <h5 class="font-medium text-purple-900 mb-2">Experience Focus Areas</h5>
              <div class="space-y-2">
                <div
                  v-for="focus in recommendations.experienceFocus"
                  :key="focus.area"
                  class="flex items-center justify-between p-2 bg-white rounded border"
                >
                  <span class="text-sm text-purple-800">{{ focus.area }}</span>
                  <span class="text-xs text-purple-600">{{ focus.description }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Apply Recommendations Button -->
        <div v-if="recommendations.length > 0" class="mt-6">
          <button
            @click="applyRecommendations"
            class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Apply Recommendations to Resume
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'

interface Props {
  resumeId: number
}

const props = defineProps<Props>()

const isOpen = ref(false)
const selectedIndustry = ref('')
const selectedRole = ref('')
const recommendations = ref<any>({})

const industries = [
  { value: 'technology', label: 'Technology' },
  { value: 'finance', label: 'Finance & Banking' },
  { value: 'healthcare', label: 'Healthcare' },
  { value: 'education', label: 'Education' },
  { value: 'marketing', label: 'Marketing & Advertising' },
  { value: 'consulting', label: 'Consulting' },
  { value: 'manufacturing', label: 'Manufacturing' },
  { value: 'retail', label: 'Retail & E-commerce' }
]

const roles = {
  technology: [
    { value: 'software-developer', label: 'Software Developer' },
    { value: 'data-scientist', label: 'Data Scientist' },
    { value: 'product-manager', label: 'Product Manager' },
    { value: 'devops-engineer', label: 'DevOps Engineer' }
  ],
  finance: [
    { value: 'financial-analyst', label: 'Financial Analyst' },
    { value: 'investment-banker', label: 'Investment Banker' },
    { value: 'accountant', label: 'Accountant' },
    { value: 'risk-manager', label: 'Risk Manager' }
  ],
  healthcare: [
    { value: 'nurse', label: 'Nurse' },
    { value: 'physician', label: 'Physician' },
    { value: 'healthcare-administrator', label: 'Healthcare Administrator' },
    { value: 'pharmacist', label: 'Pharmacist' }
  ],
  education: [
    { value: 'teacher', label: 'Teacher' },
    { value: 'professor', label: 'Professor' },
    { value: 'administrator', label: 'Administrator' },
    { value: 'counselor', label: 'Counselor' }
  ]
}

const availableRoles = computed(() => {
  return roles[selectedIndustry.value as keyof typeof roles] || []
})

const selectedIndustryLabel = computed(() => {
  const industry = industries.find(i => i.value === selectedIndustry.value)
  return industry ? industry.label : ''
})

const selectedRoleLabel = computed(() => {
  const role = availableRoles.value.find(r => r.value === selectedRole.value)
  return role ? role.label : ''
})

const generateRecommendations = () => {
  if (!selectedIndustry.value || !selectedRole.value) {
    recommendations.value = {}
    return
  }

  // Generate industry and role-specific recommendations
  const industryData = getIndustryRecommendations(selectedIndustry.value, selectedRole.value)
  recommendations.value = industryData
}

const getIndustryRecommendations = (industry: string, role: string) => {
  const baseRecommendations = {
    technology: {
      keywords: ['agile', 'scrum', 'git', 'docker', 'kubernetes', 'microservices', 'cloud computing'],
      skills: [
        { name: 'Programming Languages', importance: 'High' },
        { name: 'Version Control', importance: 'High' },
        { name: 'Cloud Platforms', importance: 'Medium' }
      ],
      contentTips: [
        'Highlight technical projects with measurable outcomes',
        'Include specific technologies and frameworks used',
        'Quantify performance improvements and scalability achievements'
      ],
      experienceFocus: [
        { area: 'Technical Projects', description: 'Focus on complex problem-solving' },
        { area: 'Team Collaboration', description: 'Highlight cross-functional work' }
      ]
    },
    finance: {
      keywords: ['financial modeling', 'risk assessment', 'budgeting', 'forecasting', 'compliance', 'regulatory'],
      skills: [
        { name: 'Financial Analysis', importance: 'High' },
        { name: 'Excel & Modeling', importance: 'High' },
        { name: 'Regulatory Knowledge', importance: 'Medium' }
      ],
      contentTips: [
        'Emphasize quantitative achievements and cost savings',
        'Include specific financial metrics and KPIs',
        'Highlight compliance and regulatory experience'
      ],
      experienceFocus: [
        { area: 'Financial Analysis', description: 'Focus on data-driven decisions' },
        { area: 'Risk Management', description: 'Highlight mitigation strategies' }
      ]
    }
  }

  return baseRecommendations[industry as keyof typeof baseRecommendations] || {
    keywords: ['leadership', 'communication', 'problem-solving', 'teamwork'],
    skills: [
      { name: 'Communication', importance: 'High' },
      { name: 'Leadership', importance: 'Medium' }
    ],
    contentTips: [
      'Focus on measurable achievements and outcomes',
      'Highlight leadership and collaboration experiences'
    ],
    experienceFocus: [
      { area: 'Leadership', description: 'Focus on team management' },
      { area: 'Results', description: 'Highlight quantifiable achievements' }
    ]
  }
}

const applyRecommendations = () => {
  // TODO: Implement logic to apply recommendations to the resume
  // This could involve updating the form data or sending suggestions to the backend
  alert('Recommendations applied! Update your resume content based on these suggestions.')
}
</script>
