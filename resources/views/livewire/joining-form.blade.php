<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('nce-logo.png') }}" alt="NCE Logo" class="h-10 sm:h-12 w-auto object-contain">
                </a>

                <a href="{{ route('join') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#147cb5] text-white text-sm font-medium rounded-lg hover:bg-[#0f5a8a] transition-all duration-200 shadow-sm hover:shadow-md">
                    Join NCE
                </a>
            </div>
        </div>
    </header>

    <section class="py-6 sm:py-12 lg:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:grid lg:grid-cols-2">
                    <!-- Top on mobile, Left on desktop - Image -->
                    <div class="relative order-1 lg:order-1 h-64 sm:h-80 lg:h-auto">
                        <img src="{{ asset('images/banner-1.webp') }}" alt="NCE Community" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#147cb5]/90 via-[#0f5a8a]/80 to-black/70"></div>
                        <div class="relative h-full flex flex-col justify-center p-6 sm:p-8 lg:p-12 text-white">
                            <div class="mb-4 lg:mb-8">
                                <img src="{{ asset('nce-logo.png') }}" alt="NCE Logo" class="h-10 sm:h-12 lg:h-14 w-auto brightness-0 invert mb-4 lg:mb-6">
                                <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold mb-2 lg:mb-4 leading-tight">
                                    Navodaya Council of Entrepreneurs
                                </h1>
                                <p class="text-base sm:text-lg lg:text-xl text-blue-100 leading-relaxed mb-3 lg:mb-6">
                                    Uniting & Elevating Navodayan Entrepreneurs
                                </p>
                                <p class="hidden lg:block text-base text-gray-200 leading-relaxed">
                                    Join our thriving community of Navodaya alumni entrepreneurs building successful businesses together through networking, collaboration, and mutual growth.
                                </p>
                            </div>
                            <div class="hidden lg:space-y-4 lg:flex lg:flex-col">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm sm:text-base">Exclusive Business Network</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm sm:text-base">Mentorship & Growth Opportunities</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm sm:text-base">Pan-India Chapter Network</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom on mobile, Right on desktop - Form -->
                    <div class="p-6 sm:p-8 lg:p-10 order-2 lg:order-2">
                        @if ($step === 1)
                            <div class="mb-6 lg:mb-8">
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Join NCE</h2>
                                <p class="text-gray-600">Enter your details to become a member</p>
                            </div>
                            
                            <form wire:submit.prevent="nextStep" class="space-y-4 lg:space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="name" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Enter your full name" required>
                                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">JNV Name <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="jnv_name" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Enter your JNV name" required>
                                    @error('jnv_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">Business Name <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="business_name" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Enter your business name" required>
                                    @error('business_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">Phone Number <span class="text-red-500">*</span></label>
                                    <input type="tel" wire:model="phone_number" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Enter your mobile number" required>
                                    @error('phone_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div class="pt-2 lg:pt-4">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 lg:py-3.5 bg-gradient-to-r from-[#147cb5] to-[#0f5a8a] text-white text-base font-semibold rounded-xl hover:from-[#0f5a8a] hover:to-[#0a4a6b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#147cb5] transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Register & Pay ₹3000
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @elseif ($step === 2)
                            <div class="mb-6 lg:mb-8">
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Complete Payment</h2>
                                <p class="text-gray-600">Pay ₹3000 to finalize your registration</p>
                            </div>
                            
                            <div class="space-y-5 lg:space-y-6">
                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                                    <div class="flex items-start">
                                        <svg class="h-5 w-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        <div class="ml-3">
                                            <p class="text-sm text-amber-800">
                                                <strong>Payment Required:</strong> Your basic details have been saved. Pay ₹3000 via UPI, then add the rest of your details.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <a href="upi://pay?pa=mab.037213039820027%40axisbank&cu=INR&am=3000.00&tn=Varanasi+Meet" 
                                       class="w-full inline-flex items-center justify-center px-6 py-3.5 lg:py-4 bg-gradient-to-r from-green-600 to-green-700 text-white text-base lg:text-lg font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="mr-2 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Pay ₹3000 via UPI
                                    </a>
                                </div>

                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-200"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">After payment, submit proof</span>
                                    </div>
                                </div>

                                <form wire:submit.prevent="submitPaymentProof" class="space-y-4 lg:space-y-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">Upload Screenshot of Payment</label>
                                        <input type="file" wire:model="payment_screenshot" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#147cb5]/10 file:text-[#147cb5] hover:file:bg-[#147cb5]/20">
                                        @error('payment_screenshot') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="text-center text-gray-400 text-xs">OR</div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900 mb-1.5 lg:mb-2">UPI Transaction ID</label>
                                        <input type="text" wire:model="upi_transaction_id" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Enter UPI transaction ID">
                                        @error('upi_transaction_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 lg:py-3.5 bg-gradient-to-r from-[#147cb5] to-[#0f5a8a] text-white text-base font-semibold rounded-xl hover:from-[#0f5a8a] hover:to-[#0a4a6b] transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Submit Payment Proof
                                    </button>
                                </form>
                            </div>
                        @elseif ($step === 3)
                            <div class="mb-6 lg:mb-8">
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Additional Details</h2>
                                <p class="text-gray-600">Add your Navodaya and business details to complete your registration.</p>
                            </div>

                            <form wire:submit.prevent="submitDetails" class="space-y-4 lg:space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Email address <span class="text-red-500">*</span></label>
                                    <input type="email" wire:model="email" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="you@example.com" required>
                                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Batch</label>
                                    <input type="text" wire:model="batch" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="e.g. 2005">
                                    @error('batch') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Alternate contact number</label>
                                    <input type="tel" wire:model="official_contact_number" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Optional">
                                    @error('official_contact_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">City</label>
                                    <input type="text" wire:model="address_city" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Your city">
                                    @error('address_city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Business category <span class="text-red-500">*</span></label>
                                    <select wire:model="business_category" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all" required>
                                        <option value="">Select a category</option>
                                        <option value="IT & Software">IT &amp; Software</option>
                                        <option value="Trading">Trading</option>
                                        <option value="Services">Services</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Education">Education</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('business_category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Business name &amp; city <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="business_name_city" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Business name, city" required>
                                    @error('business_name_city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Website</label>
                                    <input type="url" wire:model="website" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="https://yourbusiness.com">
                                    @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900 mb-1.5">Products &amp; services <span class="text-red-500">*</span></label>
                                    <textarea wire:model="products_services" rows="3" class="w-full px-4 py-2.5 lg:py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#147cb5] focus:bg-white focus:border-transparent transition-all placeholder-gray-400" placeholder="Tell us what your business offers" required></textarea>
                                    @error('products_services') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-3">
                                    <label class="flex items-start gap-3">
                                        <input type="checkbox" wire:model="willing_volunteer" class="mt-0.5 size-4 rounded border-gray-300 text-[#147cb5] focus:ring-[#147cb5]">
                                        <span class="text-sm text-gray-700">I would like to volunteer for NCE initiatives.</span>
                                    </label>

                                    <label class="flex items-start gap-3">
                                        <input type="checkbox" wire:model="willing_sponsor" class="mt-0.5 size-4 rounded border-gray-300 text-[#147cb5] focus:ring-[#147cb5]">
                                        <span class="text-sm text-gray-700">I would like to sponsor NCE events or programmes.</span>
                                    </label>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 lg:py-3.5 bg-gradient-to-r from-[#147cb5] to-[#0f5a8a] text-white text-base font-semibold rounded-xl hover:from-[#0f5a8a] hover:to-[#0a4a6b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#147cb5] transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Complete Registration
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @elseif ($step === 4)
                            <div class="py-8 lg:py-12 text-center">
                                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Registration Submitted!</h2>
                                <p class="text-gray-600 mb-8 max-w-sm mx-auto">Thank you for registering with NCE. Your details and payment proof have been submitted and will be reviewed soon.</p>
                                <a href="/" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#147cb5] to-[#0f5a8a] text-white text-base font-semibold rounded-xl hover:from-[#0f5a8a] hover:to-[#0a4a6b] transition-all duration-200">
                                    Back to Home
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#102f43] text-white py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <img src="{{ asset('nce-logo.png') }}" alt="NCE Logo" class="h-10 w-auto mx-auto mb-4 brightness-0 invert">
            <p class="text-sm text-gray-400">© 2026 Navodaya Council of Entrepreneurs. All rights reserved.</p>
        </div>
    </footer>
</div>
