<!-- NRP: 5026231206| Nama: Rafael Dimas Khristianto -->

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: hidden;
            background: linear-gradient(135deg, #5a9fb5 0%, #36839b 25%, #2d7a8f 50%, #1a5f7a 75%, #0d4a65 100%);
            background-size: 400% 400%;
            background-position: 0% 50%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* SVG Wave animations */
        @keyframes waveFloat {
            0%, 100% { transform: translateY(0px) skewY(0deg); }
            50% { transform: translateY(-20px) skewY(1deg); }
        }

        @keyframes waveFloat2 {
            0%, 100% { transform: translateY(0px) skewY(0deg); }
            50% { transform: translateY(-15px) skewY(-1deg); }
        }

        svg.wave-top {
            animation: waveFloat 4s ease-in-out infinite;
            opacity: 0.4;
        }

        svg.wave-top-2 {
            animation: waveFloat2 5s ease-in-out infinite;
            opacity: 0.3;
        }

        svg.wave-bottom {
            animation: waveFloat 4.5s ease-in-out infinite;
            opacity: 0.35;
        }

        svg.wave-bottom-2 {
            animation: waveFloat2 5.5s ease-in-out infinite;
            opacity: 0.25;
        }

        .splash-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative waves - top */
        .waves-top {
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 200px;
            z-index: 1;
        }

        /* Decorative waves - bottom */
        .waves-bottom {
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 200px;
            z-index: 1;
        }

        /* Logo area - main container showing all elements */
        .logo-area {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
            animation: fadeInUp 0.8s ease-out;
            height: auto;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            position: relative;
            width: 240px;
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon {
            width: 220px;
            height: 220px;
            animation: float 3s cubic-bezier(0.42, 0, 0.58, 1) infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .logo-icon img {
            filter: drop-shadow(0 10px 30px rgba(255, 255, 255, 0.3));
        }

        /* Brand name - visible immediately */
        .brand-name {
            position: relative;
            opacity: 1;
            z-index: 15;
            animation: fadeInUp 0.8s ease-out 0.2s both;
            order: 2;
        }

        .brand-name h1 {
            font-family: "Afacad", sans-serif;
            font-size: 56px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1px;
            text-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            margin: 0;
        }

        /* Loading spinner - visible at bottom */
        .loading-text {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            order: 3;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #ffffff;
            border-radius: 50%;
            animation: spin 1.2s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Redirect after loading complete */
        .splash-container.complete {
            animation: fadeOut 0.6s ease-out 2.8s forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .logo-icon {
                width: 80px;
                height: 80px;
            }

            .brand-name h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="splash-container" id="splashContainer">
        <!-- Decorative waves top -->
        <div class="waves-top">
            <svg class="wave-top" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: rgba(255,255,255,0.15); width: 100%; height: 100%;">
                <path d="M0,50 Q300,0 600,50 T1200,50 L1200,120 L0,120 Z"></path>
            </svg>
            <svg class="wave-top-2" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: rgba(255,255,255,0.1); width: 100%; height: 100%; position: absolute; top: 10px;">
                <path d="M0,60 Q300,20 600,60 T1200,60 L1200,120 L0,120 Z"></path>
            </svg>
        </div>

        <!-- Logo area -->
        <div class="logo-area">
            <div class="logo-container">
                <div class="logo-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Launbass Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
            </div>            <!-- Brand name - visible immediately -->
            <div class="brand-name">
                <h1>Launbass.</h1>
            </div>

            <!-- Loading spinner -->
            <div class="loading-text">
                <div class="spinner"></div>
            </div>
        </div>

        <!-- Decorative waves bottom -->
        <div class="waves-bottom">
            <svg class="wave-bottom" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: rgba(255,255,255,0.15); width: 100%; height: 100%;">
                <path d="M0,70 Q300,120 600,70 T1200,70 L1200,0 L0,0 Z"></path>
            </svg>
            <svg class="wave-bottom-2" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: rgba(255,255,255,0.1); width: 100%; height: 100%; position: absolute; bottom: 10px;">
                <path d="M0,60 Q300,110 600,60 T1200,60 L1200,0 L0,0 Z"></path>
            </svg>
        </div>
    </div>

    <script>
        // Redirect to login after 3 seconds - all elements visible immediately
        window.addEventListener('load', function() {
            setTimeout(() => {
                const container = document.getElementById('splashContainer');
                container.classList.add('complete');

                // Redirect to login after fade out completes
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 600);
            }, 3000);
        });

        // Fallback: redirect if page takes too long to load
        setTimeout(() => {
            window.location.href = '{{ route("login") }}';
        }, 5000);
    </script>
</body>
</html>
