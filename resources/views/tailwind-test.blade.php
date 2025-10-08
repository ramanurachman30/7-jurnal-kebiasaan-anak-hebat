<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS v4 Test Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900 transition-colors duration-300">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 via-purple-600 to-teal-600 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <h1 class="text-2xl font-bold">Tailwind CSS v4 Test</h1>
                <nav class="hidden md:flex space-x-8">
                    <a href="#typography" class="hover:text-blue-200 transition-colors">Typography</a>
                    <a href="#layout" class="hover:text-blue-200 transition-colors">Layout</a>
                    <a href="#components" class="hover:text-blue-200 transition-colors">Components</a>
                    <a href="#responsive" class="hover:text-blue-200 transition-colors">Responsive</a>
                </nav>
                <button class="md:hidden p-2 rounded-md hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section
        class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 text-white min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div
            class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl animate-pulse delay-1000">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1
                class="text-5xl md:text-7xl font-extrabold mb-6 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-fade-in">
                Tailwind CSS v4
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300 max-w-3xl mx-auto">
                A comprehensive test page showcasing the power and flexibility of Tailwind CSS v4 utilities and
                features.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Get Started
                </button>
                <button
                    class="px-8 py-4 border-2 border-white/30 hover:border-white/60 rounded-lg font-semibold backdrop-blur-sm hover:bg-white/10 transition-all duration-200">
                    Learn More
                </button>
            </div>
        </div>
    </section>

    <!-- Typography Section -->
    <section id="typography" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900">Typography Testing</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Headings & Text</h3>
                    <h1 class="text-5xl font-extrabold text-gray-900">Heading 1</h1>
                    <h2 class="text-4xl font-bold text-gray-800">Heading 2</h2>
                    <h3 class="text-3xl font-semibold text-gray-700">Heading 3</h3>
                    <h4 class="text-2xl font-medium text-gray-600">Heading 4</h4>
                    <h5 class="text-xl font-normal text-gray-500">Heading 5</h5>
                    <h6 class="text-lg font-light text-gray-400">Heading 6</h6>
                </div>

                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Text Utilities</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        This is a normal paragraph with <strong class="font-bold">bold text</strong>,
                        <em class="italic">italic text</em>, and <u class="underline">underlined text</u>.
                    </p>
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Small uppercase text</p>
                    <p
                        class="text-2xl text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text font-bold">
                        Gradient text effect
                    </p>
                    <p class="text-center line-through text-gray-400">Centered strikethrough text</p>
                    <p class="text-right text-indigo-600 font-mono">Right-aligned monospace text</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Colors & Effects Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900">Colors & Effects</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-12">
                <div class="h-24 bg-red-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform"></div>
                <div class="h-24 bg-orange-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform">
                </div>
                <div class="h-24 bg-yellow-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform">
                </div>
                <div class="h-24 bg-green-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform">
                </div>
                <div class="h-24 bg-blue-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform"></div>
                <div class="h-24 bg-indigo-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform">
                </div>
                <div class="h-24 bg-purple-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform">
                </div>
                <div class="h-24 bg-pink-500 rounded-lg shadow-lg transform hover:scale-105 transition-transform"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold mb-4">Regular Shadow</h3>
                    <div class="h-16 bg-blue-100 rounded-lg shadow"></div>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-lg font-semibold mb-4">Large Shadow</h3>
                    <div class="h-16 bg-purple-100 rounded-lg shadow-lg"></div>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-2xl hover:shadow-3xl transition-shadow">
                    <h3 class="text-lg font-semibold mb-4">Extra Large Shadow</h3>
                    <div class="h-16 bg-pink-100 rounded-lg shadow-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layout & Grid Section -->
    <section id="layout" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900">Layout & Grid</h2>

            <!-- Flexbox Demo -->
            <div class="mb-12">
                <h3 class="text-2xl font-semibold mb-6">Flexbox Layout</h3>
                <div class="flex flex-wrap gap-4 p-6 bg-gray-100 rounded-lg">
                    <div class="flex-1 min-w-48 p-4 bg-blue-500 text-white rounded text-center">Flex Item 1</div>
                    <div class="flex-2 min-w-48 p-4 bg-green-500 text-white rounded text-center">Flex Item 2 (flex-2)
                    </div>
                    <div class="flex-1 min-w-48 p-4 bg-purple-500 text-white rounded text-center">Flex Item 3</div>
                </div>
            </div>

            <!-- Grid Demo -->
            <div class="mb-12">
                <h3 class="text-2xl font-semibold mb-6">CSS Grid Layout</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="col-span-1 md:col-span-2 p-6 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg">
                        <h4 class="text-xl font-bold mb-2">Spanning 2 Columns</h4>
                        <p>This grid item spans across 2 columns on medium screens and larger.</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg">
                        <h4 class="text-xl font-bold mb-2">Grid Item</h4>
                        <p>Regular grid item.</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg">
                        <h4 class="text-xl font-bold mb-2">Grid Item</h4>
                        <p>Another grid item.</p>
                    </div>
                </div>
            </div>

            <!-- Spacing Demo -->
            <div>
                <h3 class="text-2xl font-semibold mb-6">Spacing & Positioning</h3>
                <div class="relative h-64 bg-gray-100 rounded-lg overflow-hidden">
                    <div class="absolute top-4 left-4 p-4 bg-red-500 text-white rounded">Top Left</div>
                    <div class="absolute top-4 right-4 p-4 bg-blue-500 text-white rounded">Top Right</div>
                    <div class="absolute bottom-4 left-4 p-4 bg-green-500 text-white rounded">Bottom Left</div>
                    <div class="absolute bottom-4 right-4 p-4 bg-purple-500 text-white rounded">Bottom Right</div>
                    <div class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 text-center">
                        <div class="inline-block p-4 bg-yellow-500 text-white rounded">Centered</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Components Section -->
    <section id="components" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900">Interactive Components</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Buttons -->
                <div>
                    <h3 class="text-2xl font-semibold mb-6">Buttons</h3>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-4">
                            <button
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">Primary</button>
                            <button
                                class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">Secondary</button>
                            <button
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">Success</button>
                            <button
                                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">Danger</button>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <button
                                class="px-6 py-3 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-colors">Outline</button>
                            <button
                                class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-lg transition-all transform hover:scale-105">Gradient</button>
                            <button
                                class="px-6 py-3 bg-yellow-300 hover:bg-yellow-500 text-yellow-900 rounded-full transition-colors">Rounded</button>
                        </div>
                    </div>
                </div>

                <!-- Form Elements -->
                <div>
                    <h3 class="text-2xl font-semibold mb-6">Form Elements</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Input Field</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Enter text...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Dropdown</label>
                            <select
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Textarea</label>
                            <textarea
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                rows="3" placeholder="Enter message..."></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cards -->
            <div class="mt-16">
                <h3 class="text-2xl font-semibold mb-8">Cards & Components</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                        <div
                            class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 group-hover:from-blue-500 group-hover:to-blue-700 transition-all">
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold mb-2">Card Title</h4>
                            <p class="text-gray-600 mb-4">This is a sample card with hover effects and transitions.</p>
                            <button
                                class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">Learn
                                More</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                        <div
                            class="h-48 bg-gradient-to-br from-green-400 to-green-600 group-hover:from-green-500 group-hover:to-green-700 transition-all">
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold mb-2">Another Card</h4>
                            <p class="text-gray-600 mb-4">Cards can contain various content and interactive elements.
                            </p>
                            <button
                                class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">Get
                                Started</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                        <div
                            class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 group-hover:from-purple-500 group-hover:to-purple-700 transition-all">
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold mb-2">Third Card</h4>
                            <p class="text-gray-600 mb-4">Consistent styling and behavior across all components.</p>
                            <button
                                class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">Explore</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Responsive Design Section -->
    <section id="responsive" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900">Responsive Design</h2>

            <div class="space-y-8">
                <div class="text-center">
                    <p class="text-lg text-gray-600 mb-8">Resize your browser window to see responsive behavior</p>
                </div>

                <!-- Responsive Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 bg-blue-100 rounded-lg text-center">
                        <h4 class="font-semibold text-blue-800">Mobile First</h4>
                        <p class="text-sm text-blue-600 mt-2">1 column on mobile</p>
                    </div>
                    <div class="p-6 bg-green-100 rounded-lg text-center">
                        <h4 class="font-semibold text-green-800">Small Screens</h4>
                        <p class="text-sm text-green-600 mt-2">2 columns on sm+</p>
                    </div>
                    <div class="p-6 bg-purple-100 rounded-lg text-center">
                        <h4 class="font-semibold text-purple-800">Large Screens</h4>
                        <p class="text-sm text-purple-600 mt-2">4 columns on lg+</p>
                    </div>
                    <div class="p-6 bg-orange-100 rounded-lg text-center">
                        <h4 class="font-semibold text-orange-800">Adaptive</h4>
                        <p class="text-sm text-orange-600 mt-2">Fluid layout</p>
                    </div>
                </div>

                <!-- Hidden/Visible Elements -->
                <div class="bg-gray-100 p-8 rounded-lg">
                    <h3 class="text-xl font-semibold mb-6 text-center">Responsive Visibility</h3>
                    <div class="space-y-4 text-center">
                        <div class="block sm:hidden p-4 bg-red-200 rounded">
                            <span class="text-red-800 font-semibold">Mobile Only - Hidden on SM+ screens</span>
                        </div>
                        <div class="hidden sm:block lg:hidden p-4 bg-green-200 rounded">
                            <span class="text-green-800 font-semibold">Tablet Only - Visible on SM to LG screens</span>
                        </div>
                        <div class="hidden lg:block p-4 bg-blue-200 rounded">
                            <span class="text-blue-800 font-semibold">Desktop Only - Visible on LG+ screens</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Animations & Interactions -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16">Animations & Interactions</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group cursor-pointer">
                    <div
                        class="p-8 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl transform group-hover:scale-110 transition-transform duration-300">
                        <h4 class="text-xl font-bold mb-2">Hover Scale</h4>
                        <p class="text-blue-200">Scales up on hover</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div
                        class="p-8 bg-gradient-to-br from-green-600 to-green-800 rounded-xl transform group-hover:rotate-3 transition-transform duration-300">
                        <h4 class="text-xl font-bold mb-2">Hover Rotate</h4>
                        <p class="text-green-200">Rotates on hover</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div
                        class="p-8 bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl group-hover:shadow-2xl group-hover:shadow-purple-500/25 transition-all duration-300">
                        <h4 class="text-xl font-bold mb-2">Hover Shadow</h4>
                        <p class="text-purple-200">Glowing shadow effect</p>
                    </div>
                </div>

                <div class="group cursor-pointer overflow-hidden rounded-xl">
                    <div
                        class="p-8 bg-gradient-to-br from-pink-600 to-pink-800 transform group-hover:translate-y-[-4px] transition-transform duration-300">
                        <h4 class="text-xl font-bold mb-2">Hover Lift</h4>
                        <p class="text-pink-200">Lifts up on hover</p>
                    </div>
                </div>
            </div>

            <!-- Loading Animation -->
            <div class="mt-16 text-center">
                <h3 class="text-2xl font-semibold mb-8">Loading Animations</h3>
                <div class="flex justify-center space-x-8">
                    <div class="w-8 h-8 bg-blue-500 rounded-full animate-pulse"></div>
                    <div class="w-8 h-8 bg-green-500 rounded-full animate-bounce"></div>
                    <div
                        class="w-8 h-8 bg-purple-500 rounded-full animate-spin border-2 border-purple-500 border-t-transparent">
                    </div>
                    <div class="w-8 h-8 bg-pink-500 rounded-full animate-ping"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Status Section -->
    <section class="py-20 bg-green-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-2xl shadow-xl p-12">
                <div class="w-24 h-24 bg-green-500 rounded-full mx-auto mb-8 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tailwind CSS v4 is Working!</h2>
                <p class="text-xl text-gray-600 mb-8">
                    All utility classes, responsive design, animations, and interactive features are functioning
                    correctly.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/') }}"
                        class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors">
                        Back to Website
                    </a>
                    <button onclick="window.location.reload()"
                        class="px-8 py-4 border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:text-gray-900 rounded-lg font-semibold transition-colors">
                        Reload Test
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">
                Tailwind CSS v4 Test Page • Built with
                <span class="text-blue-400 font-semibold">@import 'tailwindcss'</span> •
                Powered by Laravel & Vite
            </p>
            <p class="text-gray-500 mt-2 text-sm">
                Test completed successfully ✓
            </p>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 z-50">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    @vite('resources/js/app.js')
</body>

</html>
