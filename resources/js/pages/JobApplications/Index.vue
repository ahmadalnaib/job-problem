<template>
    <AppLayout>
        <div class="px-4 py-10">
            <h1 class="mb-6 text-3xl font-bold text-gray-900">Job Applications</h1>

            <div class="mb-4">
                <Link href="/job-applications/create" class="rounded bg-gray-900 px-4 py-2 text-white shadow transition hover:bg-gray-800">
                    + New Application
                </Link>
            </div>

            <div v-if="jobApplications.length" class="space-y-8">
                <div
                    v-for="application in jobApplications"
                    :key="application.id"
                    class="relative flex flex-col gap-3 rounded-2xl border border-gray-200 bg-white p-6 shadow transition hover:shadow-lg dark:border-gray-700 dark:bg-gray-900"
                >
                    <div class="flex items-center justify-between">
                        <Link
                            :href="`/job-applications/${application.id}`"
                            class="text-xl font-bold text-gray-900 dark:text-gray-100 hover:underline"
                        >
                            {{ application.position }}
                        </Link>
                        <span
                            :class="[
                                'rounded-full px-3 py-1 text-xs font-semibold tracking-wide uppercase',
                                application.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                application.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                application.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                !['pending', 'accepted', 'rejected'].includes(application.status) ? 'bg-gray-100 text-gray-700' : '',
                            ]"
                        >
                            {{ application.status }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 font-medium text-gray-700 dark:text-gray-200">
                        <span>{{ application.company }}</span>
                        <Link
                            v-if="application.notes && application.notes.length > 0"
                            :href="`/notes?job_application_id=${application.id}`"
                            class="inline-flex items-center gap-1 rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-800 transition hover:bg-gray-300 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            <span class="text-base">📝</span>
                            Note attached
                        </Link>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Applied: {{ formatDate(application.applied_at) }}</div>
                    <div class="mt-2 flex gap-4">
                        <Link
                            :href="`/job-applications/${application.id}/edit`"
                            class="rounded bg-gray-100 px-3 py-1 font-medium text-gray-900 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            Edit
                        </Link>
                        <button
                            @click="deleteApplication(application.id)"
                            class="rounded bg-gray-100 px-3 py-1 font-medium text-red-600 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <p v-else class="mt-8 text-gray-500">No job applications found.</p>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    jobApplications: Array,
});

const formatDate = (dateStr) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateStr).toLocaleDateString(undefined, options);
};

const deleteApplication = (id) => {
    if (confirm('Are you sure you want to delete this application?')) {
        router.delete(`/job-applications/${id}`);
    }
};
</script>