<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatApp - Private Messages That Disappear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-color {
            color: #005AA8;
        }

        .bg-brand-color {
            background-color: #005AA8;
        }

        .bg-brand-color:hover {
            background-color: #357BCC;
        }

        .text-brand {
            color: #005AA8;
        }

        .border-brand {
            border-color: #005AA8;
        }

        .gradient-hero {
            background: linear-gradient(135deg, #005AA8 0%, #357BCC 50%, #6B9BD8 100%);
        }

        .glass-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 90, 168, 0.1);
        }

        .feature-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 90, 168, 0.25);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-brand-color rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">ChatApp</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-brand transition-colors">Features</a>
                    <a href="#tech" class="text-gray-600 hover:text-brand transition-colors">Technology</a>
                    <a href="#security" class="text-gray-600 hover:text-brand transition-colors">Security</a>
                    <a href="https://chatapp.techenfield.com/home/" target="_blank" class="bg-brand-color hover:bg-brand-color text-white px-4 py-2 rounded-lg transition-colors">
                        Launch App
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-hero pt-24 pb-20 relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 bg-white rounded-full floating"></div>
            <div class="absolute top-40 right-20 w-20 h-20 bg-white rounded-full floating" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-20 left-1/3 w-24 h-24 bg-white rounded-full floating" style="animation-delay: -4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-8">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Auto-delete in 24 hours
                </div>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Chat Without
                    <span class="block text-yellow-300">Leaving Traces</span>
                </h1>

                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Experience truly private conversations with automatic message deletion. Your words disappear after 24 hours, ensuring complete privacy and peace of mind.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="https://chatapp.techenfield.com/home/" target="_blank"
                       class="bg-white text-brand-color px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-all transform hover:scale-105 shadow-lg">
                        Start Secure Chat
                    </a>
                    <a href="#features"
                       class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-brand-color transition-all">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Privacy-First Features
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Built with security and user privacy as the core foundation
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-8 feature-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Auto-Delete Messages</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Messages automatically disappear after 24 hours, leaving no digital footprint behind. Complete privacy guaranteed.
                    </p>
                </div>

                <div class="glass-card rounded-2xl p-8 feature-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Real-Time Messaging</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Instant message delivery with WebSocket technology for seamless conversations that feel natural and responsive.
                    </p>
                </div>

                <div class="glass-card rounded-2xl p-8 feature-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Platform</h3>
                    <p class="text-gray-600 leading-relaxed">
                        End-to-end encryption ensures your conversations remain private and protected from unauthorized access.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack Section -->
    <section id="tech" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Powered by Modern Technology
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Built with industry-leading technologies for performance and reliability
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <img src="https://cdn.worldvectorlogo.com/logos/laravel-2.svg" alt="Laravel Logo" class="w-6 h-6">
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Laravel</h4>
                    <p class="text-gray-600 text-sm">Robust PHP framework for secure backend architecture</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <img src="https://avatars.githubusercontent.com/u/739550?s=280&v=4" alt="Laravel Logo" class="w-8 h-8">
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Pusher</h4>
                    <p class="text-gray-600 text-sm">Real-time WebSocket connections for instant messaging</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Auto-Cleanup</h4>
                    <p class="text-gray-600 text-sm">Automated message deletion system for privacy</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Responsive</h4>
                    <p class="text-gray-600 text-sm">Works seamlessly across all devices and platforms</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section id="security" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center px-6 py-3 bg-green-100 rounded-full text-green-800 font-medium mb-8">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Enterprise-Grade Security
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Your Privacy, Our Priority
                </h2>

                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">
                    Every message is protected with state-of-the-art encryption and automatically deleted to ensure your conversations remain completely private.
                </p>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-12">
                    <div class="grid md:grid-cols-3 gap-8 text-center">
                        <div>
                            <div class="text-3xl font-bold text-brand mb-2">24h</div>
                            <p class="text-gray-600">Automatic message deletion</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-brand mb-2">100%</div>
                            <p class="text-gray-600">Private conversations</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-brand mb-2">0</div>
                            <p class="text-gray-600">Data stored permanently</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Ready for Truly Private Conversations?
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Join thousands of users who trust ChatApp for their private communications.
            </p>
            <a href="https://chatapp.techenfield.com/home/" target="_blank"
               class="inline-flex items-center bg-brand-color hover:bg-brand-color text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 pulse-glow">
                Start Chatting Securely
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-brand-color rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">ChatApp</span>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-600">© {{ today()->format('Y') }} ChatApp. Built with Laravel & Pusher.</p>
                    <p class="text-gray-500 text-sm mt-1">Your messages, your privacy, your peace of mind.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
