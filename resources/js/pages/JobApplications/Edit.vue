<template>
        <AppLayout >
  <div class=" mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Job Application</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="company">Company</label>
        <input
          v-model="form.company"
          id="company"
          type="text"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter company name"
        />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="position">Position</label>
        <input
          v-model="form.position"
          id="position"
          type="text"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter position"
        />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="applied_at">Applied At</label>
        <input
          v-model="form.applied_at"
          id="applied_at"
          type="date"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2" for="status">Status</label>
        <select
          v-model="form.status"
          id="status"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="pending">Pending</option>
          <option value="accepted">Accepted</option>
          <option value="rejected">Rejected</option>
        </select>
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
  jobApplication: Object,
})

const form = useForm({
  company: props.jobApplication.company,
  position: props.jobApplication.position,
  applied_at: props.jobApplication.applied_at,
  status: props.jobApplication.status,
})

const submit = () => {
  form.put(`/job-applications/${props.jobApplication.id}`)
}
</script>
