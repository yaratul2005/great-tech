@extends('layouts.app')

@section('title', 'Purchase License - Great Ten Technology')

@section('content')
<div class="pt-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Purchase License</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Get instant access to our premium products with a license key
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Elegant Business Theme</h2>
                    <div class="mt-2 flex items-center">
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200">
                            WordPress Theme
                        </span>
                        <span class="ml-3 text-xl font-bold text-gray-800 dark:text-white">$59.00</span>
                    </div>
                </div>

                <div class="p-6">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                                <input type="text" id="firstName" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                                <input type="text" id="lastName" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                            <input type="email" id="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">We'll send your license key to this email</p>
                        </div>

                        <div class="mb-6">
                            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company (Optional)</label>
                            <input type="text" id="company" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>

                        <div class="mb-6">
                            <label for="billingAddress" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Billing Address</label>
                            <input type="text" id="billingAddress" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Street address">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input type="text" id="city" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">State</label>
                                <input type="text" id="state" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                            <div>
                                <label for="zipCode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ZIP Code</label>
                                <input type="text" id="zipCode" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Payment Method</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input id="card-payment" name="payment-method" type="radio" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600" checked>
                                    <label for="card-payment" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Credit or Debit Card
                                    </label>
                                </div>
                                
                                <div class="mt-6">
                                    <label for="card-element" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Card Details</label>
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                                        <!-- Stripe Element placeholder - would be integrated with actual payment gateway -->
                                        <div class="bg-white p-4 rounded border border-gray-200">
                                            <div class="h-10 flex items-center text-gray-500">
                                                Enter card details...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                I agree to the <a href="/terms" class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">Terms of Service</a> and <a href="/privacy" class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 rounded-lg text-white font-bold shadow-md transition-all duration-300 transform hover:scale-[1.02]">
                            Complete Purchase - $59.00
                        </button>
                    </form>
                </div>
            </div>

            <!-- Verification Badge Example -->
            <div class="mt-12 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">License Verification</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Verify Your License</h3>
                        <div class="flex">
                            <input type="text" placeholder="Enter your license key" class="flex-grow px-4 py-2 rounded-l-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none">
                            <button class="px-4 py-2 bg-primary-500 text-white rounded-r-lg hover:bg-primary-600 transition-colors">
                                Verify
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Find your license key in the email receipt after purchase</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Verification Result</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">License Verified Successfully</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Valid until: June 15, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">License Badges</h3>
                    <div class="flex flex-wrap gap-4">
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex flex-col items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Standard License</p>
                            <span class="mt-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-2 py-1 rounded">1 Site</span>
                        </div>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex flex-col items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Extended License</p>
                            <span class="mt-1 text-xs bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 px-2 py-1 rounded">Unlimited Sites</span>
                        </div>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex flex-col items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Developer License</p>
                            <span class="mt-1 text-xs bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 px-2 py-1 rounded">Client Projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection