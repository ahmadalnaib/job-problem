<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';
const props = defineProps({
  note: Object,
  applications: Array
})

const form = useForm({
  job_application_id: props.note.job_application_id,
  content: props.note.content
})

const submit = () => {
  form.put(`/notes/${props.note.id}`)
}
</script>

<template>
<AppLayout>
  <div class=" p-6">
    <h1 class="text-2xl font-semibold mb-4">Edit Note</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Job Application</label>
        <select v-model="form.job_application_id" class="w-full border rounded p-2">
          <option value="">Select...</option>
          <option v-for="app in applications" :value="app.id" :key="app.id">
            {{ app.position }} @ {{ app.company }}
          </option>
        </select>
        <div v-if="form.errors.job_application_id" class="text-red-600 text-sm">{{ form.errors.job_application_id }}</div>
      </div>

      <div>
        <label class="block mb-1 font-medium">Note</label>
        <textarea v-model="form.content" class="w-full border rounded p-2" rows="4"></textarea>
        <div v-if="form.errors.content" class="text-red-600 text-sm">{{ form.errors.content }}</div>
      </div>

      <div class="flex justify-between items-center">
        <Link href="/notes" class="text-gray-600 hover:underline">Cancel</Link>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" :disabled="form.processing">
          Update
        </button>
      </div>
    </form>
  </div>
</AppLayout>
</template>
