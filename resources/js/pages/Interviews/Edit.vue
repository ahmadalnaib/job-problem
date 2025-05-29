<template>
          <AppLayout >
  <div class=" mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Interview</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="job_application_id">Job Application</label>
        <select
          v-model="form.job_application_id"
          id="job_application_id"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option v-for="application in jobApplications" :key="application.id" :value="application.id">
            {{ application.company }} - {{ application.position }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="scheduled_at">Scheduled At</label>
        <input
          v-model="form.scheduled_at"
          id="scheduled_at"
          type="datetime-local"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
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
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200"
      >
        Update
      </button>
    </form>
  </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';
const props = defineProps({
  interview: Object,
  jobApplications: Array,
})

const form = useForm({
  job_application_id: props.interview.job_application_id,
  scheduled_at: props.interview.scheduled_at,
  location: props.interview.location,
})

const submit = () => {
  form.put(`/interviews/${props.interview.id}`)
}
</script>
