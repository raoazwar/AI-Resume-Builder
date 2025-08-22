<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="create-resume-page">
      <!-- Header -->
      <div class="page-header">
        <div class="header-content">
          <div class="header-text">
            <h1 class="page-title">Edit Resume: {{ resume.title }}</h1>
            <p class="page-subtitle">Update your resume with the latest information and AI-powered optimization</p>
          </div>
          <el-button
            type="primary"
            size="large"
            @click="$inertia.visit(route('resumes.show', resume.id))"
            class="back-btn"
          >
            <el-icon class="mr-2"><View /></el-icon>
            View Resume
          </el-button>
        </div>
      </div>

      <el-form
        ref="formRef"
        :model="form"
        :rules="rules"
        @submit.prevent="submitForm"
        class="resume-form"
        label-position="top"
      >
        <!-- Basic Information -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><InfoFilled /></el-icon>
              <span>Basic Information</span>
            </div>
          </template>

          <el-form-item label="Resume Title" prop="title">
            <el-input
              v-model="form.title"
              placeholder="e.g., Software Developer Resume"
              size="large"
              clearable
              class="form-input"
            />
          </el-form-item>
        </el-card>

        <!-- Template Selection -->
        <TemplateSelector v-model="form.template" />

        <!-- Personal Information -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><User /></el-icon>
              <span>Personal Information</span>
            </div>
          </template>

          <div class="form-grid">
            <el-form-item label="Full Name" prop="personal_info.full_name">
              <el-input
                v-model="form.personal_info.full_name"
                placeholder="John Doe"
                size="large"
                clearable
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="Email" prop="personal_info.email">
              <el-input
                v-model="form.personal_info.email"
                placeholder="john.doe@email.com"
                size="large"
                clearable
                type="email"
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="Phone" prop="personal_info.phone">
              <el-input
                v-model="form.personal_info.phone"
                placeholder="+1 (555) 123-4567"
                size="large"
                clearable
                type="tel"
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="Location" prop="personal_info.location">
              <el-input
                v-model="form.personal_info.location"
                placeholder="City, State"
                size="large"
                clearable
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="LinkedIn" prop="personal_info.linkedin">
              <el-input
                v-model="form.personal_info.linkedin"
                placeholder="https://linkedin.com/in/johndoe"
                size="large"
                clearable
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="Website" prop="personal_info.website">
              <el-input
                v-model="form.personal_info.website"
                placeholder="https://johndoe.com"
                size="large"
                clearable
                class="form-input"
              />
            </el-form-item>
          </div>

          <el-form-item label="Professional Summary" prop="personal_info.summary">
            <el-input
              v-model="form.personal_info.summary"
              type="textarea"
              :rows="4"
              placeholder="Brief overview of your professional background and career objectives..."
              size="large"
              class="form-input"
            />
          </el-form-item>
        </el-card>

        <!-- Work Experience -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><Briefcase /></el-icon>
              <span>Work Experience</span>
              <el-button
                type="primary"
                size="small"
                @click="addExperience"
                class="add-section-btn"
              >
                <el-icon class="mr-2"><Plus /></el-icon>
                Add Experience
              </el-button>
            </div>
          </template>

          <template v-for="(experience, index) in form.experience" :key="index">
            <div class="experience-item">
              <div class="experience-header">
                <h4 class="experience-title">Experience #{{ index + 1 }}</h4>
                <el-button
                  v-if="form.experience.length > 1"
                  type="danger"
                  size="small"
                  @click="removeExperience(index)"
                  class="remove-btn"
                >
                  <el-icon><Delete /></el-icon>
                </el-button>
              </div>

              <div class="form-grid">
                <el-form-item :label="`Job Title`" :prop="`experience.${index}.title`">
                  <el-input
                    v-model="experience.title"
                    placeholder="e.g., Senior Software Developer"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Company`" :prop="`experience.${index}.company`">
                  <el-input
                    v-model="experience.company"
                    placeholder="e.g., Tech Corp"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Start Date`" :prop="`experience.${index}.start_date`">
                  <el-date-picker
                    v-model="experience.start_date"
                    type="month"
                    placeholder="Start Date"
                    size="large"
                    class="form-input"
                    style="width: 100%"
                  />
                </el-form-item>

                <el-form-item :label="`End Date`" :prop="`experience.${index}.end_date`">
                  <el-date-picker
                    v-model="experience.end_date"
                    type="month"
                    placeholder="End Date (or leave empty if current)"
                    size="large"
                    class="form-input"
                    style="width: 100%"
                  />
                </el-form-item>
              </div>

              <el-form-item :label="`Job Description`" :prop="`experience.${index}.description`">
                <el-input
                  v-model="experience.description"
                  type="textarea"
                  :rows="4"
                  placeholder="Describe your responsibilities, achievements, and impact..."
                  size="large"
                  class="form-input"
                />
              </el-form-item>
            </div>
          </template>
        </el-card>

        <!-- Education -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><School /></el-icon>
              <span>Education</span>
              <el-button
                type="primary"
                size="small"
                @click="addEducation"
                class="add-section-btn"
              >
                <el-icon class="mr-2"><Plus /></el-icon>
                Add Education
              </el-button>
            </div>
          </template>

          <template v-for="(education, index) in form.education" :key="index">
            <div class="education-item">
              <div class="education-header">
                <h4 class="education-title">Education #{{ index + 1 }}</h4>
                <el-button
                  v-if="form.education.length > 1"
                  type="danger"
                  size="small"
                  @click="removeEducation(index)"
                  class="remove-btn"
                >
                  <el-icon><Delete /></el-icon>
                </el-button>
              </div>

              <div class="form-grid">
                <el-form-item :label="`Degree`" :prop="`education.${index}.degree`">
                  <el-input
                    v-model="education.degree"
                    placeholder="e.g., Bachelor of Science in Computer Science"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Institution`" :prop="`education.${index}.institution`">
                  <el-input
                    v-model="education.institution"
                    placeholder="e.g., University of California"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Field of Study`" :prop="`education.${index}.field`">
                  <el-input
                    v-model="education.field"
                    placeholder="e.g., Computer Science"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Graduation Date`" :prop="`education.${index}.graduation_date`">
                  <el-date-picker
                    v-model="education.graduation_date"
                    type="month"
                    placeholder="Graduation Date"
                    size="large"
                    class="form-input"
                    style="width: 100%"
                  />
                </el-form-item>

                <el-form-item :label="`GPA (Optional)`" :prop="`education.${index}.gpa`">
                  <el-input
                    v-model="education.gpa"
                    placeholder="e.g., 3.8"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>
              </div>
            </div>
          </template>
        </el-card>

        <!-- Skills -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><Star /></el-icon>
              <span>Skills</span>
              <el-button
                type="primary"
                size="small"
                @click="addSkill"
                class="add-section-btn"
              >
                <el-icon class="mr-2"><Plus /></el-icon>
                Add Skill
              </el-button>
            </div>
          </template>

          <div class="skills-container">
            <div v-for="(skill, index) in form.skills" :key="index" class="skill-item">
              <div class="skill-inputs">
                <el-form-item :label="`Skill ${index + 1}`" :prop="`skills.${index}.name`">
                  <el-select
                    v-model="skill.name"
                    filterable
                    allow-create
                    default-first-option
                    placeholder="Select or type skill name"
                    size="large"
                    style="width: 100%"
                    class="form-select"
                  >
                    <el-option
                      v-for="skillName in commonSkills"
                      :key="skillName"
                      :label="skillName"
                      :value="skillName"
                    />
                  </el-select>
                </el-form-item>
                
                <el-form-item label="Level" :prop="`skills.${index}.level`">
                  <el-select
                    v-model="skill.level"
                    placeholder="Select skill level"
                    size="large"
                    style="width: 100%"
                    class="form-select"
                  >
                    <el-option label="Beginner" value="beginner" />
                    <el-option label="Intermediate" value="intermediate" />
                    <el-option label="Advanced" value="advanced" />
                    <el-option label="Expert" value="expert" />
                  </el-select>
                </el-form-item>
              </div>
              
              <el-button
                v-if="form.skills.length > 1"
                type="danger"
                size="small"
                @click="removeSkill(index)"
                class="remove-btn"
              >
                <el-icon><Delete /></el-icon>
              </el-button>
            </div>
            
            <el-button
              type="primary"
              size="large"
              @click="addSkill"
              class="add-btn"
            >
              <el-icon class="mr-2"><Plus /></el-icon>
              Add Skill
            </el-button>
          </div>
        </el-card>

        <!-- AI Optimization -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><MagicStick /></el-icon>
              <span>AI Optimization</span>
            </div>
          </template>
          <AIOptimization :resume-id="resume.id" />
        </el-card>

        <!-- Job-Specific Tailoring -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><Aim /></el-icon>
              <span>Job-Specific Tailoring</span>
            </div>
          </template>
          <JobTailoring :resume-id="resume.id" />
        </el-card>

        <!-- Submit Button -->
        <div class="form-actions">
          <el-button
            @click="$inertia.visit(route('resumes.show', resume.id))"
            size="large"
            class="cancel-btn"
          >
            Cancel
          </el-button>
          
          <el-button
            type="primary"
            size="large"
            :loading="isSubmitting"
            @click="submitForm"
            class="submit-btn"
          >
            {{ isSubmitting ? 'Updating...' : 'Update Resume' }}
          </el-button>
        </div>
      </el-form>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/app/AppSidebarLayout.vue'
import type { BreadcrumbItemType } from '@/types'
import AIOptimization from '@/components/AIOptimization.vue'
import TemplateSelector from '@/components/TemplateSelector.vue'
import JobTailoring from '@/components/JobTailoring.vue'
import { 
  InfoFilled, 
  User, 
  Briefcase, 
  School, 
  Star, 
  MagicStick, 
  Aim,
  Plus, 
  Delete, 
  View 
} from '@element-plus/icons-vue'

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
    title: 'Edit Resume',
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
    linkedin?: string
    website?: string
    summary: string
  }
  education: Array<{
    degree: string
    institution: string
    field: string
    graduation_date: string
    gpa: string
  }>
  experience: Array<{
    title: string
    company: string
    start_date: string
    end_date: string
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
const formRef = ref()
const isSubmitting = ref(false)

// Common skills for suggestions
const commonSkills = [
  'JavaScript', 'Python', 'Java', 'C++', 'C#', 'PHP', 'Ruby', 'Go', 'Rust',
  'React', 'Vue.js', 'Angular', 'Node.js', 'Express', 'Django', 'Laravel',
  'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'AWS', 'Azure', 'Docker',
  'Kubernetes', 'Git', 'Linux', 'Agile', 'Scrum', 'Project Management',
  'Data Analysis', 'Machine Learning', 'AI', 'UI/UX Design', 'Graphic Design'
]

const form = useForm({
  title: '',
  template: 'modern',
  personal_info: {
    full_name: '',
    email: '',
    phone: '',
    location: '',
    linkedin: '',
    website: '',
    summary: ''
  },
  education: [
    {
      degree: '',
      institution: '',
      field: '',
      graduation_date: '',
      gpa: ''
    }
  ],
  experience: [
    {
      title: '',
      company: '',
      start_date: '',
      end_date: '',
      description: ''
    }
  ],
  skills: [
    {
      name: '',
      level: 'intermediate'
    }
  ],
  certifications: [] as Array<{
    name: string
    issuer: string
    date: string
  }>,
  social_links: [] as Array<{
    platform: string
    url: string
  }>,
  additional_sections: [] as Array<{
    title: string
    items: Array<{
      name: string
      date?: string
    }>
  }>
})

// Validation rules
const rules = {
  title: [{ required: true, message: 'Please enter resume title', trigger: 'blur' }],
  'personal_info.full_name': [{ required: true, message: 'Please enter full name', trigger: 'blur' }],
  'personal_info.email': [
    { required: true, message: 'Please enter email', trigger: 'blur' },
    { type: 'email', message: 'Please enter valid email', trigger: 'blur' }
  ],
  'personal_info.phone': [{ required: true, message: 'Please enter phone number', trigger: 'blur' }],
  'personal_info.location': [{ required: true, message: 'Please enter location', trigger: 'blur' }],
  'education.0.institution': [{ required: true, message: 'Please enter institution', trigger: 'blur' }],
  'education.0.degree': [{ required: true, message: 'Please enter degree', trigger: 'blur' }],
  'education.0.field': [{ required: true, message: 'Please enter field of study', trigger: 'blur' }],
  'education.0.graduation_date': [{ required: true, message: 'Please enter graduation date', trigger: 'blur' }],
  'experience.0.company': [{ required: true, message: 'Please enter company', trigger: 'blur' }],
  'experience.0.title': [{ required: true, message: 'Please enter job title', trigger: 'blur' }],
  'experience.0.start_date': [{ required: true, message: 'Please enter start date', trigger: 'blur' }],
  'experience.0.description': [{ required: true, message: 'Please enter job description', trigger: 'blur' }],
  'skills.0.name': [{ required: true, message: 'Please enter skill name', trigger: 'blur' }],
  'skills.0.level': [{ required: true, message: 'Please select skill level', trigger: 'change' }]
}

// Watch for changes in props.resume and update form accordingly
watch(() => props.resume, (newResume) => {
  if (newResume) {
    form.title = newResume.title || ''
    form.template = newResume.template || 'modern'
    form.personal_info = {
      full_name: newResume.personal_info?.full_name || '',
      email: newResume.personal_info?.email || '',
      phone: newResume.personal_info?.phone || '',
      location: newResume.personal_info?.location || '',
      linkedin: newResume.personal_info?.linkedin || '',
      website: newResume.personal_info?.website || '',
      summary: newResume.personal_info?.summary || ''
    }
    form.education = newResume.education && newResume.education.length > 0 
      ? [...newResume.education] 
      : [{
          degree: '',
          institution: '',
          field: '',
          graduation_date: '',
          gpa: ''
        }]
    form.experience = newResume.experience && newResume.experience.length > 0 
      ? [...newResume.experience] 
      : [{
          title: '',
          company: '',
          start_date: '',
          end_date: '',
          description: ''
        }]
    form.skills = newResume.skills && newResume.skills.length > 0 
      ? [...newResume.skills] 
      : [{
          name: '',
          level: 'intermediate'
        }]
    form.certifications = newResume.certifications || []
    form.social_links = newResume.social_links || []
    form.additional_sections = newResume.additional_sections || []
  }
}, { immediate: true, deep: true })

onMounted(() => {
  // Also populate on mount as fallback
  if (props.resume) {
    form.title = props.resume.title || ''
    form.template = props.resume.template || 'modern'
    form.personal_info = {
      full_name: props.resume.personal_info?.full_name || '',
      email: props.resume.personal_info?.email || '',
      phone: props.resume.personal_info?.phone || '',
      location: props.resume.personal_info?.location || '',
      linkedin: props.resume.personal_info?.linkedin || '',
      website: props.resume.personal_info?.website || '',
      summary: props.resume.personal_info?.summary || ''
    }
    form.education = props.resume.education && props.resume.education.length > 0 
      ? [...props.resume.education] 
      : [{
          degree: '',
          institution: '',
          field: '',
          graduation_date: '',
          gpa: ''
        }]
    form.experience = props.resume.experience && props.resume.experience.length > 0 
      ? [...props.resume.experience] 
      : [{
          title: '',
          company: '',
          start_date: '',
          end_date: '',
          description: ''
        }]
    form.skills = props.resume.skills && props.resume.skills.length > 0 
      ? [...props.resume.skills] 
      : [{
          name: '',
          level: 'intermediate'
        }]
    form.certifications = props.resume.certifications || []
    form.social_links = props.resume.social_links || []
    form.additional_sections = props.resume.additional_sections || []
  }
})

const addEducation = () => {
  form.education.push({
    degree: '',
    institution: '',
    field: '',
    graduation_date: '',
    gpa: ''
  })
}

const removeEducation = (index: number) => {
  if (form.education.length > 1) {
    form.education.splice(index, 1)
  }
}

const addExperience = () => {
  form.experience.push({
    title: '',
    company: '',
    start_date: '',
    end_date: '',
    description: ''
  })
}

const removeExperience = (index: number) => {
  if (form.experience.length > 1) {
    form.experience.splice(index, 1)
  }
}

const addSkill = () => {
  form.skills.push({
    name: '',
    level: 'intermediate'
  })
}

const removeSkill = (index: number) => {
  if (form.skills.length > 1) {
    form.skills.splice(index, 1)
  }
}

const submitForm = async () => {
  if (!formRef.value) return
  
  try {
    await formRef.value.validate()
    isSubmitting.value = true
    
    // Filter out empty skills before submission
    if (form.skills && Array.isArray(form.skills)) {
      form.skills = form.skills.filter(skill => 
        skill.name && skill.name.trim() !== '' && skill.level && skill.level.trim() !== ''
      );
    }
    
    // Add debugging to see what route is being called
    console.log('Edit.vue: Submitting to route:', route('resumes.update', props.resume.id));
    console.log('Edit.vue: Current URL:', window.location.href);
    console.log('Edit.vue: Resume ID:', props.resume.id);
    console.log('Edit.vue: Filtered skills:', form.skills);
    
    form.put(route('resumes.update', props.resume.id), {
      onSuccess: () => {
        console.log('Edit.vue: Resume updated successfully');
      },
      onError: () => {
        console.log('Edit.vue: Error updating resume');
      },
      onFinish: () => {
        isSubmitting.value = false;
      },
    });
  } catch (error) {
    console.error('Form validation failed:', error);
  }
}
</script>

<style scoped>
.create-resume-page {
  max-width: 1200px;
  margin: 0 auto;
}

.page-header {
  margin-bottom: 2rem;
  padding: 2rem;
  background: linear-gradient(135deg, var(--el-color-primary) 0%, var(--el-color-primary-light-7) 100%);
  border-radius: 16px;
  color: white;
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}

.header-text {
  flex: 1;
}

.page-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  line-height: 1.2;
}

.page-subtitle {
  font-size: 1.125rem;
  opacity: 0.9;
  line-height: 1.5;
}

.back-btn {
  background: rgba(255, 255, 255, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: white;
  backdrop-filter: blur(10px);
}

.back-btn:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.5);
}

.resume-form {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.form-section {
  border: none;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  background: var(--el-bg-color);
  border: 1px solid var(--el-border-color-light);
}

.form-section:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.section-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--el-text-color-primary);
}

.section-icon {
  font-size: 1.5rem;
  color: var(--el-color-primary);
}

.add-section-btn {
  margin-left: auto;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.form-input {
  width: 100%;
}

.form-select {
  width: 100%;
}

.experience-item,
.education-item {
  padding: 1.5rem;
  border: 1px solid var(--el-border-color-light);
  border-radius: 12px;
  margin-bottom: 1.5rem;
  background: var(--el-fill-color-light);
}

.experience-header,
.education-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.experience-title,
.education-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--el-text-color-primary);
  margin: 0;
}

.remove-btn {
  color: var(--el-color-danger);
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 2rem 0;
}

.cancel-btn {
  border: 1px solid var(--el-border-color);
  color: var(--el-text-color-regular);
}

.submit-btn {
  min-width: 150px;
}

.skills-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.skill-item {
  display: flex;
  align-items: flex-end;
  gap: 1rem;
  padding: 1rem;
  border: 1px solid var(--el-border-color-light);
  border-radius: 8px;
  background: var(--el-fill-color-light);
}

.skill-inputs {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  flex: 1;
}

.remove-btn {
  align-self: center;
}

.add-btn {
  align-self: flex-start;
  margin-top: 1rem;
}

@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    text-align: center;
  }
  
  .form-grid {
    grid-template-columns: 1fr;
  }
  
  .skill-inputs {
    grid-template-columns: 1fr;
  }
  
  .form-actions {
    flex-direction: column;
  }
}
</style>
