<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to DressCafe</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            overflow: hidden;
        }
        
        .title-font {
            font-family: 'Playfair Display', serif;
        }
        
        .text-animate span {
            opacity: 0;
            display: inline-block;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .quote {
            opacity: 0;
            animation: fadeIn 1s forwards 2.5s;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        .btn-enter {
            opacity: 0;
            animation: fadeIn 1s forwards 3s;
            transform: scale(0.9);
            transition: all 0.3s ease;
        }
        
        .btn-enter:hover {
            transform: scale(1);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .bg-pattern {
            background-image: radial-gradient(rgba(0,0,0,0.1) 2px, transparent 2px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-pattern flex items-center justify-center">
    <div class="text-center px-4 max-w-3xl">
        <!-- Animated Title -->
        <h1 id="animated-title" class="text-5xl md:text-7xl font-bold mb-6 text-gray-800 title-font"></h1>
        
        <!-- Quote -->
        <p class="quote text-xl md:text-2xl text-gray-600 italic mb-12">
            "Where fashion meets comfort in every sip and stitch"
        </p>
        
        <!-- Enter Button - routes to login -->
        <a href="{{ route('login') }}" class="btn-enter inline-block bg-gradient-to-r from-pink-500 to-rose-500 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
            Enter the DressCafe
        </a>
        
        <!-- Floating decorative elements -->
        <div class="absolute top-1/4 left-1/4 w-16 h-16 rounded-full bg-pink-200 opacity-30 floating" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-24 h-24 rounded-full bg-rose-200 opacity-30 floating" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-1/3 w-20 h-20 rounded-full bg-purple-200 opacity-30 floating" style="animation-delay: 1.5s;"></div>
    </div>

    <script>
        // Animate text word by word
        const title = "Welcome to DressCafe";
        const titleElement = document.getElementById('animated-title');
        
        function animateText() {
            const words = title.split(' ');
            titleElement.innerHTML = '';
            
            words.forEach((word, i) => {
                const wordSpan = document.createElement('span');
                wordSpan.textContent = word + (i < words.length - 1 ? ' ' : '');
                wordSpan.style.animationDelay = `${i * 0.3}s`;
                titleElement.appendChild(wordSpan);
            });
        }
        
        // Initialize animation
        document.addEventListener('DOMContentLoaded', () => {
            animateText();
        });
    </script>
</body>
</html>