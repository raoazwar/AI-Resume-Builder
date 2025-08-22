<template>
  <el-card class="feedback-card" shadow="hover">
    <template #header>
      <div class="card-header">
        <el-icon class="header-icon"><ChatDotRound /></el-icon>
        <span>Share Your Feedback</span>
      </div>
    </template>
    
    <div class="feedback-content">
      <div class="rating-section">
        <span class="rating-label">Rate your experience:</span>
        <div class="rating-stars">
          <el-rate
            v-model="rating"
            :max="5"
            :colors="['#99A9BF', '#F7BA2A', '#FF9900']"
            show-score
            score-template="{value}"
          />
        </div>
      </div>

      <el-form @submit.prevent="submitFeedback" class="feedback-form">
        <el-form-item label="Feedback Type">
          <el-select
            v-model="feedbackType"
            placeholder="Select feedback type"
            style="width: 100%"
          >
            <el-option label="General Feedback" value="general" />
            <el-option label="Bug Report" value="bug" />
            <el-option label="Feature Request" value="feature" />
            <el-option label="Improvement Suggestion" value="improvement" />
          </el-select>
        </el-form-item>

        <el-form-item label="Your Message">
          <el-input
            v-model="message"
            type="textarea"
            :rows="4"
            placeholder="Tell us what you think about the resume builder..."
            maxlength="500"
            show-word-limit
          />
        </el-form-item>

        <el-form-item>
          <el-checkbox v-model="allowContact">
            Allow us to contact you for follow-up
          </el-checkbox>
        </el-form-item>

        <el-form-item>
          <el-button
            type="primary"
            @click="submitFeedback"
            :loading="isSubmitting"
            class="submit-btn"
          >
            {{ isSubmitting ? 'Submitting...' : 'Submit Feedback' }}
          </el-button>
        </el-form-item>
      </el-form>

      <!-- Success Message -->
      <el-alert
        v-if="showSuccess"
        title="Thank you for your feedback!"
        type="success"
        description="We appreciate your input and will use it to improve our service."
        show-icon
        :closable="false"
        class="success-alert"
      />
    </div>
  </el-card>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { ChatDotRound } from '@element-plus/icons-vue';

const rating = ref(5);
const feedbackType = ref('general');
const message = ref('');
const allowContact = ref(false);
const isSubmitting = ref(false);
const showSuccess = ref(false);

const submitFeedback = async () => {
  if (!message.value.trim()) {
    return;
  }

  isSubmitting.value = true;
  
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    showSuccess.value = true;
    message.value = '';
    feedbackType.value = 'general';
    rating.value = 5;
    allowContact.value = false;
    
    // Hide success message after 5 seconds
    setTimeout(() => {
      showSuccess.value = false;
    }, 5000);
  } catch (error) {
    console.error('Failed to submit feedback:', error);
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
.feedback-card {
  border: none;
  border-radius: 16px;
  overflow: hidden;
  background: var(--el-bg-color);
  border: 1px solid var(--el-border-color-light);
}

.card-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--el-text-color-primary);
}

.header-icon {
  font-size: 1.25rem;
  color: var(--el-color-primary);
}

.feedback-content {
  padding: 1.5rem;
}

.rating-section {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
  padding: 1rem;
  background: var(--el-fill-color-light);
  border-radius: 12px;
  border: 1px solid var(--el-border-color-light);
}

.rating-label {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--el-text-color-regular);
}

.rating-stars {
  display: flex;
  align-items: center;
}

.feedback-form {
  margin-bottom: 1.5rem;
}

.submit-btn {
  width: 100%;
  height: 40px;
}

.success-alert {
  margin-top: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .rating-section {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }
  
  .feedback-content {
    padding: 1rem;
  }
}
</style>
