<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6">
      <h3 class="text-lg font-medium text-gray-900 mb-4">Choose Template</h3>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
          v-for="template in templates"
          :key="template.id"
          @click="selectTemplate(template.id)"
          :class="[
            'template-card relative cursor-pointer rounded-lg border-2 p-4 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1',
            selectedTemplate === template.id
              ? 'selected border-blue-500 bg-blue-50 shadow-md'
              : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50'
          ]"
        >
          <!-- Template Preview -->
          <div class="template-preview aspect-[3/4] bg-gray-100 rounded border mb-3 relative overflow-hidden">
            <div class="absolute inset-0 p-2">
              <!-- Template Preview Content -->
              <div class="template-preview-content h-full bg-white rounded-sm shadow-sm">
                <!-- Modern Template -->
                <div v-if="template.id === 'modern'" class="h-full modern-template">
                  <!-- Header with accent color -->
                  <div class="header-accent h-1/4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-sm relative">
                    <div class="absolute bottom-2 left-2 w-8 h-8 bg-white rounded-full"></div>
                  </div>
                  <!-- Content with modern spacing -->
                  <div class="p-3 space-y-2">
                    <div class="h-3 bg-gray-800 rounded w-4/5"></div>
                    <div class="h-2 bg-blue-600 rounded w-1/3"></div>
                    <div class="h-2 bg-gray-400 rounded w-2/3"></div>
                    <div class="h-2 bg-gray-400 rounded w-1/2"></div>
                    <div class="h-2 bg-gray-400 rounded w-3/4"></div>
                  </div>
                </div>

                <!-- Minimalist Template -->
                <div v-else-if="template.id === 'minimalist'" class="h-full minimalist-template">
                  <!-- Clean header -->
                  <div class="clean-header h-1/4 bg-gray-800 rounded-t-sm"></div>
                  <!-- Minimalist content with lots of whitespace -->
                  <div class="p-4 space-y-3">
                    <div class="h-4 bg-gray-900 rounded w-full"></div>
                    <div class="h-2 bg-gray-300 rounded w-3/4"></div>
                    <div class="h-2 bg-gray-300 rounded w-1/2"></div>
                    <div class="h-2 bg-gray-300 rounded w-2/3"></div>
                    <div class="h-2 bg-gray-300 rounded w-1/3"></div>
                  </div>
                </div>

                <!-- Corporate Template -->
                <div v-else-if="template.id === 'corporate'" class="h-full corporate-template">
                  <!-- Traditional header -->
                  <div class="traditional-header h-1/4 bg-gray-700 rounded-t-sm relative">
                    <div class="absolute top-2 left-2 w-12 h-1 bg-white rounded"></div>
                    <div class="absolute top-4 left-2 w-8 h-1 bg-white rounded"></div>
                  </div>
                  <!-- Structured content -->
                  <div class="p-2 space-y-1">
                    <div class="h-3 bg-gray-800 rounded w-full"></div>
                    <div class="h-2 bg-gray-400 rounded w-2/3"></div>
                    <div class="h-2 bg-gray-400 rounded w-1/2"></div>
                    <div class="h-2 bg-gray-400 rounded w-3/4"></div>
                    <div class="h-2 bg-gray-400 rounded w-1/2"></div>
                    <div class="h-2 bg-gray-400 rounded w-2/3"></div>
                  </div>
                </div>

                <!-- Creative Template -->
                <div v-else-if="template.id === 'creative'" class="h-full creative-template">
                  <!-- Creative header with diagonal elements -->
                  <div class="creative-header h-1/4 bg-gradient-to-br from-pink-500 via-purple-500 to-indigo-600 rounded-t-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-8 h-8 bg-yellow-400 transform rotate-45 translate-x-4 -translate-y-4"></div>
                    <div class="absolute bottom-0 left-0 w-6 h-6 bg-white rounded-full opacity-80"></div>
                  </div>
                  <!-- Creative content with varied elements -->
                  <div class="p-2 space-y-2">
                    <div class="h-3 bg-gray-800 rounded-full w-4/5"></div>
                    <div class="h-2 bg-pink-400 rounded w-1/3"></div>
                    <div class="h-2 bg-purple-400 rounded w-2/3"></div>
                    <div class="h-2 bg-indigo-400 rounded w-1/2"></div>
                    <div class="h-2 bg-yellow-400 rounded w-3/4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Template Info -->
          <div class="template-info text-center">
            <h4 class="font-medium text-gray-900 text-sm">{{ template.name }}</h4>
            <p class="text-xs text-gray-500 mt-1">{{ template.description }}</p>
          </div>
          
          <!-- Selected Indicator -->
          <div
            v-if="selectedTemplate === template.id"
            class="absolute top-2 right-2 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center"
          >
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
      
      <!-- Template Details -->
      <div v-if="selectedTemplateDetails" class="mt-6 p-4 bg-gray-50 rounded-lg">
        <h4 class="font-medium text-gray-900 mb-2">{{ selectedTemplateDetails.name }}</h4>
        <p class="text-sm text-gray-600 mb-3">{{ selectedTemplateDetails.description }}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
          <div>
            <h5 class="font-medium text-gray-700 mb-2">Best For:</h5>
            <ul class="space-y-1 text-gray-600">
              <li v-for="(use, index) in selectedTemplateDetails.bestFor" :key="index" class="flex items-center">
                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                {{ use }}
              </li>
            </ul>
          </div>
          
          <div>
            <h5 class="font-medium text-gray-700 mb-2">Features:</h5>
            <ul class="space-y-1 text-gray-600">
              <li v-for="(feature, index) in selectedTemplateDetails.features" :key="index" class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                {{ feature }}
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

interface Template {
  id: string
  name: string
  description: string
  bestFor: string[]
  features: string[]
}

interface Props {
  modelValue: string
}

const props = defineProps<Props>()
const emit = defineEmits<{
  'update:modelValue': [value: string]
}>()

const selectedTemplate = ref(props.modelValue)

const templates: Template[] = [
  {
    id: 'modern',
    name: 'Modern',
    description: 'Clean and professional design',
    bestFor: ['Tech jobs', 'Creative roles', 'Recent graduates', 'Startups'],
    features: ['Gradient header accents', 'Clean typography', 'Modern spacing', 'Color highlights']
  },
  {
    id: 'minimalist',
    name: 'Minimalist',
    description: 'Simple and elegant',
    bestFor: ['Corporate positions', 'Academic roles', 'Executive positions', 'Consulting'],
    features: ['Maximum whitespace', 'Focus on content', 'Clean lines', 'Professional fonts']
  },
  {
    id: 'corporate',
    name: 'Corporate',
    description: 'Traditional business style',
    bestFor: ['Finance', 'Consulting', 'Traditional industries', 'Government'],
    features: ['Structured layout', 'Conservative design', 'Professional appearance', 'Traditional fonts']
  },
  {
    id: 'creative',
    name: 'Creative',
    description: 'Bold and artistic design',
    bestFor: ['Design roles', 'Marketing', 'Creative industries', 'Portfolio work'],
    features: ['Unique visual elements', 'Colorful accents', 'Creative layout', 'Modern typography']
  }
]

const selectedTemplateDetails = computed(() => {
  return templates.find(t => t.id === selectedTemplate.value)
})

const selectTemplate = (templateId: string) => {
  selectedTemplate.value = templateId
  emit('update:modelValue', templateId)
}

// Watch for external changes
watch(() => props.modelValue, (newValue) => {
  selectedTemplate.value = newValue
})
</script>

<style scoped>
/* Template preview enhancements */
.template-preview {
  transition: all 0.3s ease;
}

/* Modern template specific styling */
.modern-template .header-accent {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Minimalist template specific styling */
.minimalist-template .clean-header {
  background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
}

/* Corporate template specific styling */
.corporate-template .traditional-header {
  background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
}

/* Creative template specific styling */
.creative-template .creative-header {
  background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #3b82f6 100%);
}

/* Hover effects for template cards */
.template-card:hover .template-preview {
  transform: scale(1.02);
}

/* Selected template styling */
.template-card.selected {
  border-color: #3b82f6;
  background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
  box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
}

/* Template preview content animations */
.template-preview-content {
  animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Enhanced spacing and typography */
.template-info h4 {
  font-weight: 600;
  color: #1f2937;
}

.template-info p {
  color: #6b7280;
  line-height: 1.4;
}

/* Responsive improvements */
@media (max-width: 768px) {
  .template-card {
    padding: 1rem;
  }
  
  .template-preview {
    margin-bottom: 0.75rem;
  }
}
</style>
