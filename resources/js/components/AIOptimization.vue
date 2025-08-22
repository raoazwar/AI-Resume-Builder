<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">
          <svg class="w-5 h-5 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
          </svg>
          AI Optimization
        </h3>
        <button
          @click="isOpen = !isOpen"
          class="text-sm text-blue-600 hover:text-blue-800 font-medium"
        >
          {{ isOpen ? 'Hide' : 'Show' }}
        </button>
      </div>

      <div v-if="isOpen" class="space-y-4">
        <!-- Optimization Types -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <button
            v-for="type in optimizationTypes"
            :key="type.value"
            @click="optimizeResume(type.value)"
            :disabled="isOptimizing"
            class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg v-if="isOptimizing && selectedType === type.value" class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ type.label }}
          </button>
        </div>

        <!-- Suggestions Display -->
        <div v-if="suggestions.length > 0" class="mt-6">
          <h4 class="text-md font-medium text-gray-900 mb-3">
            AI Suggestions for {{ selectedTypeLabel }}
          </h4>
          <div class="space-y-3">
            <div
              v-for="(suggestion, index) in suggestions"
              :key="index"
              class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200"
            >
              <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <p class="text-sm text-blue-800">{{ suggestion }}</p>
            </div>
          </div>
        </div>

        <!-- Resume Analysis -->
        <div v-if="analysis" class="mt-6 p-4 bg-gray-50 rounded-lg">
          <h4 class="text-md font-medium text-gray-900 mb-3">Resume Analysis</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-600">Completeness Score</span>
                <span class="text-sm font-medium text-gray-900">{{ analysis.completeness_score }}%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div
                  class="bg-blue-600 h-2 rounded-full"
                  :style="{ width: analysis.completeness_score + '%' }"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-600">Overall Rating</span>
                <span class="text-sm font-medium text-gray-900">{{ analysis.overall_rating }}/100</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div
                  class="bg-green-600 h-2 rounded-full"
                  :style="{ width: analysis.overall_rating + '%' }"
                ></div>
              </div>
            </div>
          </div>
          
          <!-- Recommendations -->
          <div v-if="analysis.recommendations.length > 0" class="mt-4">
            <h5 class="text-sm font-medium text-gray-900 mb-2">Recommendations</h5>
            <ul class="space-y-1">
              <li
                v-for="(rec, index) in analysis.recommendations"
                :key="index"
                class="text-sm text-gray-700 flex items-start"
              >
                <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                {{ rec }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'

interface Props {
  resumeId: number
}

const props = defineProps<Props>()

const isOpen = ref(false)
const isOptimizing = ref(false)
const selectedType = ref('')
const suggestions = ref<string[]>([])
const analysis = ref<any>(null)

const optimizationTypes = [
  { value: 'keywords', label: 'Keyword Optimization' },
  { value: 'grammar', label: 'Grammar Check' },
  { value: 'tone', label: 'Tone Analysis' },
  { value: 'general', label: 'General Review' }
]

const selectedTypeLabel = computed(() => {
  const type = optimizationTypes.find(t => t.value === selectedType.value)
  return type ? type.label : ''
})

const optimizeResume = async (type: string) => {
  selectedType.value = type
  isOptimizing.value = true
  suggestions.value = []
  
  try {
    const response = await fetch(route('resumes.optimize', props.resumeId), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      },
      body: JSON.stringify({ type })
    })
    
    if (response.ok) {
      const data = await response.json()
      suggestions.value = data.suggestions
    }
  } catch (error) {
    console.error('Optimization failed:', error)
  } finally {
    isOptimizing.value = false
  }
}

const analyzeResume = async () => {
  try {
    const response = await fetch(route('resumes.analyze', props.resumeId), {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      }
    })
    
    if (response.ok) {
      const data = await response.json()
      analysis.value = data.analysis
    }
  } catch (error) {
    console.error('Analysis failed:', error)
  }
}

// Auto-analyze when component opens
const watchIsOpen = () => {
  if (isOpen.value && !analysis.value) {
    analyzeResume()
  }
}

watch(isOpen, watchIsOpen)
</script>
