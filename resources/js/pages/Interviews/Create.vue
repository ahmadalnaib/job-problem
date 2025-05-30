<template>
  <AppLayout>
    <div class="mt-10 p-6 bg-white shadow-md rounded-lg">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Schedule New Interview</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2" for="job_application_id">Job Application</label>
          <select
            v-model="form.job_application_id"
            id="job_application_id"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="" disabled>Select a job application</option>
            <option v-for="application in jobApplications" :key="application.id" :value="application.id">
              {{ application.company }} - {{ application.position }}
            </option>
          </select>
          <p v-if="form.errors.job_application_id" class="text-red-600 text-sm mt-1">{{ form.errors.job_application_id }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2" for="scheduled_at">Scheduled At</label>
          <input
            v-model="form.scheduled_at"
            id="scheduled_at"
            type="datetime-local"
            :min="minDateTime"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p v-if="form.errors.scheduled_at" class="text-red-600 text-sm mt-1">{{ form.errors.scheduled_at }}</p>
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-2" for="location">Location</label>
          <input
            v-model="form.location"
            id="location"
            type="text"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter location"
          />
          <p v-if="form.errors.location" class="text-red-600 text-sm mt-1">{{ form.errors.location }}</p>
        </div>

        <button
          type="submit"
          class="bg-gray-900 text-white px-6 py-2 rounded hover:bg-gray-700 transition duration-200 shadow-lg"
        >
          Schedule Interview
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  jobApplications: Array,
})

const pad = n => n < 10 ? '0' + n : n
const now = new Date()
const minDateTime = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`

const form = useForm({
  job_application_id: '',
  scheduled_at: '',
  location: '',
})

const submit = () => {
  form.post('/interviews')
}
</script>