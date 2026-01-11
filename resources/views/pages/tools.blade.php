@extends('layouts.app')

@section('title', 'Our Tools - Great Ten Technology')

@section('content')
<div class="pt-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Our Products & Tools</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Discover our collection of WordPress themes, plugins, scripts and other development tools
            </p>
        </div>

        <!-- Search and Filters -->
        <div class="mb-10 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-grow max-w-md">
                    <input 
                        x-model="searchTerm" 
                        type="text" 
                        placeholder="Search tools..." 
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button 
                        @click="filterCategory = ''" 
                        :class="{ 'bg-primary-500 text-white': filterCategory === '', 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200': filterCategory !== '' }"
                        class="px-4 py-2 rounded-lg transition-colors"
                    >
                        All
                    </button>
                    <button 
                        @click="filterCategory = 'wordpress-theme'" 
                        :class="{ 'bg-primary-500 text-white': filterCategory === 'wordpress-theme', 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200': filterCategory !== 'wordpress-theme' }"
                        class="px-4 py-2 rounded-lg transition-colors"
                    >
                        Themes
                    </button>
                    <button 
                        @click="filterCategory = 'wordpress-plugin'" 
                        :class="{ 'bg-primary-500 text-white': filterCategory === 'wordpress-plugin', 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200': filterCategory !== 'wordpress-plugin' }"
                        class="px-4 py-2 rounded-lg transition-colors"
                    >
                        Plugins
                    </button>
                    <button 
                        @click="filterCategory = 'bot-script'" 
                        :class="{ 'bg-primary-500 text-white': filterCategory === 'bot-script', 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200': filterCategory !== 'bot-script' }"
                        class="px-4 py-2 rounded-lg transition-colors"
                    >
                        Bots
                    </button>
                    <button 
                        @click="filterCategory = 'documentation'" 
                        :class="{ 'bg-primary-500 text-white': filterCategory === 'documentation', 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200': filterCategory !== 'documentation' }"
                        class="px-4 py-2 rounded-lg transition-colors"
                    >
                        Docs
                    </button>
                </div>
            </div>
        </div>

        <!-- Tools Grid -->
        <div x-data="toolsData()" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <template x-for="tool in filteredTools" :key="tool.id">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <span 
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
                                    :class="{
                                        'bg-blue-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200': tool.category === 'wordpress-theme',
                                        'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': tool.category === 'wordpress-plugin',
                                        'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': tool.category === 'bot-script',
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': tool.category === 'documentation'
                                    }"
                                    x-text="tool.categoryLabel"
                                ></span>
                                <h3 class="mt-3 text-xl font-bold text-gray-800 dark:text-white" x-text="tool.name"></h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300" x-text="tool.description"></p>
                            </div>
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                        </div>
                        
                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-2xl font-bold text-gray-800 dark:text-white" x-show="tool.price > 0" x-text="'$' + tool.price"></span>
                            <span class="text-2xl font-bold text-gray-800 dark:text-white" x-show="tool.price === 0">Free</span>
                            
                            <div class="flex space-x-2">
                                <button 
                                    @click="showModal(tool)"
                                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                                >
                                    Preview
                                </button>
                                <a 
                                    :href="tool.purchaseUrl" 
                                    class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors"
                                    x-show="tool.price > 0"
                                >
                                    Buy Now
                                </a>
                                <a 
                                    :href="tool.downloadUrl" 
                                    class="px-4 py-2 bg-secondary-500 text-white rounded-lg hover:bg-secondary-600 transition-colors"
                                    x-show="tool.price === 0"
                                >
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Empty state -->
        <div x-show="filteredTools.length === 0" class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-800 dark:text-white">No tools found</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
        </div>
    </div>
    
    <!-- Tool Detail Modal -->
    <div 
        x-show="showToolModal" 
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
        <div 
            x-show="showToolModal" 
            x-transition.scale.duration.300ms
            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
        >
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white" x-text="selectedTool.name"></h3>
                        <div class="mt-1 flex items-center">
                            <span 
                                class="inline-block px-2 py-1 text-xs font-semibold rounded-full mr-2"
                                :class="{
                                    'bg-blue-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200': selectedTool.category === 'wordpress-theme',
                                    'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': selectedTool.category === 'wordpress-plugin',
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': selectedTool.category === 'bot-script',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': selectedTool.category === 'documentation'
                                }"
                                x-text="selectedTool.categoryLabel"
                            ></span>
                            <span class="text-xl font-bold text-gray-800 dark:text-white" x-show="selectedTool.price > 0" x-text="'$' + selectedTool.price"></span>
                            <span class="text-xl font-bold text-gray-800 dark:text-white" x-show="selectedTool.price === 0">Free</span>
                        </div>
                    </div>
                    <button @click="showToolModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-6 flex justify-center">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-64" />
                </div>
                
                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Description</h4>
                    <p class="mt-2 text-gray-600 dark:text-gray-300" x-text="selectedTool.description"></p>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div>
                            <h5 class="font-medium text-gray-800 dark:text-white">Features</h5>
                            <ul class="mt-2 space-y-1">
                                <template x-for="feature in selectedTool.features">
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300" x-text="feature"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800 dark:text-white">Compatibility</h5>
                            <ul class="mt-2 space-y-1">
                                <template x-for="compatibility in selectedTool.compatibility">
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300" x-text="compatibility"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end space-x-3">
                    <button 
                        @click="showToolModal = false" 
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700"
                    >
                        Close
                    </button>
                    <a 
                        :href="selectedTool.purchaseUrl" 
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors"
                        x-show="selectedTool.price > 0"
                    >
                        Purchase Now
                    </a>
                    <a 
                        :href="selectedTool.downloadUrl" 
                        class="px-4 py-2 bg-secondary-500 text-white rounded-lg hover:bg-secondary-600 transition-colors"
                        x-show="selectedTool.price === 0"
                    >
                        Download
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toolsData', () => ({
            searchTerm: '',
            filterCategory: '',
            showToolModal: false,
            selectedTool: {},
            
            tools: [
                {
                    id: 1,
                    name: 'Elegant Business Theme',
                    description: 'A modern WordPress theme designed specifically for business websites with multiple layout options.',
                    price: 59,
                    category: 'wordpress-theme',
                    categoryLabel: 'WordPress Theme',
                    purchaseUrl: '/purchase/1',
                    downloadUrl: '/download/1',
                    features: [
                        'Responsive Design',
                        'Multiple Header Styles',
                        'Custom Widgets',
                        'SEO Optimized',
                        'WooCommerce Ready'
                    ],
                    compatibility: [
                        'WordPress 5.0+',
                        'Gutenberg Editor',
                        'Elementor',
                        'WooCommerce'
                    ]
                },
                {
                    id: 2,
                    name: 'Advanced Contact Form',
                    description: 'Feature-rich contact form plugin with spam protection and analytics.',
                    price: 29,
                    category: 'wordpress-plugin',
                    categoryLabel: 'WordPress Plugin',
                    purchaseUrl: '/purchase/2',
                    downloadUrl: '/download/2',
                    features: [
                        'Drag & Drop Builder',
                        'Spam Protection',
                        'Email Notifications',
                        'Analytics Dashboard',
                        'Multi-language Support'
                    ],
                    compatibility: [
                        'WordPress 4.9+',
                        'GDPR Compliant',
                        'WooCommerce'
                    ]
                },
                {
                    id: 3,
                    name: 'Social Media Bot',
                    description: 'Automated social media management script with scheduling capabilities.',
                    price: 49,
                    category: 'bot-script',
                    categoryLabel: 'Bot Script',
                    purchaseUrl: '/purchase/3',
                    downloadUrl: '/download/3',
                    features: [
                        'Cross Platform Posting',
                        'Schedule Posts',
                        'Analytics Reports',
                        'Auto Engagement',
                        'Hashtag Suggestions'
                    ],
                    compatibility: [
                        'Twitter API',
                        'Facebook API',
                        'Instagram API',
                        'Node.js 14+'
                    ]
                },
                {
                    id: 4,
                    name: 'Documentation System',
                    description: 'Comprehensive documentation platform for products and services.',
                    price: 0,
                    category: 'documentation',
                    categoryLabel: 'Documentation',
                    purchaseUrl: '/purchase/4',
                    downloadUrl: '/download/4',
                    features: [
                        'Markdown Support',
                        'Search Functionality',
                        'Version Control',
                        'Public/Private Docs',
                        'Multi-language'
                    ],
                    compatibility: [
                        'HTML/CSS/JS',
                        'GitHub Integration',
                        'Static Site Generators'
                    ]
                },
                {
                    id: 5,
                    name: 'E-commerce Pro',
                    description: 'Complete e-commerce solution for WordPress with advanced features.',
                    price: 89,
                    category: 'wordpress-theme',
                    categoryLabel: 'WordPress Theme',
                    purchaseUrl: '/purchase/5',
                    downloadUrl: '/download/5',
                    features: [
                        'WooCommerce Optimized',
                        'Multiple Shop Layouts',
                        'Quick View',
                        'Ajax Cart',
                        'Advanced Filtering'
                    ],
                    compatibility: [
                        'WooCommerce 4.0+',
                        'WordPress 5.0+',
                        'Payment Gateways'
                    ]
                },
                {
                    id: 6,
                    name: 'Security Shield',
                    description: 'Advanced security plugin protecting against common threats.',
                    price: 39,
                    category: 'wordpress-plugin',
                    categoryLabel: 'WordPress Plugin',
                    purchaseUrl: '/purchase/6',
                    downloadUrl: '/download/6',
                    features: [
                        'Firewall Protection',
                        'Brute Force Prevention',
                        'Malware Scanner',
                        'Login Security',
                        'Activity Logs'
                    ],
                    compatibility: [
                        'WordPress 5.0+',
                        'All Hosting Providers',
                        'SSL Compatible'
                    ]
                }
            ],
            
            get filteredTools() {
                return this.tools.filter(tool => {
                    const matchesSearch = tool.name.toLowerCase().includes(this.searchTerm.toLowerCase()) || 
                                          tool.description.toLowerCase().includes(this.searchTerm.toLowerCase());
                    const matchesCategory = this.filterCategory === '' || tool.category === this.filterCategory;
                    return matchesSearch && matchesCategory;
                });
            },
            
            showModal(tool) {
                this.selectedTool = tool;
                this.showToolModal = true;
            }
        }));
    });
</script>
@endsection