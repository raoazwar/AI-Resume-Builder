<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="create-resume-page">
      <!-- Header -->
      <div class="page-header">
        <div class="header-content">
          <div class="header-text">
            <h1 class="page-title">Create Your Professional Resume</h1>
            <p class="page-subtitle">Build a standout resume with AI-powered optimization and modern templates</p>
          </div>
          <el-button
            type="primary"
            size="large"
            @click="$inertia.visit(route('resumes.index'))"
            class="back-btn"
          >
            <el-icon class="mr-2"><ArrowLeft /></el-icon>
            Back to Resumes
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
                type="url"
                class="form-input"
              />
            </el-form-item>

            <el-form-item label="Website" prop="personal_info.website">
              <el-input
                v-model="form.personal_info.website"
                placeholder="https://johndoe.com"
                size="large"
                clearable
                type="url"
                class="form-input"
              />
            </el-form-item>
          </div>
        </el-card>

        <!-- Professional Summary -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><Document /></el-icon>
              <span>Professional Summary</span>
            </div>
          </template>

          <el-form-item label="Summary" prop="summary">
            <el-input
              v-model="form.summary"
              type="textarea"
              :rows="4"
              placeholder="Write a compelling professional summary that highlights your key strengths and career objectives..."
              size="large"
              maxlength="500"
              show-word-limit
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
            </div>
          </template>

          <div class="experience-list">
            <div
              v-for="(experience, index) in form.experience"
              :key="index"
              class="experience-item"
            >
              <div class="experience-header">
                <h4 class="experience-title">Experience {{ index + 1 }}</h4>
                <el-button
                  type="danger"
                  size="small"
                  @click="removeExperience(index)"
                  :icon="Delete"
                  circle
                />
              </div>

              <div class="form-grid">
                <el-form-item :label="`Company Name`" :prop="`experience.${index}.company`">
                  <el-input
                    v-model="experience.company"
                    placeholder="Company Name"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Job Title`" :prop="`experience.${index}.title`">
                  <el-input
                    v-model="experience.title"
                    placeholder="Job Title"
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
                    style="width: 100%"
                    class="form-date-picker"
                    format="YYYY-MM"
                    value-format="YYYY-MM"
                  />
                </el-form-item>

                <el-form-item :label="`End Date`" :prop="`experience.${index}.end_date`">
                  <el-date-picker
                    v-model="experience.end_date"
                    type="month"
                    placeholder="End Date"
                    size="large"
                    style="width: 100%"
                    class="form-date-picker"
                    format="YYYY-MM"
                    value-format="YYYY-MM"
                  />
                </el-form-item>

                <el-form-item :label="`Description`" :prop="`experience.${index}.description`" class="full-width">
                  <el-input
                    v-model="experience.description"
                    type="textarea"
                    :rows="3"
                    placeholder="Describe your responsibilities and achievements..."
                    size="large"
                    maxlength="300"
                    show-word-limit
                    class="form-input"
                  />
                </el-form-item>
              </div>
            </div>

            <el-button
              type="primary"
              plain
              @click="addExperience"
              class="add-experience-btn"
            >
              <el-icon class="mr-2"><Plus /></el-icon>
              Add Experience
            </el-button>
          </div>
        </el-card>

        <!-- Education -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><School /></el-icon>
              <span>Education</span>
            </div>
          </template>

          <div class="education-list">
            <div
              v-for="(education, index) in form.education"
              :key="index"
              class="education-item"
            >
              <div class="education-header">
                <h4 class="education-title">Education {{ index + 1 }}</h4>
                <el-button
                  type="danger"
                  size="small"
                  @click="removeEducation(index)"
                  :icon="Delete"
                  circle
                />
              </div>

              <div class="form-grid">
                <el-form-item :label="`Institution`" :prop="`education.${index}.institution`">
                  <el-input
                    v-model="education.institution"
                    placeholder="University/College Name"
                    size="large"
                    clearable
                    class="form-input"
                  />
                </el-form-item>

                <el-form-item :label="`Degree`" :prop="`education.${index}.degree`">
                  <el-input
                    v-model="education.degree"
                    placeholder="e.g., Bachelor of Science"
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
                    style="width: 100%"
                    class="form-date-picker"
                    format="YYYY-MM"
                    value-format="YYYY-MM"
                  />
                </el-form-item>

                <el-form-item :label="`GPA`" :prop="`education.${index}.gpa`">
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

            <el-button
              type="primary"
              plain
              @click="addEducation"
              class="add-education-btn"
            >
              <el-icon class="mr-2"><Plus /></el-icon>
              Add Education
            </el-button>
          </div>
        </el-card>

        <!-- Skills -->
        <el-card class="form-section" shadow="hover">
          <template #header>
            <div class="section-header">
              <el-icon class="section-icon"><Star /></el-icon>
              <span>Skills</span>
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
        <AIOptimization />

        <!-- Job Tailoring -->
        <JobTailoring />

        <!-- Form Actions -->
        <div class="form-actions">
          <el-button
            type="info"
            size="large"
            @click="$inertia.visit(route('resumes.index'))"
          >
            Cancel
          </el-button>

          <el-button
            type="primary"
            size="large"
            @click="submitForm"
            :loading="isSubmitting"
            class="submit-btn"
          >
            <el-icon class="mr-2"><Check /></el-icon>
            Create Resume
          </el-button>
        </div>
      </el-form>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { 
  ArrowLeft, 
  InfoFilled, 
  User, 
  Document, 
  Briefcase, 
  School, 
  Star, 
  Plus, 
  Delete, 
  Check 
} from '@element-plus/icons-vue';
import TemplateSelector from '@/components/TemplateSelector.vue';
import AIOptimization from '@/components/AIOptimization.vue';
import JobTailoring from '@/components/JobTailoring.vue';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Resumes',
    href: '/resumes',
  },
  {
    title: 'Create',
    href: '/resumes/create',
  },
];

const formRef = ref();
const isSubmitting = ref(false);

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
    summary: '',
  },
  experience: [
    {
      company: '',
      title: '',
      start_date: '',
      end_date: '',
      description: '',
    },
  ],
  education: [
    {
      institution: '',
      degree: '',
      field: '',
      graduation_date: '',
      gpa: '',
    },
  ],
  skills: [
    {
      name: '',
      level: 'intermediate'
    }
  ],
  certifications: [],
  social_links: [],
  additional_sections: [],
});

const commonSkills = [
  'JavaScript', 'Python', 'React', 'Vue.js', 'Node.js', 'Laravel',
  'MySQL', 'PostgreSQL', 'MongoDB', 'Docker', 'AWS', 'Git',
  'Project Management', 'Leadership', 'Communication', 'Problem Solving',
  'Agile', 'Scrum', 'UI/UX Design', 'Data Analysis'
];

const rules = {
  title: [
    { required: true, message: 'Please enter a resume title', trigger: 'blur' },
  ],
  'personal_info.full_name': [
    { required: true, message: 'Please enter your full name', trigger: 'blur' },
  ],
  'personal_info.email': [
    { required: true, message: 'Please enter your email', trigger: 'blur' },
    { type: 'email', message: 'Please enter a valid email address', trigger: 'blur' },
  ],
  'personal_info.phone': [
    { required: true, message: 'Please enter your phone number', trigger: 'blur' },
  ],
  'personal_info.location': [
    { required: true, message: 'Please enter your location', trigger: 'blur' },
  ],
};

const addExperience = () => {
  form.experience.push({
    company: '',
    title: '',
    start_date: '',
    end_date: '',
    description: '',
  });
};

const removeExperience = (index: number) => {
  form.experience.splice(index, 1);
};

const addEducation = () => {
  form.education.push({
    institution: '',
    degree: '',
    field: '',
    graduation_date: '',
    gpa: '',
  });
};

const removeEducation = (index: number) => {
  form.education.splice(index, 1);
};

const addSkill = () => {
  form.skills.push({
    name: '',
    level: 'intermediate'
  });
};

const removeSkill = (index: number) => {
  if (form.skills.length > 1) {
    form.skills.splice(index, 1);
  }
};

const submitForm = async () => {
  if (!formRef.value) return;
  
  try {
    await formRef.value.validate();
    isSubmitting.value = true;
    
    // Filter out empty skills before submission
    if (form.skills && Array.isArray(form.skills)) {
      form.skills = form.skills.filter(skill => 
        skill.name && skill.name.trim() !== '' && skill.level && skill.level.trim() !== ''
      );
    }
    
    // Add debugging to see what route is being called
    console.log('Create.vue: Submitting to route:', route('resumes.store'));
    console.log('Create.vue: Current URL:', window.location.href);
    console.log('Create.vue: Filtered skills:', form.skills);
    
    form.post(route('resumes.store'), {
      onSuccess: () => {
        // Handle success
        console.log('Create.vue: Resume created successfully');
      },
      onError: () => {
        // Handle error
        console.log('Create.vue: Error creating resume');
      },
      onFinish: () => {
        isSubmitting.value = false;
      },
    });
  } catch (error) {
    console.error('Form validation failed:', error);
  }
};
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
  color: var(--el-color-primary);
  background: linear-gradient(135deg, var(--el-color-primary-light-9) 0%, var(--el-color-primary-light-8) 100%);
  padding: 1rem 1.5rem;
  border-bottom: 1px solid var(--el-border-color-light);
}

.section-icon {
  font-size: 1.5rem;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
}

.full-width {
  grid-column: 1 / -1;
}

/* Form Input Styling */
.form-input {
  width: 100%;
}

.form-input :deep(.el-input__wrapper) {
  height: 48px;
  border-radius: 8px;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-input :deep(.el-input__wrapper:hover) {
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.form-input :deep(.el-input__wrapper.is-focus) {
  box-shadow: 0 0 0 2px var(--el-color-primary-light-5);
}

.form-input :deep(.el-textarea__inner) {
  border-radius: 8px;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  min-height: 120px;
}

.form-input :deep(.el-textarea__inner:hover) {
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.form-input :deep(.el-textarea__inner:focus) {
  box-shadow: 0 0 0 2px var(--el-color-primary-light-5);
}

/* Date Picker Styling */
.form-date-picker {
  width: 100%;
}

.form-date-picker :deep(.el-input__wrapper) {
  height: 48px;
  border-radius: 8px;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-date-picker :deep(.el-input__wrapper:hover) {
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.form-date-picker :deep(.el-input__wrapper.is-focus) {
  box-shadow: 0 0 0 2px var(--el-color-primary-light-5);
}

/* Select Styling */
.form-select {
  width: 100%;
}

.form-select :deep(.el-input__wrapper) {
  height: 48px;
  border-radius: 8px;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-select :deep(.el-input__wrapper:hover) {
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.form-select :deep(.el-input__wrapper.is-focus) {
  box-shadow: 0 0 0 2px var(--el-color-primary-light-5);
}

/* Form Item Styling */
:deep(.el-form-item__label) {
  font-weight: 600;
  color: var(--el-text-color-primary);
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
}

:deep(.el-form-item) {
  margin-bottom: 1.5rem;
}

.experience-list,
.education-list {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  padding: 1.5rem;
}

.experience-item,
.education-item {
  padding: 1.5rem;
  border: 1px solid var(--el-border-color-light);
  border-radius: 12px;
  background: var(--el-fill-color-light);
  transition: all 0.2s ease;
}

.experience-item:hover,
.education-item:hover {
  border-color: var(--el-color-primary-light-5);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.experience-header,
.education-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.experience-title,
.education-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--el-text-color-primary);
  margin: 0;
}

.add-experience-btn,
.add-education-btn {
  width: 100%;
  height: 48px;
  border: 2px dashed var(--el-border-color);
  border-radius: 12px;
  font-weight: 500;
  background: var(--el-fill-color-light);
  color: var(--el-text-color-regular);
}

.add-experience-btn:hover,
.add-education-btn:hover {
  border-color: var(--el-color-primary);
  color: var(--el-color-primary);
  background: var(--el-color-primary-light-9);
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 2rem;
  background: var(--el-bg-color);
  border-radius: 16px;
  border: 1px solid var(--el-border-color-light);
}

.submit-btn {
  min-width: 160px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .page-header {
    padding: 1.5rem;
  }
  
  .header-content {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .page-title {
    font-size: 2rem;
  }
  
  .form-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
    padding: 1rem;
  }
  
  .form-actions {
    flex-direction: column;
    padding: 1.5rem;
  }
  
  .submit-btn {
    width: 100%;
  }
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .experience-item,
  .education-item {
    background: var(--el-bg-color);
    border-color: var(--el-border-color);
  }
  
  .add-experience-btn,
  .add-education-btn {
    background: var(--el-fill-color);
    border-color: var(--el-border-color);
  }
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
</style>
