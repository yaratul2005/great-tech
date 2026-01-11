@extends('layouts.app')

@section('title', 'Great Ten Technology - Premium Development Solutions')

@section('content')
<div class="pt-20">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-500 via-indigo-600 to-secondary-500 text-white">
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                    Premium <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-white">Development</span> Solutions
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-indigo-100 max-w-2xl mx-auto">
                    WordPress Themes, Plugins, Bot Scripts & Custom Solutions crafted for performance and scalability.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/tools" class="px-8 py-4 rounded-lg bg-white text-primary-600 font-bold hover:bg-gray-100 transition-all transform hover:-translate-y-1 duration-300 shadow-lg hover:shadow-xl">
                        Explore Tools
                    </a>
                    <a href="/docs" class="px-8 py-4 rounded-lg bg-transparent border-2 border-white text-white font-bold hover:bg-white/10 transition-all duration-300">
                        View Documentation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800 dark:text-white">Our Services</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Comprehensive solutions for all your development needs
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- WordPress Theme Card -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-600 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-white">WordPress Themes</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Modern, responsive themes built for performance and SEO optimization.
                    </p>
                    <a href="/themes" class="text-primary-500 hover:text-primary-600 font-medium flex items-center">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- WordPress Plugin Card -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-600 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-secondary-100 dark:bg-secondary-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-white">WordPress Plugins</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Extend your site functionality with our premium plugins.
                    </p>
                    <a href="/plugins" class="text-primary-500 hover:text-primary-600 font-medium flex items-center">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Bot Scripts Card -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-600 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-white">Bot Scripts</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Automated solutions to streamline your business processes.
                    </p>
                    <a href="/bots" class="text-primary-500 hover:text-primary-600 font-medium flex items-center">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Transform Your Project?</h2>
                <p class="text-xl mb-8 text-indigo-100">
                    Join thousands of satisfied customers using our premium solutions.
                </p>
                <a href="/contact" class="inline-block px-8 py-4 rounded-lg bg-white text-primary-600 font-bold hover:bg-gray-100 transition-all transform hover:-translate-y-1 duration-300 shadow-lg hover:shadow-xl">
                    Get Started Today
                </a>
            </div>
        </div>
    </section>
</div>
@endsection