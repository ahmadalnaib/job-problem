<script setup>
import { Dialog, DialogPanel } from '@headlessui/vue';
import {
    ArrowPathIcon,
    BellAlertIcon,
    ChevronRightIcon,
    CloudArrowUpIcon,
    DevicePhoneMobileIcon,
    EnvelopeOpenIcon,
    ServerIcon,
} from '@heroicons/vue/20/solid';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const navigation = [
    { name: 'Product', href: '#' },
    { name: 'Features', href: '#' },
    { name: 'Marketplace', href: '#' },
    { name: 'Company', href: '#' },
];
const primaryFeatures = [
    {
        name: 'All-in-One Job Tracker',
        description: 'Easily organize and monitor every job application, from submission to interview, all in one intuitive dashboard.',
        icon: CloudArrowUpIcon,
    },
    {
        name: 'Smart Interview Scheduling',
        description: 'Never miss an opportunity—schedule interviews, set reminders, and get notified across Web, iOS, and Android.',
        icon: BellAlertIcon,
    },
    {
        name: 'Seamless Multi-Platform Access',
        description: 'Access your job search progress anytime, anywhere—whether you’re on your phone, tablet, or computer.',
        icon: ServerIcon,
    },
];

const secondaryFeatures = [
    {
        name: 'Easy Application Logging',
        description: 'Quickly add and organize all your job applications in one place.',
        icon: CloudArrowUpIcon,
    },
    {
        name: 'Interview Reminders',
        description: 'Get notified about upcoming interviews so you never miss an opportunity.',
        icon: BellAlertIcon,
    },
    {
        name: 'Multi-Platform Sync',
        description: 'Access your job search progress from web, iOS, or Android devices.',
        icon: ServerIcon,
    },
    {
        name: 'Email Notifications',
        description: 'Receive instant email alerts when your interview is about to start.',
        icon: EnvelopeOpenIcon,
    },
    {
        name: 'Phone Notifications',
        description: 'Get phone notifications for interview reminders and updates.',
        icon: DevicePhoneMobileIcon,
    },
    {
        name: 'Status Tracking',
        description: 'Track each application’s status from applied to offer.',
        icon: ArrowPathIcon,
    },
];

const mobileMenuOpen = ref(false);
const currentYear = new Date().getFullYear();
</script>

<template>
    <Head title="HumanHup - Job Application & Interview Management">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="min-h-screen bg-white dark:bg-[#0a0a0a]">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">HumanHup</span>
                        <img class="h-12 w-auto" src="/img/humanhup-logo.png" alt="Humanhup Logo" />
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="hidden gap-2 lg:flex lg:flex-1 lg:justify-end">
                    <Link v-if="$page.props.auth?.user" :href="route('dashboard')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="route('login')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                            Log in <span aria-hidden="true">&rarr;</span>
                        </Link>
                    </template>
                </div>
            </nav>
            <!-- Mobile menu dialog -->
            <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
                <div class="fixed inset-0 z-50" />
                <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">HumanHup</span>
                            <img class="h-8 w-auto" src="/img/humanhup-logo.png" alt="Humanhup Logo" />
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="size-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >{{ item.name }}</a
                                >
                            </div>
                            <div class="flex flex-col gap-2 py-6">
                                <Link
                                    v-if="$page.props.auth?.user"
                                    :href="route('dashboard')"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                >
                                    Dashboard
                                </Link>
                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        :href="route('register')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >
                                        Register
                                    </Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>

        <!-- Hero Section -->
        <div class="relative isolate pt-14">
            <svg
                class="absolute inset-0 -z-10 h-full w-full [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)] stroke-gray-200"
                aria-hidden="true"
            >
                <defs>
                    <pattern id="pattern" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                        <path d="M100 200V.5M.5 .5H200" fill="none" />
                    </pattern>
                </defs>
                <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
                    <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
                </svg>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#pattern)" />
            </svg>
            <div class="mx-auto max-w-7xl px-6 py-16 sm:py-20 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:py-28">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                    <div class="flex">
                        <div
                            class="relative flex items-center gap-x-4 rounded-full bg-white px-4 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20"
                        >
                            <span class="font-semibold text-orange-600">iOS</span>
                            <span class="h-4 w-px bg-gray-900/10" aria-hidden="true" />
                            <span class="font-semibold text-indigo-600">Web</span>
                            <span class="h-4 w-px bg-gray-900/10" aria-hidden="true" />
                            <a href="#" class="flex items-center gap-x-1">
                                <span class="absolute inset-0" aria-hidden="true" />
                                Android
                                <ChevronRightIcon class="-mr-2 size-5 text-gray-400" aria-hidden="true" />
                            </a>
                        </div>
                    </div>
                    <h1 class="mt-10 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-6xl dark:text-gray-100">
                        Job Application & Interview <br />
                        Management Platform
                    </h1>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8 dark:text-gray-300">
                        HumanHup is a web application designed to help you efficiently manage your job search and interviews in one place. Track every
                        application, schedule interviews, and never miss an opportunity.
                    </p>

                    <div class="mt-10 flex items-center gap-x-6">
                        <Link
                            v-if="!$page.props.auth?.user"
                            :href="route('register')"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Get started
                        </Link>
                        <Link v-if="!$page.props.auth?.user" :href="route('login')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                            Log in <span aria-hidden="true">&rarr;</span>
                        </Link>
                        <Link
                            v-if="$page.props.auth?.user"
                            :href="route('dashboard')"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Go to Dashboard
                        </Link>
                    </div>
                </div>
                <div class="mt-16 flex items-center justify-center sm:mt-24 lg:mt-0 lg:shrink-0 lg:grow">
                    <video
                        src="/video/showcase.mp4"
                        autoplay
                        loop
                        muted
                        playsinline
                        class="mx-auto w-[22.875rem] max-w-full rounded-2xl drop-shadow-xl"
                        alt="App demo video"
                    ></video>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature 1 with background like feature 2 -->
    <div class="mx-auto mt-20 max-w-7xl px-6 sm:mt-32 lg:px-8">
        <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-14 sm:rounded-3xl sm:px-10 sm:py-16 lg:py-20 xl:px-24">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base/7 font-semibold text-indigo-400">Opportunities in Motion</h2>
                <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-white sm:text-5xl lg:text-balance">Why Choose HumanHup?</p>
                <p class="mt-6 text-lg/8 text-gray-300">Discover the tools that make your job search and interview process seamless and efficient.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div v-for="feature in primaryFeatures" :key="feature.name" class="flex flex-col">
                        <dt class="text-base/7 font-semibold text-white">
                            <div class="mb-6 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                                <component :is="feature.icon" class="size-6 text-white" aria-hidden="true" />
                            </div>
                            {{ feature.name }}
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base/7 text-gray-300">
                            <p class="flex-auto">{{ feature.description }}</p>
                            <p class="mt-6"></p>
                        </dd>
                    </div>
                </dl>
            </div>
            <div
                class="pointer-events-none absolute top-1/2 left-12 -z-10 -translate-y-1/2 transform-gpu blur-3xl lg:top-auto lg:-bottom-48 lg:translate-y-0 lg:transform-gpu"
                aria-hidden="true"
            >
                <div
                    class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-25"
                    style="
                        clip-path: polygon(
                            74.1% 44.1%,
                            100% 61.6%,
                            97.5% 26.9%,
                            85.5% 0.1%,
                            80.7% 2%,
                            72.5% 32.5%,
                            60.2% 62.4%,
                            52.4% 68.1%,
                            47.5% 58.3%,
                            45.2% 34.5%,
                            27.5% 76.7%,
                            0.1% 64.9%,
                            17.9% 100%,
                            27.6% 76.8%,
                            76.1% 97.7%,
                            74.1% 44.1%
                        );
                    "
                />
            </div>
        </div>
    </div>

    <!-- Feature section -->
    <div class="mt-20 sm:mt-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-base/7 font-semibold text-indigo-400">Everything you need</h2>
                <p class="text-dark mt-2 text-4xl font-semibold tracking-tight text-pretty sm:text-5xl sm:text-balance">
                    Manage Applications & Interviews Easily
                </p>
                <p class="mt-6 text-lg/8 text-gray-500">
                    Add your job applications, schedule interviews, and get instant notifications—all in one place. HumanHup keeps your job search
                    organized and stress-free
                </p>
            </div>
        </div>
        <div class="relative overflow-hidden pt-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <img
                    src="/img/showcase-feature.png"
                    alt="App screenshot"
                    class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-white/10"
                    width="2432"
                    height="1442"
                />
                <div class="relative" aria-hidden="true">
                    <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-gray-200 pt-[7%]" />
                </div>
            </div>
        </div>
        <div class="mx-auto mt-12 max-w-7xl px-6 sm:mt-16 md:mt-20 lg:px-8">
            <dl
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base/7 text-gray-900 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16"
            >
                <div v-for="feature in secondaryFeatures" :key="feature.name" class="relative pl-9">
                    <dt class="text-dark inline font-semibold">
                        <component :is="feature.icon" class="absolute top-1 left-1 size-5 text-indigo-500" aria-hidden="true" />
                        {{ feature.name }}
                    </dt>
                    {{ ' ' }}
                    <dd class="inline">{{ feature.description }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- CTA section -->
    <div class="relative isolate mt-20 rounded-3xl bg-white px-6 py-24 sm:mt-32 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-10 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl" aria-hidden="true">
            <div
                class="aspect-[1108/632] w-[69.25rem] flex-none bg-gradient-to-r from-[#6366f1] to-[#38bdf8] opacity-10"
                style="
                    clip-path: polygon(
                        73.6% 51.7%,
                        91.7% 11.8%,
                        100% 46.4%,
                        97.4% 82.2%,
                        92.5% 84.9%,
                        75.7% 64%,
                        55.3% 47.5%,
                        46.5% 49.4%,
                        45% 62.9%,
                        50.3% 87.2%,
                        21.3% 64.1%,
                        0.1% 100%,
                        5.4% 51.1%,
                        21.4% 63.9%,
                        58.9% 0.2%,
                        73.6% 51.7%
                    );
                "
            />
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">Ready to organize your job search?</h2>
            <p class="mx-auto mt-6 max-w-xl text-lg/8 text-gray-600">
                Add your job applications, schedule interviews, and get instant notifications—all in one place. Start using HumanHup today and never
                miss an opportunity.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link
                    :href="route('register')"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Get started
                </Link>
            </div>
        </div>
    </div>
    <!-- Footer -->
<footer class="relative z-10 bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-y-8 md:flex-row md:items-start">
            <!-- Main navigation -->
            <nav class="flex flex-wrap justify-center gap-x-8 gap-y-3 text-sm/6" aria-label="Footer">
                <Link :href="route('register')" class="text-gray-400 hover:text-white transition">Get started</Link>
                <Link :href="route('privacy')" class="text-gray-400 hover:text-white transition">Privacy</Link>
                <Link :href="route('terms')" class="text-gray-400 hover:text-white transition">Terms</Link>
            </nav>
            <!-- Other apps -->
            <div class="flex flex-col items-center md:items-end">
                <span class="mb-2 text-xs uppercase tracking-widest text-gray-500">Our Apps</span>
                <div class="flex gap-x-4">
                    <a href="https://cheapui.com" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition">CheapUI</a>
                    <a href="https://foota.ai" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition">Foota.ai</a>
                </div>
            </div>
        </div>
<p class="mt-10 text-center text-xs text-gray-500">
  &copy; {{ currentYear }} HumanHup, Inc. All rights reserved.
</p>
    </div>
</footer>
</template>
